<?php

namespace Controllers;

use Exception;
use Services\CarService;

class CarController extends Controller
{
    private $carService;

    // initialize services
    function __construct()
    {
        $this->carService = new CarService();
    }

    public function getAllCars()
    {
        $jwt = $this->checkToken();
        if (!$jwt) 
            return;        

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $cars = $this->carService->getAllCars($offset, $limit);

        $this->respond($cars);
    }

    public function getAllCarsByUserId($userId)
    {
        $jwt = $this->checkToken();
        if (!$jwt)
            return;

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $cars = $this->carService->getAllCarsByUserId($userId, $offset, $limit);

        $this->respond($cars);
    }

    public function getCarById($id)
    {
        $jwt = $this->checkToken();
        if (!$jwt)
            return;

        $car = $this->carService->getCarById($id);

        // we might need some kind of error checking that returns a 404 if the product is not found in the DB
        if (!$car) {
            $this->respondWithError(404, "Car not found");
            return;
        }

        $this->respond($car);
    }

    public function createCar()
    {
        $jwt = $this->checkToken();
        if (!$jwt)
            return;

        $car = $this->createObjectFromPostedJson("Models\\Car");

        if (!$car->registrationNumber) {
            $this->respondWithError(422, "Please fill out registration number!");
            return;
        }


        if (!$car->brand) {
            $this->respondWithError(422, "Please fill out the brand");
            return;
        }

        if (!$car->model) {
            $this->respondWithError(422, "Please fill out the model");
            return;
        }

        if (!$car->year) {
            $this->respondWithError(422, "Please fill out the year");
            return;
        }

        if (!$car->price) {
            $this->respondWithError(422, "Please fill out the price");
            return;
        }

        if (!$car->categoryId) {
            $this->respondWithError(422, "Please fill out the image category");
            return;
        }

        if (!$car->image) {
            $this->respondWithError(422, "Please fill out the image url");
            return;
        }

        try {

            $car = $this->carService->createCar($car);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($car);
    }

    public function updateCar($id)
    {   
        $jwt = $this->checkToken();
        if (!$jwt)
            return;

        $car = $this->createObjectFromPostedJson("Models\\Car");
        
        if (!$car->registrationNumber) {
            $this->respondWithError(422, "Please fill out registration number!");
            return;
        }

        if (!$car->brand) {
            $this->respondWithError(422, "Please fill out the brand");
            return;
        }

        if (!$car->model) {
            $this->respondWithError(422, "Please fill out the model");
            return;
        }

        if (!$car->year) {
            $this->respondWithError(422, "Please fill out the year");
            return;
        }

        if (!$car->price) {
            $this->respondWithError(422, "Please fill out the price");
            return;
        }

        if (!$car->categoryId) {
            $this->respondWithError(422, "Please fill out the image category");
            return;
        }

        if (!$car->image) {
            $this->respondWithError(422, "Please fill out the image url");
            return;
        }

        try {

            $car = $this->carService->updateCar($car, $id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($car);
    }

    public function deleteCar($id)
    {
        $jwt = $this->checkToken();
        if (!$jwt)
            return;
            
        try {

            $this->carService->deleteCar($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond("Car with the id: {$id} has been deleted!");
    }
}
