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
    	$login = '---';
$password = '---';
$security_check_code = '97802902'; // если требуется 8 цифр номера телефона (по крайней мере у меня столько запросило). Например Ваш номер телефона 79123456789, то необходимо в переменную прописать промежуток от 7 до 89, то есть 91234567.
 
$headers = array(
 'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
 'content-type' => 'application/x-www-form-urlencoded',
 'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36',
 //'cookies' => 'h=1;s=1;l=4059553;p=a19b1f723aa5ba8418e4396de8324edaaca0ca6b9175e527e8d29;remixq_052986b9d8328564f9eb72b3eddb313d=afd30c390357cdc71d',
);
 
// получаем главную страницу

$get_main_page = $this->post('https://vk.com', array(
 'headers' => array(
  'accept: '.$headers['accept'],
  'content-type: '.$headers['content-type'],
  'user-agent: '.$headers['user-agent']
 )
));
 
// парсим с главной страницы параметры ip_h и lg_h
preg_match('/name=\"ip_h\" value=\"(.*?)\"/s', $get_main_page['content'], $ip_h);
preg_match('/name=\"lg_h\" value=\"(.*?)\"/s', $get_main_page['content'], $lg_h);
 
// посылаем запрос на авторизацию
$post_auth = $this->post('https://login.vk.com/?act=login', array(
 'params' => 'act=login&role=al_frame&_origin='.urlencode('http://vk.com').'&ip_h='.$ip_h[1].'&lg_h='.$lg_h[1].'&email='.urlencode($login).'&pass='.urlencode($password),
 'headers' => array(
  'accept: '.$headers['accept'],
  'content-type: '.$headers['content-type'],
  'user-agent: '.$headers['user-agent']
 ),
 'cookies' => $get_main_page['cookies']
));


$get = $this->post('https://m.vk.com/wall-26914825_47538', array(
  'headers' => array(
   'accept: '.$headers['accept'],
   'content-type: '.$headers['content-type'],
   'user-agent: '.$headers['user-agent']
  ),
  'cookies' => $get_main_page['cookies']
  //'cookies' => $headers['cookies']
 ));

print_r(iconv('windows-1251', 'utf-8', $get['content'])); die;
 
 //print_r($post_auth['headers']); die;
