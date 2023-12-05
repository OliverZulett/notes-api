<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Services\NoteService;

class NoteController extends Controller
{
    protected $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NoteResource::collection($this->noteService->getAllNotes());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $note)
    {
        return new NoteResource($this->noteService->createNote($note));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $noteId)
    {
        return new NoteResource($this->noteService->getNoteById($noteId));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $note, string $noteId)
    {
        return new NoteResource($this->noteService->updateNote($noteId, $note));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $noteId)
    {
        return $this->noteService->deleteNote($noteId);
    }
}
