<?php

namespace App\Http\Controllers\customAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserRequest;
use App\Repository\user\UserRepositoryInterface;
use Illuminate\Http\Request;

class CustomAuthController extends Controller
{

    /**
     * @var UserRepositoryInterface
     */
    private $user;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->user = $repository;
    }

    public function Authorization(UserRequest $request)
    {
        try {
            $data = $request->only('name', 'email', 'phone', 'uid', 'password','profile_url');
            $output = $this->user->register($data);
            if ($output) {
                return ['status' => true, 'data' => $output];
            } else {
                return ['status' => false, 'message' => 'something went wrong'];
            }
        } catch (\Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

}
