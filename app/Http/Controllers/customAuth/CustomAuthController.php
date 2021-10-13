<?php

namespace App\Http\Controllers\customAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\SuperAdminRequest;
use App\Http\Requests\user\UserLoginRequest;
use App\Http\Requests\user\UserRequest;
use App\Repository\user\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->role_id == '1') {
                return redirect()->route('topics');
            }
            else{
                Session::flush();
                Auth::logout();
                return redirect()->route('login');
            }

        } else {
            return back()->withErrors([
                'email' => 'Credentials do not match',
            ]);
        }

    }

    public function superAdminRegister(SuperAdminRequest $request)
    {
        return $this->user->superAdminRegister($request->all());
    }

}
