<?php 

namespace Tests\Builders;

use App\Models\Note;

class NoteBuilder
{
    protected $attributes = [];

    public function setName($name): self
    {
        $this->attributes['name'] = $name;

        return $this;
    }
    
    public function setDescription($description): self
    {
        $this->attributes['description'] = $description;

        return $this;
    }
    
    public function setStatus($status): self
    {
        $this->attributes['status'] = $status;

        return $this;
    }

    public function createOne()
    {
        return Note::factory()->createOne($this->attributes);
    }

    public function create()
    {
        return Note::factory()->create($this->attributes);
    }

    public function make()
    {
        return Note::factory()->make($this->attributes);
    }
}