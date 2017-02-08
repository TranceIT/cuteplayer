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
    	$login = '+79780290201';
$password = 'A2je1k483819';
$security_check_code = '97802902'; // если требуется 8 цифр номера телефона (по крайней мере у меня столько запросило). Например Ваш номер телефона 79123456789, то необходимо в переменную прописать промежуток от 7 до 89, то есть 91234567.
 
$headers = array(
 'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
 'content-type' => 'application/x-www-form-urlencoded',
 'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'
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
 
// получаем ссылку для редиректа после авторизации
preg_match('/Location\: (.*)/s', $post_auth['headers'], $post_auth_location);
//$post_auth_location = explode(' ', $post_auth_location[1]);
print_r($post_auth_location); die;
//print_r($post_auth_location); die;
 
if(!preg_match('/\_\_q\_hash=/s', $post_auth_location[0])) {
 echo 'Не удалось авторизоваться <br /> <br />'.$post_auth['headers'];
 
 exit;
}
 
// переходим по полученной для редиректа ссылке
$get_auth_location = $this->post($post_auth_location[1], array(
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
	}

	public function getUserPage($id = null, $cookies = null) {
 global $headers;
 
 $get = $this->post('https://vk.com/wall-26914825_47538', array(
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
 
//print_r($url);
//echo "<br>";

 list($headers, $result) = explode("\r\n\r\n", $result, 4);
 
 preg_match_all('|Set-Cookie: (.*);|U', $headers, $parse_cookies);
 
 $cookies = implode(';', $parse_cookies[1]);
 
 curl_close($ch);
 
 return array('headers' => $headers, 'cookies' => $cookies, 'content' => $result);
}
}

