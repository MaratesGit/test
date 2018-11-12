


<?php 

$postQuery = array();
$postQuery['text'] = 'adladjasdadasdkajsdkladakdljfafjklasjafkjfkjaflasfjjafkjfklasjfajfkajkkkkalsfjasjflkajsfkasfjkalfjasfasfasfas';
$postQuery['userkey'] = '4a825c755b3ca0bb3912e9e36a79eed6';

function addPost(){
$postQuery = http_build_query($postQuery, '', '&');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/post');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postQuery);
$json = curl_exec($ch);
$errno = curl_errno($ch);


if (!$errno)
		{
			$resAdd = json_decode($json);
			if (isset($resAdd->text_uid))
			{
				$text_uid = $resAdd->text_uid;
			}
			else
			{
				$error_code = $resAdd->error_code;
				$error_desc = $resAdd->error_desc;
			}
		}
		else
		{
			$errmsg = curl_error($ch);
		}

		curl_close($ch);

		print_r($text_uid);
	
}
addPost();

function getResultPost()
	{
		$postQuery = array();
		$postQuery['uid'] = "";
		$postQuery['userkey'] = "";


		$postQuery = http_build_query($postQuery, '', '&');			 

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/post');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postQuery);
		$json = curl_exec($ch);
		$errno = curl_errno($ch);

		if (!$errno)
		{
			$resCheck = json_decode($json);
			if (isset($resCheck->text_unique))
			{
				$text_unique = $resCheck->text_unique;
				$result_json = $resCheck->result_json;
			}
			else
			{
				$error_code = $resCheck->error_code;
				$error_desc = $resCheck->error_desc;
			}
		}
		else
		{
			$errmsg = curl_error($ch);
		}

		curl_close($ch);
	}


?>
