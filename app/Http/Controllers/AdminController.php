<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	/**
	 * Show admin home page
	 */
    public function showHome() {
    	return view('admin.home');
    }
}
