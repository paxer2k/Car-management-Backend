<?php
namespace Services;

use Repositories\CarRepository;
use Repositories\CategoryRepository;

class CarService {

    private $carRepository;

    function __construct()
    {
        $this->carRepository = new CarRepository();
    }

    public function getAllCars($offset = NULL, $limit = NULL) {
        return $this->carRepository->getAllCars($offset, $limit);
    }

    public function getAllCarsByUserId($userId, $offset = NULL, $limit = NULL) {
        return $this->carRepository->getAllCarsByUserId($userId, $offset, $limit);
    }

    public function getCarById($id) {
        return $this->carRepository->getCarById($id);
    }

    public function createCar($item) {       
        return $this->carRepository->createCar($item);        
    }

    public function updateCar($item, $id) {       
        return $this->carRepository->updateCar($item, $id);        
    }

    public function deleteCar($item) {       
        return $this->carRepository->deleteCar($item);        
    }
}

?>