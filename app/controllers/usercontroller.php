<?php

namespace Controllers;

use Exception;
use Services\UserService;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->userService = new UserService();
    }

    public function login() {
        try {
            $postedUser = $this->createObjectFromPostedJson("Models\\User");

            $user = $this->userService->authenticateUser($postedUser->username, $postedUser->password);

            if(!$user) {

                $this->respondWithError(401, "Invalid credentials");
                return;
            }


            $this->authenticateUser($user);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    function authenticateUser($user) {
        $key = "thismustbesecret";

        $issuer = "http://localhost";
        $audience = "http://localhost";
        $issuedAt = time();
        $notBefore = $issuedAt;
        $expire = $issuedAt + 600;

        $payload = array(
            "iss" => $issuer,
            "aud" => $audience,
            "iat" => $issuedAt,
            "nbf" => $notBefore,
            "exp" => $expire,
            "data" => array(
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "role" => $user->role
            ));

        $jwt = JWT::encode($payload, $key, 'HS256');

        $this->respond([
            "id" => $user->id,
            "username" => $user->username,
            "token" => $jwt,
            "role" => $user->role
        ]);
    }

}