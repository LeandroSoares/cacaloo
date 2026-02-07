<?php

namespace Database\Seeders;

use App\Enums\ContentType;
use App\Enums\ContentVisibility;
use App\Models\Content;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $basePath = base_path('docs/conteudos');

        if (!File::exists($basePath)) {
            $this->command->warn("Diretório $basePath não encontrado. Pulando seed de conteúdos.");
            return;
        }

        // 1. Institucionais (Raiz)
        $files = File::files($basePath);
        foreach ($files as $file) {
            if ($file->getExtension() !== 'txt')
                continue;

            $this->createContent($file, ContentType::INSTITUCIONAL);
        }

        // 2. Trabalhos Espirituais (Subpasta)
        $trabalhosPath = $basePath . '/trabalhos';
        if (File::exists($trabalhosPath)) {
            $files = File::files($trabalhosPath);
            foreach ($files as $file) {
                if ($file->getExtension() !== 'txt')
                    continue;

                $this->createContent($file, ContentType::TRABALHO, ContentVisibility::PRIVATE);
            }
        }
    }

    private function createContent($file, ContentType $type, ContentVisibility $contentVisibility = ContentVisibility::PUBLIC)
    {
        $filename = $file->getFilenameWithoutExtension();
        $title = Str::title(str_replace('-', ' ', $filename));
        $slug = Str::slug($title);
        $body = File::get($file->getPathname());

        // Converte quebras de linha em <p> para o Trix/HTML se for texto puro
        // Se já tiver tags HTML, mantém. Simples nl2br wrap.
        $htmlBody = $this->formatBody($body);

        Content::updateOrCreate(
            ['slug' => $slug],
            [
                'title' => $title,
                'body' => $htmlBody,
                'type' => $type,
                'visibility' => $contentVisibility,
                'published_at' => now(),
                'is_active' => true,
            ]
        );

        $this->command->info("Conteúdo criado/atualizado: $title");
    }

    private function formatBody($text)
    {
        // Detecção básica se já é HTML
        if (strip_tags($text) !== $text) {
            return $text;
        }

        // Converte parágrafos de texto puro para HTML
        $paragraphs = explode("\n\n", $text);
        return implode('', array_map(fn($p) => "<p>" . nl2br(trim($p)) . "</p>", $paragraphs));
    }
}
