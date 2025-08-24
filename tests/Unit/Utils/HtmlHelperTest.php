<?php

namespace Tests\Unit\Utils;

use App\Utils\HtmlHelper;
use PHPUnit\Framework\TestCase;

class HtmlHelperTest extends TestCase
{
    /**
     * Testa o escape de HTML.
     */
    public function test_escape()
    {
        $this->assertEquals('&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', HtmlHelper::escape('<script>alert("XSS")</script>'));
        $this->assertEquals('&amp;', HtmlHelper::escape('&'));
        $this->assertEquals('John &amp; Jane', HtmlHelper::escape('John & Jane'));
    }

    /**
     * Testa a criação de links HTML.
     */
    public function test_link()
    {
        // Link simples
        $this->assertEquals(
            '<a href="https://example.com">Example</a>',
            HtmlHelper::link('https://example.com', 'Example')
        );

        // Link com atributos
        $this->assertEquals(
            '<a href="https://example.com" class="btn" target="_blank">Example</a>',
            HtmlHelper::link('https://example.com', 'Example', [
                'class' => 'btn',
                'target' => '_blank'
            ])
        );

        // Link com caracteres especiais
        $this->assertEquals(
            '<a href="https://example.com?q=test&amp;page=1">Example &amp; Test</a>',
            HtmlHelper::link('https://example.com?q=test&page=1', 'Example & Test')
        );
    }

    /**
     * Testa a criação de imagens HTML.
     */
    public function test_image()
    {
        // Imagem simples
        $this->assertEquals(
            '<img src="image.jpg" alt="Image">',
            HtmlHelper::image('image.jpg', 'Image')
        );

        // Imagem com atributos
        $this->assertEquals(
            '<img src="image.jpg" alt="Image" class="thumbnail" width="100" height="100">',
            HtmlHelper::image('image.jpg', 'Image', [
                'class' => 'thumbnail',
                'width' => '100',
                'height' => '100'
            ])
        );

        // Imagem sem texto alternativo
        $this->assertEquals(
            '<img src="image.jpg" alt="">',
            HtmlHelper::image('image.jpg')
        );
    }

    /**
     * Testa a criação de listas HTML.
     */
    public function test_list()
    {
        // Lista não ordenada
        $this->assertEquals(
            '<ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>',
            HtmlHelper::list(['Item 1', 'Item 2', 'Item 3'])
        );

        // Lista ordenada
        $this->assertEquals(
            '<ol><li>Item 1</li><li>Item 2</li><li>Item 3</li></ol>',
            HtmlHelper::list(['Item 1', 'Item 2', 'Item 3'], 'ol')
        );

        // Lista com atributos
        $this->assertEquals(
            '<ul class="menu"><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>',
            HtmlHelper::list(['Item 1', 'Item 2', 'Item 3'], 'ul', ['class' => 'menu'])
        );

        // Tipo de lista inválido (deve usar ul como padrão)
        $this->assertEquals(
            '<ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>',
            HtmlHelper::list(['Item 1', 'Item 2', 'Item 3'], 'invalid')
        );
    }

    /**
     * Testa a criação de tabelas HTML.
     */
    public function test_table()
    {
        // Tabela simples
        $headers = ['Name', 'Age', 'Email'];
        $rows = [
            ['John', '30', 'john@example.com'],
            ['Jane', '25', 'jane@example.com']
        ];

        $expected = '<table>' .
            '<thead><tr><th>Name</th><th>Age</th><th>Email</th></tr></thead>' .
            '<tbody><tr><td>John</td><td>30</td><td>john@example.com</td></tr>' .
            '<tr><td>Jane</td><td>25</td><td>jane@example.com</td></tr></tbody>' .
            '</table>';

        $this->assertEquals($expected, HtmlHelper::table($headers, $rows));

        // Tabela com atributos
        $expected = '<table class="data-table" border="1">' .
            '<thead><tr><th>Name</th><th>Age</th><th>Email</th></tr></thead>' .
            '<tbody><tr><td>John</td><td>30</td><td>john@example.com</td></tr>' .
            '<tr><td>Jane</td><td>25</td><td>jane@example.com</td></tr></tbody>' .
            '</table>';

        $this->assertEquals(
            $expected,
            HtmlHelper::table($headers, $rows, [
                'class' => 'data-table',
                'border' => '1'
            ])
        );

        // Tabela sem cabeçalho
        $expected = '<table>' .
            '<tbody><tr><td>John</td><td>30</td><td>john@example.com</td></tr>' .
            '<tr><td>Jane</td><td>25</td><td>jane@example.com</td></tr></tbody>' .
            '</table>';

        $this->assertEquals($expected, HtmlHelper::table([], $rows));

        // Tabela sem linhas
        $expected = '<table>' .
            '<thead><tr><th>Name</th><th>Age</th><th>Email</th></tr></thead>' .
            '</table>';

        $this->assertEquals($expected, HtmlHelper::table($headers, []));
    }
}
