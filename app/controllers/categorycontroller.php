<?php

namespace Controllers;

use Exception;
use Services\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;

    // initialize services
    function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function getAllCategories()
    {
        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $categories = $this->categoryService->getAllCategories($offset, $limit);

        $this->respond($categories);
    }

    public function getCategoryById($id)
    {
        $category = $this->categoryService->getCategoryById($id);

        // we might need some kind of error checking that returns a 404 if the product is not found in the DB
        if (!$category) {
            $this->respondWithError(404, "Category not found");
            return;
        }

        $this->respond($category);
    }

    public function createCategory()
    {
        try {
            $category = $this->createObjectFromPostedJson("Models\\Category");
            $this->categoryService->createCategory($category);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($category);
    }

    public function updateCategory($id)
    {
        try {
            $category = $this->createObjectFromPostedJson("Models\\Category");
            $this->categoryService->updateCategory($category, $id);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($category);
    }

    public function deleteCategory($id)
    {
        try {
            $this->categoryService->deleteCategory($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond(true);
    }
}
