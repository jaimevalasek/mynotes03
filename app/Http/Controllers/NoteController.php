<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteStoreRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /** @var Note $note */
    private $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * @return Response
     */
    public function home(Request $request)
    {        
        $auth = Auth::user();

        $notes = $this->note->query();
        $notes->where('user_id', $auth->id);
        $notes->when($request->search, function($query, $val) {
            $query->where('name', 'like', '%' . $val . '%');
        });

        $notes = $notes->get();

        return view('notes.home', ['notes' => $notes]);
    }

    /**
     * @return Response
     */
    public function index()
    {
        $auth = Auth::user();
        $notes = $this->note->where('user_id', $auth->id)->get();

        return view('notes.index', ['notes' => $notes]);
    }

    /**
     * @return Response
     */
    public function create()
    {
        /* $note = new Note();
        
        return view('notes.create', ['note' => $note]); */
        return view('notes.create');
    }

    /**
     * @param NoteStoreRequest $request
     * @return Response
     */
    public function store(NoteStoreRequest $request)
    {
        $auth = Auth::user();

        $input = $request->validated();
        $input['user_id'] = $auth->id;

        $note = Note::create($input);

        return redirect()->to(route('notes.show', $note));
    }

    public function edit(Note $note)
    {
        //dd($note);
        return view('notes.edit', ['note' => $note]);
    }

    /**
     * @param NoteStoreRequest $request
     * @param int $id
     * @return Response
     */
    public function update($id, NoteStoreRequest $request)
    {
        $auth = Auth::user();

        // Validation for required fields (and using some regex to validate our numeric value)
        $input = $request->validated();

        if (!Note::where('id', $id)->where('user_id', $auth->id)->get()) {
            return redirect('/notes')->with('error', 'Esta nota não pode ser alterada.');
        }
     
        /** @var Note @note */
        $note = Note::find($id);

        // Getting values from the blade template form
        $note->fill($input);
        $note->save();
 
        return redirect('/notes')->with('success', 'Nota atualizada.');


    }
    
    public function show(Note $note)
    {
        return view('notes.show', ['note' => $note]);
    }

    public function destroy($id)
    {
        $auth = Auth::user();

        if (!Note::where('id', $id)->where('user_id', $auth->id)->get()) {
            return redirect('/notes')->with('error', 'Esta nota não pode ser excluida.');
        }

        Note::find($id)->delete();

        return redirect('/notes')->with('success', 'Nota excluída com sucesso.');
    }
}
