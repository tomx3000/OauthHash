<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response

     */
    public function __construct()
    {
        $this->middleware('web');
    }
    public function authenticate($param1)
    {
        if (Auth::attempt(['name' => 'thomas', 'password' => 'lectio'],true)) {
            return redirect('/home');
        }else return Response::json("Auth failed");
    }
}