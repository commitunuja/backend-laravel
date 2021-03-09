<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function all()
    {
        return 'ini adalah halaman produk - ALL';
    }
    function shirt()
    {
        return 'ini adalah halaman produk - shirt';
    }
    function latest()
    {
        return 'ini adalah halaman produk - latest';
    }
    function popular()
    {
        return 'ini adalah halaman produk - popular';
    }
}
