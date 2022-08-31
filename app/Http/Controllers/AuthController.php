<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormat;
use App\Repositories\Authentication\AuthenticationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * @var AuthenticationRepositoryInterface
     */
    private $auth;

    public function __construct(
        AuthenticationRepositoryInterface $authenticationRepository
    )
    {
        $this->auth = $authenticationRepository;
    }

    public function registerUser(Request $request)
    {
        $data = $request->only('name', 'role', 'email', 'device_id', 'address', 'password', 'avatar');
        $output = $this->auth->userRegister($data);
        if ($output)
            return ResponseFormat::successResponse($output, 200);
        else
            return ResponseFormat::failResponse('something went wrong', 500);
    }

    public function login()
    {
        if (!Auth::user()) {
            return view('auth.login');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function webLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'email' => 'Credentials does not match',
            ]);
        }
    }

    public function webLogout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');

    }

    public function register()
    {
        return view('auth.register');
    }
}
