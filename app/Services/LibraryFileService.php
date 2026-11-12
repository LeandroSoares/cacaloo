<?php

namespace App\Services;

use App\Models\LibraryFile;
use App\Models\LibraryTag;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LibraryFileService
{
    public const DISK = 'local';

    public const FILES_DIR = 'library/files';

    public const COVERS_DIR = 'library/covers';

    public function create(array $data, UploadedFile $file, ?UploadedFile $cover, User $uploader): LibraryFile
    {
        $disk = Storage::disk(self::DISK);
        $filePath = $file->store(self::FILES_DIR, self::DISK);
        $coverPath = $cover ? $cover->store(self::COVERS_DIR, self::DISK) : null;

        try {
            return DB::transaction(function () use ($data, $file, $cover, $uploader, $filePath, $coverPath) {
                $libraryFile = LibraryFile::create([
                    'title' => trim($data['title']),
                    'description' => isset($data['description']) && trim((string) $data['description']) !== ''
                        ? trim((string) $data['description'])
                        : null,
                    'file_path' => $filePath,
                    'original_name' => Str::limit(basename($file->getClientOriginalName()), 255, ''),
                    'mime_type' => $file->getMimeType() ?: 'application/octet-stream',
                    'file_size' => (int) $file->getSize(),
                    'cover_path' => $coverPath,
                    'cover_mime' => $cover ? ($cover->getMimeType() ?: 'image/jpeg') : null,
                    'is_active' => (bool) ($data['is_active'] ?? true),
                    'uploaded_by' => $uploader->id,
                ]);

                $tagIds = LibraryTag::resolveFromNames($data['tags'] ?? []);
                $libraryFile->tags()->sync($tagIds);

                return $libraryFile;
            });
        } catch (\Throwable $e) {
            $disk->delete(array_filter([$filePath, $coverPath]));

            throw $e;
        }
    }

    public function update(LibraryFile $libraryFile, array $data, ?UploadedFile $newFile = null, ?UploadedFile $newCover = null): LibraryFile
    {
        $disk = Storage::disk(self::DISK);
        $newFilePath = $newFile ? $newFile->store(self::FILES_DIR, self::DISK) : null;
        $newCoverPath = $newCover ? $newCover->store(self::COVERS_DIR, self::DISK) : null;

        $oldPathsToDelete = [];

        try {
            $updated = DB::transaction(function () use ($libraryFile, $data, $newFile, $newCover, $newFilePath, $newCoverPath, &$oldPathsToDelete) {
                $attributes = [
                    'title' => trim($data['title']),
                    'description' => isset($data['description']) && trim((string) $data['description']) !== ''
                        ? trim((string) $data['description'])
                        : null,
                    'is_active' => (bool) ($data['is_active'] ?? $libraryFile->is_active),
                ];

                if ($newFile && $newFilePath) {
                    if ($libraryFile->file_path) {
                        $oldPathsToDelete[] = $libraryFile->file_path;
                    }
                    $attributes['file_path'] = $newFilePath;
                    $attributes['original_name'] = Str::limit(basename($newFile->getClientOriginalName()), 255, '');
                    $attributes['mime_type'] = $newFile->getMimeType() ?: 'application/octet-stream';
                    $attributes['file_size'] = (int) $newFile->getSize();
                }

                if (! empty($data['remove_cover']) && ! $newCover) {
                    if ($libraryFile->cover_path) {
                        $oldPathsToDelete[] = $libraryFile->cover_path;
                    }
                    $attributes['cover_path'] = null;
                    $attributes['cover_mime'] = null;
                }

                if ($newCover && $newCoverPath) {
                    if ($libraryFile->cover_path) {
                        $oldPathsToDelete[] = $libraryFile->cover_path;
                    }
                    $attributes['cover_path'] = $newCoverPath;
                    $attributes['cover_mime'] = $newCover->getMimeType() ?: 'image/jpeg';
                }

                $libraryFile->update($attributes);

                if (array_key_exists('tags', $data)) {
                    $tagIds = LibraryTag::resolveFromNames($data['tags'] ?? []);
                    $libraryFile->tags()->sync($tagIds);
                }

                return $libraryFile;
            });

            if (! empty($oldPathsToDelete)) {
                $disk->delete(array_filter($oldPathsToDelete));
            }

            return $updated;
        } catch (\Throwable $e) {
            $disk->delete(array_filter([$newFilePath, $newCoverPath]));

            throw $e;
        }
    }

    public function delete(LibraryFile $libraryFile): void
    {
        $paths = array_filter([$libraryFile->file_path, $libraryFile->cover_path]);

        DB::transaction(function () use ($libraryFile) {
            $libraryFile->tags()->detach();
            $libraryFile->delete();
        });

        if (! empty($paths)) {
            Storage::disk(self::DISK)->delete($paths);
        }
    }

    public function streamDownload(LibraryFile $libraryFile): StreamedResponse
    {
        $disk = Storage::disk(self::DISK);
        abort_unless($libraryFile->file_path && $disk->exists($libraryFile->file_path), 404);

        $safeName = basename(str_replace('\\', '/', $libraryFile->original_name));
        $safeName = preg_replace('/[\x00-\x1F\x7F"\\\\\/]+/u', '_', $safeName) ?: 'arquivo';

        return $disk->download($libraryFile->file_path, Str::limit($safeName, 180, ''));
    }

    public function streamCover(LibraryFile $libraryFile): StreamedResponse
    {
        $disk = Storage::disk(self::DISK);
        abort_unless($libraryFile->cover_path && $disk->exists($libraryFile->cover_path), 404);

        $mime = $libraryFile->cover_mime ?: 'image/jpeg';
        abort_unless(in_array($mime, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'], true), 404);

        return response()->stream(function () use ($disk, $libraryFile) {
            $stream = $disk->readStream($libraryFile->cover_path);
            abort_if($stream === false, 404);
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="cover"',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, max-age=3600',
        ]);
    }
}
