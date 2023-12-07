<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection($this->categoryService->getAllCategories());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $category)
    {
        return new CategoryResource($this->categoryService->createCategory($category));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $categoryId)
    {
        return new CategoryResource($this->categoryService->getCategoryById($categoryId));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $category, string $categoryId)
    {
        return new CategoryResource($this->categoryService->updateCategory($categoryId, $category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $categoryId)
    {
        return $this->categoryService->deleteCategory($categoryId);
    }
}
