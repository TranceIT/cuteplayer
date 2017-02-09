<?php

namespace App\Http\Controllers\Application;

use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
 
    public function index()
    {
    	return view('index');
    }

}
