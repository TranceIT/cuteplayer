<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
    	/*
    	//$url = "http://api.soundcloud.com/users/27377660/playlists?client_id=YDWBDIxBet3ccqUsJk9tr6iM5rzPHF0d";
    	//$url = "http://api.soundcloud.com/tracks/58554254/stream?client_id=YDWBDIxBet3ccqUsJk9tr6iM5rzPHF0d";
    	$url = 'https://cf-media.sndcdn.com/Y4pv1qZ8vooQ.128.mp3?Policy=eyJTdGF0ZW1lbnQiOlt7IlJlc291cmNlIjoiKjovL2NmLW1lZGlhLnNuZGNkbi5jb20vWTRwdjFxWjh2b29RLjEyOC5tcDMiLCJDb25kaXRpb24iOnsiRGF0ZUxlc3NUaGFuIjp7IkFXUzpFcG9jaFRpbWUiOjE0ODY3MTU1MzB9fX1dfQ__&Signature=lysDZyVPv8ocwZ119s2roVHeRnPhkAhs2-blacV8pi9DrEeGNHAGBgN~36Yggv5YgyLB4Upd8rX1omDvDM9wXf~xvVePrZ~Ztl0NDlRP8KDKiX3ea~pcjVaHKAafM9np2Rw~SHSsAhokFbrB0Stg~y2PU92SjJ1L8u-uvGnf7-dPPxCNRWncgxm2NssXaFnES1fwmztmYUHIgsTxbnUYb2xFTHOS-SQEK9C~pFt~hF0u96CBzemD6KpdtMFtm99S7V~O3rghtED2axVaWM3K0x8iTVi5EhUBpZcEqX~sVUXK0MJHDtz6tI3EcoYUKorgsVNeJ2VkYgNNkiLJxUwscQ__&Key-Pair-Id=APKAJAGZ7VMH2PFPW6UQ';
    	$ch = curl_init();
 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		//curl_setopt($ch, CURLOPT_COOKIEJAR, '/var/www/player.lan/storage/666.txt');
		//curl_setopt($ch, CURLOPT_COOKIEFILE, '/var/www/player.lan/storage/666.txt');
		/*
	 	if(isset($params['params'])) {
	  		curl_setopt($ch, CURLOPT_POST, 1);
	  		curl_setopt($ch, CURLOPT_POSTFIELDS, $params['params']);
	 	}
	 
	 	if(isset($params['headers'])) {
	  		curl_setopt($ch, CURLOPT_HTTPHEADER, $params['headers']);
	 	}
	 
	 	if(isset($params['cookies'])) {
	  		curl_setopt($ch, CURLOPT_COOKIE, $params['cookies']);
	 	}
	 	
	 
	 	$result = curl_exec($ch);
	 	$result = json_decode($result);

	 	//print_r($result); die;
	 	/*
		list($headers, $result) = explode("\r\n\r\n", $result, 4);
	 
	 	preg_match_all('|Set-Cookie: (\S*);|U', $headers, $parse_cookies);
	 	$cookies = implode(';', $parse_cookies[1]);
	 	
	 	curl_close($ch);
	 	*/
	 	return view('index');
	}

	public function test(){
		print_r($_POST);
	}
}

