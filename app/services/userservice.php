<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    function authenticateUser($username, $password)
    {
        return $this->repository->checkUsernamePassword($username, $password);
    }

}