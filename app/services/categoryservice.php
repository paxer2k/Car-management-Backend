<?php
namespace Services;

use Repositories\CategoryRepository;

class CategoryService {

    private $categoryRepository;

    function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function getAllCategories($offset = NULL, $limit = NULL) {
        return $this->categoryRepository->getAllCategories($offset, $limit);
    }

    public function getCategoryById($id) {
        return $this->categoryRepository->getCategoryById($id);
    }

    public function createCategory($item) {       
        return $this->categoryRepository->createCategory($item);        
    }

    public function updateCategory($item, $id) {       
        return $this->categoryRepository->updateCategory($item, $id);        
    }

    public function deleteCategory($item) {       
        return $this->categoryRepository->deleteCategory($item);        
    }
}

?>