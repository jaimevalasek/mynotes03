<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Builders\NoteBuilder;
use Tests\Builders\UserBuilder;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function user()
    {
        return new UserBuilder;
    }

    public function note()
    {
        return new NoteBuilder;
    }
}
