<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NoteResource::collection(Note::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        return $note->delete();
    }
}
