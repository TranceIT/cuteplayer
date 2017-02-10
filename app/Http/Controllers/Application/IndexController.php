<?php

namespace App\Http\Controllers\Application;

use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

	public function index() {
		return view('index');
	}

	public function getTrack() {
		return redirect()->away("http://api.soundcloud.com/tracks/58554254/stream?client_id=" . config('SoundEngine.SoundCloud.client_id'));

	}
}