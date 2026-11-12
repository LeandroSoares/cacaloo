<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Indica que o teste deve desabilitar a proteção CSRF.
     * Necessário para testes de formulários.
     */
    protected function withoutCsrf()
    {
        return $this->withoutMiddleware(VerifyCsrfToken::class);
    }
}
