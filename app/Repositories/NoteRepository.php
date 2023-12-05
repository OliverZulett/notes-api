<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository
{
  public function getAll()
  {
    return Note::all();
  }

  public function create($noteData)
  {
    return Note::create($noteData);
  }

  public function getById($noteId)
  {
    return Note::findOrFail($noteId);
  }

  public function update($noteId, $noteData)
  {
    $note = $this->getById($noteId);
    $note->update($noteData);
    return $note;
  }

  public function delete($noteId)
  {
    $note = $this->getById($noteId);
    $note->delete();
  }
}
