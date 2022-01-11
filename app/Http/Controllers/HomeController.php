<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
	public function index() {
		 $data = User::all();
		 return response()->json($data);
	}
}