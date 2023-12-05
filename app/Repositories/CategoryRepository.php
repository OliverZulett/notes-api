<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
  public function getAll()
  {
    return Category::all();
  }

  public function create($categoryData)
  {
    return Category::create($categoryData);
  }

  public function getById($categoryId)
  {
    return Category::findOrFail($categoryId);
  }

  public function update($categoryId, $categoryData)
  {
    $category = $this->getById($categoryId);
    $category->update($categoryData);
    return $category;
  }

  public function delete($categoryId)
  {
    $category = $this->getById($categoryId);
    $category->delete();
  }
}
