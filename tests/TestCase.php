<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    
    protected function setUp(): void
    {
        parent::setUp();

        // Esto le dice a Laravel: "No busques el manifest.json de Vite"
        // Evita el error 500 que estás recibiendo en GitHub
        if (class_exists(\Illuminate\Foundation\Vite::class)) {
            $this->withoutVite();
        }
    }
}