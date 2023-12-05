<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Database\QueryException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryService
{
  protected $categoryRepository;

  public function __construct(CategoryRepository $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }

  public function getAllCategories()
  {
    return $this->categoryRepository->getAll();
  }

  public function createCategory($category)
  {
    try {
      return $this->categoryRepository->create([
        'name' => $category->name,
        'description' => $category->description,
      ]);
    } catch (Exception $e) {
      throw new BadRequestException($e->getMessage());
    }
  }

  public function getCategoryById($categoryId)
  {
    try {
      return $this->categoryRepository->getById($categoryId);
    } catch (Exception $e) {
      throw new NotFoundHttpException($e->getMessage());
    }
  }

  public function updateCategory($categoryId, $category)
  {
    try {
      $this->getCategoryById($categoryId);
      return $this->categoryRepository->update($categoryId, [
        'name' => $category->name,
        'description' => $category->description,
      ]);
    } catch (Exception $e) {
      throw new BadRequestException($e->getMessage());
    }
  }

  public function deleteCategory($categoryId)
  {
    try {
      $this->categoryRepository->delete($categoryId);
    } catch (QueryException $e) {
      throw new InternalErrorException($e->getMessage());
    } catch (Exception $e) {
      throw new NotFoundHttpException($e->getMessage());
    }
  }
}
