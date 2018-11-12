<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$add_post_errors; // ошибки, возникающие при загрузке поста и получении его uid (функция  addPost)
$get_result_errors; // ошибки, возникающие при загрузке результатов анализа (функция  getResultPost)
$user_key = 'ac667803971fa43a5d41001e114bca74'; // ключ пользователя
$input_text = 'Mini Metro is a puzzle strategy video game developed by indie development team Dinosaur Polo Club. Players are tasked with constructing an efficient rail transit network for a rapidly growing city. Stations are represented by differently shaped nodes and players can build tracks to connect them by drawing lines. '; // вводимый текст поста
$proxy = ''; // адрес прокси. если не нужно, то передать пустую строку ''

function get_text_ru($text,$user_key,$proxy){ //главная функция, на вход сам текст и user_key
	$input_text = $text;
	$user_key = $user_key;


	function addPost($input_text,$user_key,$proxy){ //функция загрузки текста поста на сервер и получение его uid
		$postQuery = array();
		$postQuery['text'] = $input_text;
		$postQuery['userkey'] = $user_key;
		$postQuery['visible'] = 'vis_on';
		$proxy = $proxy;
		$postq = http_build_query($postQuery, '', '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/post');
		if (($proxy!='')){
				curl_setopt ($ch, CURLOPT_PROXY, $proxy); 
		        curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
			}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postq);
		$json = curl_exec($ch);
		$errno = curl_errno($ch);

		if (!$errno)
				{
					$resAdd = json_decode($json);
					if (isset($resAdd->text_uid))
					{	
						$text_uid = $resAdd->text_uid;
						return ($text_uid);	
					}
					else
					{
						$error_code = $resAdd->error_code;
						$error_desc = $resAdd->error_desc;
						$GLOBALS['add_post_errors'] = $error_desc;
					}
				}
				else
				{
					$errmsg = curl_error($ch);
					$GLOBALS['add_post_errors'] = $errmsg;
				}

				curl_close($ch);
	}

	function getResultPost($text_uid,$user_key,$proxy){ // функция получающая результаты анализа
			
			$postQuery = array();
			$postQuery['uid'] = $text_uid;
			$postQuery['userkey'] = $user_key;
			$postQuery['jsonvisible'] = 'detail';
			$postq = http_build_query($postQuery, '', '&');			 
			$proxy = $proxy;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/post');
			if (($proxy!='')){
				curl_setopt ($ch, CURLOPT_PROXY, $proxy); 
		        curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postq);
			$json = curl_exec($ch);
			$errno = curl_errno($ch);

			if (!$errno)
			{
				$resCheck = json_decode($json);
				if (isset($resCheck->text_unique))
				{
					
					$text_unique = $resCheck->text_unique;
					// $result_json = $resCheck->result_json; //расскоментировать, если нужно очень подробно
					$seo_check = $resCheck->seo_check;
					$results = [
						'text_unique' => $text_unique,
						// 'result_json' => $result_json,  //расскоментировать, если нужно очень подробно
						'seo_check' => $seo_check
					];
					return ($results);

				}
				else
				{
					$error_code = $resCheck->error_code;
					$error_desc = $resCheck->error_desc;
					if ($error_desc == 'Текст ещё не проверен'){
						return 0;
					}
					else{
						$GLOBALS['get_result_errors'] = $error_desc;
					}
				}
			}
			else
			{	
				$errmsg = curl_error($ch);
				$GLOBALS['get_result_errors'] = $errmsg;

			}

			curl_close($ch);
		}


	$res = 0;
	$text_uid = addPost($input_text,$user_key,$proxy); // получение uid загруженного поста


	if (!isset($GLOBALS['add_post_errors'])){ //если нет ошибок при получении uid

		while ($res==0) { // нужно для того,чтобы делать запросы до тех пор пока не будет сделан анализ и не придет ответ. запросы в данном случается делаются ч паузой в 1 секунду (sleep(1))
			$res = getResultPost($text_uid,$user_key,$proxy);
			if (isset($GLOBALS['get_result_errors'])){
				break;
			}
			sleep(1); 
		}
	}
	else{
		print_r($GLOBALS['add_post_errors']); //если есть ошибка при получении uid, то вывести на экран и завершить скрипт
		exit;
	}

	if (!isset($GLOBALS['get_result_errors'])){ // если нет ошибок при получении результатов анализа
		$link = 'https://text.ru/antiplagiat/' . $text_uid; 	// формирование ссылки на пост
		$res += ['link'=>$link]; // добавить ссылку в общий результат анализа
		return ($res); 
	}
	else{
		print_r($GLOBALS['get_result_errors']); //если есть ошибка при получении результатов анализа, то вывести на экран и завершить скрипт
		exit;
	}
	
}



?>




