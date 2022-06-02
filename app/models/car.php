<?php
namespace Models;

class Car {

    public int $id;
    public int $userId;
    public string $registrationNumber;
    public string $brand;
    public string $model;
    public int $year;
    public string $price;
    public string $image;
    public string $categoryId;
    public Category $category;
}

?>