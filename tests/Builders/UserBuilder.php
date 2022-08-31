<?php 

namespace Tests\Builders;

use App\Models\User;

class UserBuilder
{
    protected $attributes = [];

    public function setName($name): self
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    public function createOne()
    {
        return User::factory()->createOne($this->attributes);
    }

    public function create()
    {
        return User::factory()->create($this->attributes);
    }

    public function make()
    {
        return User::factory()->make($this->attributes);
    }
}