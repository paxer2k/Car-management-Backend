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

// routes for the products endpoint
$router->get('/products', 'ProductController@getAll');
$router->get('/products/(\d+)', 'ProductController@getOne');
$router->post('/products', 'ProductController@create');
$router->put('/products/(\d+)', 'ProductController@update');
$router->delete('/products/(\d+)', 'ProductController@delete');

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

$router->post('/users/login', 'UserController@login');

// Run it!
$router->run();