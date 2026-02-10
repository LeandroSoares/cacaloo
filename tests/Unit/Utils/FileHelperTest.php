<?php

namespace Tests\Unit\Utils;

use App\Utils\FileHelper;
use PHPUnit\Framework\TestCase;

class FileHelperTest extends TestCase
{
    /**
     * Testa a obtenção da extensão de um arquivo.
     */
    public function test_get_extension()
    {
        $this->assertEquals('jpg', FileHelper::getExtension('image.jpg'));
        $this->assertEquals('pdf', FileHelper::getExtension('document.pdf'));
        $this->assertEquals('', FileHelper::getExtension('file_without_extension'));
        $this->assertEquals('php', FileHelper::getExtension('path/to/script.php'));
    }

    /**
     * Testa a verificação de existência de arquivo.
     */
    public function test_exists()
    {
        $this->assertTrue(FileHelper::exists(__FILE__));
        $this->assertFalse(FileHelper::exists('non_existent_file.txt'));
    }

    /**
     * Testa a formatação de tamanho de arquivo.
     */
    public function test_format_size()
    {
        $this->assertEquals('0 B', FileHelper::formatSize(0));
        $this->assertEquals('100 B', FileHelper::formatSize(100));
        $this->assertEquals('1 KB', FileHelper::formatSize(1024));
        $this->assertEquals('1.5 KB', FileHelper::formatSize(1536));
        $this->assertEquals('1 MB', FileHelper::formatSize(1048576));
        $this->assertEquals('1 GB', FileHelper::formatSize(1073741824));

        // Teste com precisão personalizada
        $this->assertEquals('1.33 KB', FileHelper::formatSize(1365));
        $this->assertEquals('1.3 KB', FileHelper::formatSize(1365, 1));
    }

    /**
     * Testa a criação de diretório temporário.
     */
    public function test_make_directory()
    {
        // Cria um diretório temporário único
        $tempDir = sys_get_temp_dir().'/test_dir_'.uniqid();

        try {
            // Verifica se o diretório foi criado
            $this->assertTrue(FileHelper::makeDirectory($tempDir));
            $this->assertTrue(is_dir($tempDir));

            // Tenta criar um diretório que já existe
            $this->assertTrue(FileHelper::makeDirectory($tempDir));

            // Testa a criação de diretório aninhado
            $nestedDir = $tempDir.'/nested/dir';
            $this->assertTrue(FileHelper::makeDirectory($nestedDir));
            $this->assertTrue(is_dir($nestedDir));
        } finally {
            // Limpa os diretórios criados
            if (is_dir($tempDir)) {
                $this->removeDirectory($tempDir);
            }
        }
    }

    /**
     * Testa a obtenção do tipo MIME.
     */
    public function test_get_mime_type()
    {
        // Testa um arquivo existente
        $this->assertEquals('text/x-php', FileHelper::getMimeType(__FILE__));

        // Testa um arquivo inexistente
        $this->assertFalse(FileHelper::getMimeType('non_existent_file.txt'));
    }

    /**
     * Função auxiliar para remover um diretório recursivamente.
     */
    private function removeDirectory(string $dir): bool
    {
        if (! is_dir($dir)) {
            return false;
        }

        $files = array_diff(scandir($dir), ['.', '..']);

        foreach ($files as $file) {
            $path = $dir.'/'.$file;

            if (is_dir($path)) {
                $this->removeDirectory($path);
            } else {
                unlink($path);
            }
        }

        return rmdir($dir);
    }
}
