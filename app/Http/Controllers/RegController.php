<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegController extends Controller
{
    public function reg(Request $user)
    {
        $model = new User();
        return $model->reg($request);
    }
}
