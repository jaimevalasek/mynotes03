<?php

namespace Tests\Feature\Note;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreTest extends TestCase
{
    private function storeNote(Note $note): TestResponse
    {
        $note = $note ?? collect([]);

        return $this->post(route('notes.store'), $note->toArray());
    }

    /** @test */
    public function it_should_be_authenticated()
    {
        $this->post(route('notes.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function it_should_be_able_to_create_a_note_item_and_redirect_to_show_page()
    {
        /** @var User $user */
        $user = $this->user()->createOne();

        /** @var Note $note */
        $note = $this->note()->make();

        $response = $this->actingAs($user)
            ->storeNote($note);

        $this->assertDatabaseHas('notes', [
            'name' => $note->name,
            'description' => $note->description,
            'status' => $note->status
        ]);

        $note = Note::first();
        $response->assertRedirect(route('notes.show', $note));
        
    }

    /** @test */
    public function name_field_is_required()
    {
        /** @var User $user */
        $user = $this->user()->createOne();

        /** @var Note $note */
        $note = $this->note()->setName(null)->make();

        $this->actingAs($user)
            ->storeNote($note)
            ->assertSessionHasErrors([
                'name' => trans('validation.required', ['attribute' => 'name'])
            ]);

    }

    /** @test */
    public function description_field_is_optional()
    {
        /** @var User $user */
        $user = $this->user()->createOne();

        /** @var Note $note */
        $note = $this->note()->setDescription(null)->make();

        $this->actingAs($user)->storeNote($note);
            
        //dd($note);
        
        $this->assertDatabaseHas($note->getTable(), [
            'name' => $note->name,
            'description' => null
        ]);

    }

    /** @test */
    public function status_field_is_boolean()
    {
        /** @var User $user */
        $user = $this->user()->createOne();

        /** @var Note $note */
        $note = $this->note()->setStatus('string')->make();

        $this->actingAs($user)
            ->storeNote($note)
            ->assertSessionHasErrors([
                'status' => trans('validation.boolean', ['attribute' => 'status'])
            ]);

    }
}
