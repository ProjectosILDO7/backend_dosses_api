<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Repositories\User\UserRepository;

class RegisterControllerUser extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repo)
    {
        $this->repository = $repo;
    }
    public function crear(RegisterUserRequest $request)
    {
       return $this->repository->save($request);
    } 
    
    public function updateUser(updateUserRequest $request){
        return $this->repository->updateUser($request);
    }
}
