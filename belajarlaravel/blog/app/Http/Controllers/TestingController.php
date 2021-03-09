<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    function halo($nama = "Diyah")
    {
        return 'Halo Selamat Datang '.$nama;
    }
}
