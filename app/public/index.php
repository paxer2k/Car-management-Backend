<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

// routes for the cars endpoint
$router->get('/cars', 'CarController@getAllCars');
$router->get('/cars/(\d+)', 'CarController@getCarById');
$router->get('/cars/users/(\d+)', 'CarController@getAllCarsByUserId');
$router->post('/cars', 'CarController@createCar');
$router->put('/cars/(\d+)', 'CarController@updateCar');
$router->delete('/cars/(\d+)', 'CarController@deleteCar');

// routes for the categories endpoint
$router->get('/categories', 'CategoryController@getAllCategories');
$router->get('/categories/(\d+)', 'CategoryController@getCategoryById');
$router->post('/categories', 'CategoryController@createCategory');
$router->put('/categories/(\d+)', 'CategoryController@updateCategory');
$router->delete('/categories/(\d+)', 'CategoryController@deleteCategory');

// route for the login endpoint
$router->post('/users/login', 'UserController@login');

// Run it!
$router->run();