// получаем ссылку для редиректа после авторизации
//preg_match('/Location\: (.*)/s', $post_auth['headers'], $post_auth_location);
/*
preg_match('/Location\: (.*) /s', $post_auth['headers'], $post_auth_location);
$post_auth_location = explode("Strict-Transport-Security:", $post_auth_location[1]);

//print_r($post_auth_location); die;
 
if(!preg_match('/\_\_q\_hash=/s', $post_auth_location[0])) {
 echo 'Не удалось авторизоваться <br /> <br />'.$post_auth['headers'];
 
 exit;
}
 
// переходим по полученной для редиректа ссылке
//$get_auth_location = $this->post($post_auth_location[1], array(
$get_auth_location = $this->post($post_auth_location[0], array(
 'headers' => array(
  'accept: '.$headers['accept'],
  'content-type: '.$headers['content-type'],
  'user-agent: '.$headers['user-agent']
 ),
 'cookies' => $post_auth['cookies']
));
 
// получаем ссылку на свою страницу
preg_match('/"uid"\:"([0-9]+)"/s', $get_auth_location['content'], $my_page_id);
 
$my_page_id = $my_page_id[1];
 
$get_my_page = $this->getUserPage($my_page_id, $get_auth_location['cookies']);
 
// если запрошена проверка безопасности
if(preg_match('/act=security\_check/s', $get_my_page['headers'])) {
 preg_match('/Location\: (.*)/s', $get_my_page['headers'], $security_check_location);
	//preg_match('/Location\: http\:\/\/vk.com\/login\.php(\S*) /s', $get_my_page['headers'], $security_check_location);
 
 // переходим на страницу проверки безопасности
 $get_security_check_page = $this->post('https://vk.com'.$security_check_location[1], array(
  'headers' => array(
   'accept: '.$headers['accept'],
   'content-type: '.$headers['content-type'],
   'user-agent: '.$headers['user-agent']
  ),
  'cookies' => $get_auth_location['cookies']
 ));
 
 // получаем hash для запроса на проверку мобильного телефона
 preg_match('/hash: \'(.*?)\'/s', $get_security_check_page['content'], $get_security_check_page_hash);
 
 // вводим запрошенные цифры мобильного телефона
 $post_security_check_code = post('https://vk.com/login.php', [
  'params' => 'act=security_check&code='.$security_check_code.'&al_page=2&hash='.$get_security_check_page_hash[1],
  'headers' => array(
   'accept: '.$headers['accept'],
   'content-type: '.$headers['content-type'],
   'user-agent: '.$headers['user-agent']
  ),
  'cookies' => $get_auth_location['cookies']
 ]);
 
 echo 'Запрошена проверка безопасности';
 
 // отображаем свою страницу после проверки безопасности
 $get_my_page = getUserPage($my_page_id, $get_auth_location['cookies']);
 
 echo iconv('windows-1251', 'utf-8', $get_my_page['content']);
} else {
 // также отображаем свою страницу, если нет проверки безопасности
 echo iconv('windows-1251', 'utf-8', $get_my_page['content']);
}
*/
	}

	public function getUserPage($id = null, $cookies = null) {
 global $headers;
 
 $get = $this->post('https://m.vk.com/wall-26914825_47538', array(
  'headers' => array(
   'accept: '.$headers['accept'],
   'content-type: '.$headers['content-type'],
   'user-agent: '.$headers['user-agent']
  ),
  'cookies' => $cookies
 ));
 
 return $get;
}
 
public function post($url = null, $params = null) {
 $ch = curl_init();
 
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_HEADER, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
 
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
echo $url;
var_dump($result);


 list($headers, $result) = explode("\r\n\r\n", $result, 4);
 
 preg_match_all('|Set-Cookie: (\S*);|U', $headers, $parse_cookies);
 
 $cookies = implode(';', $parse_cookies[1]);
 
 curl_close($ch);
 
 return array('headers' => $headers, 'cookies' => $cookies, 'content' => $result);
}

	public function test()
	{
		$str = 'HTTP/1.1 302 Found Server: Apache Date: Thu, 09 Feb 2017 06:43:09 GMT Content-Type: text/html; charset=windows-1251 Content-Length: 0 Connection: keep-alive X-Powered-By: PHP/3.10517 Pragma: no-cache Cache-control: no-store P3P: CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT" Set-Cookie: h=1; expires=Wed, 07 Feb 2018 23:39:57 GMT; path=/; domain=login.vk.com; HttpOnly Set-Cookie: s=1; expires=Fri, 09 Feb 2018 04:03:05 GMT; path=/; domain=login.vk.com; secure; HttpOnly Set-Cookie: l=4059553; expires=Tue, 13 Feb 2018 20:24:16 GMT; path=/; domain=login.vk.com; secure; HttpOnly Set-Cookie: p=d497a61ca9499767becdc648545e2ec05e79e0ee301bcd24b81b8; expires=Thu, 08 Feb 2018 17:39:58 GMT; path=/; domain=login.vk.com; secure; HttpOnly Set-Cookie: remixq_3ef425c3dfc8c233a5b5374005077b41=9729896068e052b8e7; path=/; domain=.vk.com; HttpOnly Location: http://vk.com/login.php?act=slogin&to=&s=1&__q_hash=3ef425c3dfc8c233a5b5374005077b41 Strict-Transport-Security: max-age=15768000';

		preg_match("/Location\: http\:\/\/vk.com\/login\.php(\S*) /s", $str, $str2);

		print_r($str2); die;
	}

}

