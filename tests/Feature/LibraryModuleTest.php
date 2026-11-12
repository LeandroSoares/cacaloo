<?php

namespace Tests\Feature;

use App\Models\LibraryFile;
use App\Models\LibraryTag;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LibraryModuleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesAndPermissionsSeeder::class);
        Storage::fake('local');
    }

    public function test_guest_cannot_access_portal_library_or_downloads(): void
    {
        $file = LibraryFile::create([
            'title' => 'Apostila Privada',
            'file_path' => 'library/files/apostila.pdf',
            'original_name' => 'apostila.pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 1024,
            'visibility' => 'private',
            'is_active' => true,
        ]);

        $this->get(route('user.library.index'))->assertRedirect(route('login'));
        $this->get(route('user.library.download', $file))->assertRedirect(route('login'));
        $this->get(route('user.library.cover', $file))->assertRedirect(route('login'));
    }

    public function test_legacy_url_redirects_to_new_portal_library(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $this->actingAs($user)
            ->get('/arquivos-diversos')
            ->assertRedirect('/biblioteca');
    }

    public function test_regular_user_can_view_and_download_active_files_but_cannot_access_admin_library(): void
    {
        Storage::disk('local')->put('library/files/doc.pdf', 'PDF-CONTENT');

        $tag = LibraryTag::firstOrCreate(['slug' => 'estudos'], ['name' => 'Estudos']);

        $activeFile = LibraryFile::create([
            'title' => 'Guia de Estudos',
            'description' => 'Material para estudo mediúnico',
            'file_path' => 'library/files/doc.pdf',
            'original_name' => 'guia-estudos.pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 2048,
            'visibility' => 'private',
            'is_active' => true,
        ]);
        $activeFile->tags()->sync([$tag->id]);

        $inactiveFile = LibraryFile::create([
            'title' => 'Rascunho Oculto',
            'file_path' => 'library/files/doc.pdf',
            'original_name' => 'rascunho.pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 2048,
            'visibility' => 'private',
            'is_active' => false,
        ]);

        $user = User::factory()->create();
        $user->assignRole('user');

        $this->actingAs($user)
            ->get(route('user.library.index'))
            ->assertOk()
            ->assertSee('Guia de Estudos')
            ->assertDontSee('Rascunho Oculto');

        $this->actingAs($user)
            ->get(route('user.library.download', $activeFile))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('user.library.download', $inactiveFile))
            ->assertNotFound();

        $this->actingAs($user)
            ->get(route('admin.library.index'))
            ->assertRedirect(route('dashboard'));
    }

    public function test_admin_can_upload_file_with_dynamic_tags_update_and_delete(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $pdf = UploadedFile::fake()->create('apostila.pdf', 512, 'application/pdf');
        $cover = UploadedFile::fake()->image('capa.png', 400, 300);

        $response = $this->actingAs($admin)->post(route('admin.library.store'), [
            'title' => 'Apostila de Umbanda',
            'description' => 'Conteúdo introdutório',
            'tags' => ['Estudos'],
            'custom_tags' => 'Doutrina, Iniciantes',
            'file' => $pdf,
            'cover' => $cover,
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('admin.library.index'));

        $libraryFile = LibraryFile::with('tags')->firstOrFail();
        $this->assertSame('Apostila de Umbanda', $libraryFile->title);
        $this->assertSame('private', $libraryFile->visibility);
        $this->assertCount(3, $libraryFile->tags);
        Storage::disk('local')->assertExists($libraryFile->file_path);
        Storage::disk('local')->assertExists($libraryFile->cover_path);

        // Update metadata & tags
        $updateResponse = $this->actingAs($admin)->put(route('admin.library.update', $libraryFile), [
            'title' => 'Apostila de Umbanda Atualizada',
            'description' => 'Descrição revisada',
            'tags' => ['Doutrina', 'Avançado'],
            'is_active' => '1',
        ]);

        $updateResponse->assertRedirect(route('admin.library.index'));
        $libraryFile->refresh();
        $this->assertSame('Apostila de Umbanda Atualizada', $libraryFile->title);
        $this->assertEqualsCanonicalizing(['Doutrina', 'Avançado'], $libraryFile->tags->pluck('name')->all());

        // Delete removes DB record and private files
        $oldFilePath = $libraryFile->file_path;
        $oldCoverPath = $libraryFile->cover_path;

        $this->actingAs($admin)
            ->delete(route('admin.library.destroy', $libraryFile))
            ->assertRedirect(route('admin.library.index'));

        $this->assertDatabaseMissing('library_files', ['id' => $libraryFile->id]);
        Storage::disk('local')->assertMissing($oldFilePath);
        Storage::disk('local')->assertMissing($oldCoverPath);
    }

    public function test_disallowed_executable_or_svg_uploads_are_rejected(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $svgFile = UploadedFile::fake()->create('script.svg', 20, 'image/svg+xml');

        $this->actingAs($admin)
            ->post(route('admin.library.store'), [
                'title' => 'Arquivo Inseguro',
                'tags' => ['Estudos'],
                'file' => $svgFile,
            ])
            ->assertSessionHasErrors('file');
    }
}
