<?php

namespace Repositories;

use Models\Car;
use Models\Category;
use PDO;
use PDOException;
use Repositories\Repository;

class CarRepository extends Repository
{
    function getAllCars($offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT car.*, category.name AS categoryName FROM car INNER JOIN category ON car.categoryId = category.id";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $cars = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {               
                $cars[] = $this->rowToCar($row);
            }

            return $cars;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllCarsByUserId($userId, $offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT car.*, category.name AS categoryName FROM car INNER JOIN category ON car.categoryId = category.id WHERE car.userId = :id";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            $cars = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {               
                $cars[] = $this->rowToCar($row);
            }

            return $cars;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getCarById($id)
    {
        try {
            $query = "SELECT car.*, category.name AS categoryName FROM car INNER JOIN category ON car.categoryId = category.id WHERE car.id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $car = $this->rowToCar($row);

            return $car;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function rowToCar($row) {
        $car = new Car();
        $car->id = $row['id'];
        $car->userId = $row['userId'];
        $car->registrationNumber = $row['registrationNumber'];
        $car->brand = $row['brand'];
        $car->model = $row['model'];
        $car->year = $row['year'];
        $car->price = $row['price'];
        $car->image = $row['image'];
        $car->categoryId = $row['categoryId'];

        $category = new Category();
        $category->id = $row['categoryId'];
        $category->name = $row['categoryName'];

        $car->category = $category;

        return $car;
    }

    function createCar($car)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO car (userId, registrationNumber, brand, model, year, price, image, categoryId) VALUES (?,?,?,?,?,?,?,?)");

            $stmt->execute([$car->userId, $car->registrationNumber, $car->brand, $car->model, $car->year, $car->price, $car->image, $car->categoryId]);

            $car->id = $this->connection->lastInsertId();

            return $this->getCarById($car->id);
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function updateCar($car, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE car SET registrationNumber = ?, brand = ?, model = ?, year = ?, price = ?, image = ?, categoryId = ? WHERE id = ?");

            $stmt->execute([$car->registrationNumber, $car->brand, $car->model, $car->year, $car->price, $car->image, $car->categoryId, $id]);

            $car->id = $id; //ask teacher cause i dont wanna fail

            return $this->getCarById($car->id);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function deleteCar($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM car WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
