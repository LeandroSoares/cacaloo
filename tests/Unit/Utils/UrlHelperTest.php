<?php

namespace Tests\Unit\Utils;

use App\Utils\UrlHelper;
use PHPUnit\Framework\TestCase;

class UrlHelperTest extends TestCase
{
    /**
     * Testa a validação de URL.
     */
    public function test_is_valid()
    {
        // URLs válidas
        $this->assertTrue(UrlHelper::isValid('https://example.com'));
        $this->assertTrue(UrlHelper::isValid('http://example.com/path'));
        $this->assertTrue(UrlHelper::isValid('https://example.com:8080/path?query=value#fragment'));
        $this->assertTrue(UrlHelper::isValid('ftp://user:password@example.com'));

        // URLs inválidas
        $this->assertFalse(UrlHelper::isValid('example.com'));
        $this->assertFalse(UrlHelper::isValid('https://'));
        $this->assertFalse(UrlHelper::isValid('http:/example.com'));
        $this->assertFalse(UrlHelper::isValid('://example.com'));
    }

    /**
     * Testa a obtenção do esquema de uma URL.
     */
    public function test_get_scheme()
    {
        $this->assertEquals('https', UrlHelper::getScheme('https://example.com'));
        $this->assertEquals('http', UrlHelper::getScheme('http://example.com'));
        $this->assertEquals('ftp', UrlHelper::getScheme('ftp://example.com'));

        // URL inválida
        $this->assertNull(UrlHelper::getScheme('example.com'));
    }

    /**
     * Testa a obtenção do host de uma URL.
     */
    public function test_get_host()
    {
        $this->assertEquals('example.com', UrlHelper::getHost('https://example.com'));
        $this->assertEquals('example.com', UrlHelper::getHost('http://example.com/path'));
        $this->assertEquals('sub.example.com', UrlHelper::getHost('https://sub.example.com:8080'));

        // URL inválida
        $this->assertNull(UrlHelper::getHost('example.com'));
    }

    /**
     * Testa a obtenção do caminho de uma URL.
     */
    public function test_get_path()
    {
        $this->assertEquals('/', UrlHelper::getPath('https://example.com'));
        $this->assertEquals('/path', UrlHelper::getPath('http://example.com/path'));
        $this->assertEquals('/path/to/resource', UrlHelper::getPath('https://example.com/path/to/resource'));
        $this->assertEquals('/path', UrlHelper::getPath('https://example.com/path?query=value'));

        // URL inválida
        $this->assertNull(UrlHelper::getPath('example.com'));
    }

    /**
     * Testa a obtenção da query string de uma URL.
     */
    public function test_get_query()
    {
        $this->assertNull(UrlHelper::getQuery('https://example.com'));
        $this->assertEquals('query=value', UrlHelper::getQuery('https://example.com?query=value'));
        $this->assertEquals('q=test&page=1', UrlHelper::getQuery('https://example.com/search?q=test&page=1'));

        // URL inválida
        $this->assertNull(UrlHelper::getQuery('example.com'));
    }

    /**
     * Testa a obtenção de um parâmetro da query string.
     */
    public function test_get_query_param()
    {
        $this->assertNull(UrlHelper::getQueryParam('https://example.com', 'query'));
        $this->assertEquals('value', UrlHelper::getQueryParam('https://example.com?query=value', 'query'));
        $this->assertEquals('test', UrlHelper::getQueryParam('https://example.com/search?q=test&page=1', 'q'));
        $this->assertEquals('1', UrlHelper::getQueryParam('https://example.com/search?q=test&page=1', 'page'));
        $this->assertNull(UrlHelper::getQueryParam('https://example.com/search?q=test&page=1', 'missing'));

        // URL inválida
        $this->assertNull(UrlHelper::getQueryParam('example.com', 'query'));
    }

    /**
     * Testa a construção de uma URL com parâmetros de query string.
     */
    public function test_build_query()
    {
        // URL sem query string
        $this->assertEquals('https://example.com?param=value', UrlHelper::buildQuery('https://example.com', ['param' => 'value']));

        // URL com query string existente
        $this->assertEquals('https://example.com?query=value&param=value2', UrlHelper::buildQuery('https://example.com?query=value', ['param' => 'value2']));

        // Sobrescrever parâmetro existente
        $this->assertEquals('https://example.com?query=new_value', UrlHelper::buildQuery('https://example.com?query=value', ['query' => 'new_value']));

        // URL com caminho, porta e fragmento
        $this->assertEquals('https://example.com:8080/path?param=value#fragment', UrlHelper::buildQuery('https://example.com:8080/path#fragment', ['param' => 'value']));

        // URL com credenciais
        $this->assertEquals('https://user:pass@example.com?param=value', UrlHelper::buildQuery('https://user:pass@example.com', ['param' => 'value']));

        // URL inválida
        $this->assertEquals('invalid-url', UrlHelper::buildQuery('invalid-url', ['param' => 'value']));
    }
}
