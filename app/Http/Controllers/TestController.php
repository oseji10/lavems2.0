<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class TestController extends Controller
{
    public function getUsers(){
        $theUrl     = config('app.guzzle_test_url').'/api/users/';
        $users   = Http ::get($theUrl);
        return $users;
     }
}
