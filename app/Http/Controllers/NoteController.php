<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        return view('notes.index');
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|unique:notes',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $note = Note::create($validated);

        return redirect()->to(route('notes.show', $note));
    }

    public function show()
    {
        dd('notes.show');
    }
}
