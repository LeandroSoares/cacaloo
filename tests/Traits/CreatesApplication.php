<?php

namespace Tests\Traits;

use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        return require_once __DIR__.'/../../bootstrap/app.php';
    }
}
