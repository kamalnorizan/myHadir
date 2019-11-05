<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiUserController extends Controller
{
    public $successStatus = 200;

    public function show(User $user)
    {
        return response()->json(['user' => $user], $this->successStatus);
    }
}
