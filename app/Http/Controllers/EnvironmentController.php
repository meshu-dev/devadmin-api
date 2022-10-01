<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnvironmentController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(['time' => time()]);
    }
}
