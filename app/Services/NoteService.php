<?php

namespace App\Services;

use App\Repositories\NoteRepository;
use Exception;
use Illuminate\Database\QueryException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NoteService
{
  protected $noteRepository;

  public function __construct(NoteRepository $noteRepository)
  {
    $this->noteRepository = $noteRepository;
  }

  public function getAllNotes()
  {
    return $this->noteRepository->getAll();
  }

  public function createNote($note)
  {
    try {
      return $this->noteRepository->create([
        'title' => $note->title,
        'content' => $note->content,
        'user_id' => $note->user_id,
      ]);
    } catch (Exception $e) {
      throw new BadRequestException($e->getMessage());
    }
  }

  public function getNoteById($noteId)
  {
    try {
      return $this->noteRepository->getById($noteId);
    } catch (Exception $e) {
      throw new NotFoundHttpException($e->getMessage());
    }
  }

  public function updateNote($noteId, $note)
  {
    try {
      $this->getNoteById($noteId);
      return $this->noteRepository->update($noteId, [
        'title' => $note->title,
        'content' => $note->content,
        'user_id' => $note->user_id,
      ]);
    } catch (Exception $e) {
      throw new BadRequestException($e->getMessage());
    }
  }

  public function deleteNote($noteId)
  {
    try {
      $this->noteRepository->delete($noteId);
    } catch (QueryException $e) {
      throw new InternalErrorException($e->getMessage());
    } catch (Exception $e) {
      throw new NotFoundHttpException($e->getMessage());
    }
  }
}
