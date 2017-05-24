<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function getCurrent()
    {
        return response()->json(Auth::user()->toJson());
    }
}
