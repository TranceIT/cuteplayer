<?php

namespace App\Http\Controllers\SoundEngine;

use Illuminate\Routing\Controller as BaseController;

class SoundCloudController extends BaseController
{
	/**
	 * Get SoundCloud client id
	 *
	 * @return string
	 */
	public function getClientId()
	{
		header('Location: http://api.soundcloud.com/tracks/58554254/stream?YDWBDIxBet3ccqUsJk9tr6iM5rzPHF0d', true, 302);
	}
}