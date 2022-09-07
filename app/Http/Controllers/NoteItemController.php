<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteItemStoreRequest;
use App\Models\Note;
use App\Models\NoteItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NoteItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * @var Note @note
     */
    public function index(Note $note)
    {
        $noteItems = NoteItem::where('note_id', $note->id)->get();
        
        return view('notes.note-items.index', [
            'note' => $note,
            'noteItems' => $noteItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     
     * @param  Note $note
     * @return \Illuminate\Http\Response
     */
    public function create(Note $note)
    {
        $noteItem = new NoteItem();

        return view('notes.note-items.create', [
            'note' => $note,
            'noteItem' => $noteItem,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Note  $note
     * @param  NoteItemStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Note $note, NoteItemStoreRequest $request)
    {
        $auth = Auth::user();

        if ($auth->id != $note->user_id) {
            return redirect("/notes/$note->id/note-items")->with('error', 'Erro de permissão de cadastro para este usuário.');
        }
        
        $input = $request->validated();
        $input['note_id'] = $note->id;
        
        $input = NoteItem::create($input);

        return redirect()->to(route('note-items.show', [$note->id, $input->id]));
    }

    /**
     * Display the specified resource.
     * @param  int  $noteId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($noteId, $id)
    {
        $noteItem = NoteItem::where('note_id', $noteId)
            ->where('id', $id)
            ->first();
        
        return view('notes.note-items.show', ['noteItem' => $noteItem]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Note  $note
     * @param  NoteItem  $noteItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note, NoteItem $noteItem)
    {
        return view('notes.note-items.edit', [
            'note' => $note,
            'noteItem' => $noteItem
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Note  $note
     * @param  int  $id
     * @param  NoteItemStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Note $note, NoteItem $noteItem, NoteItemStoreRequest $request)
    {
        $input = $request->validated();

        $noteItem->fill($input);
        $noteItem->save();

        return Redirect::route('note-items.index', $note->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Note  $note
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note, $id)
    {
        /** @var Auth $auth */
        $auth = Auth::user();

        $noteItem = NoteItem::find($id);

        if (!($auth->id == $note->users_id) && ($note->id == $noteItem->note_id)) {
            return redirect('/notes')->with('error', 'Esta anotação não pode ser excluida, erro de permissão.');
        }

        $noteItem->delete();

        return redirect()->to(route('note-items.index', $note->id));
    }
}
