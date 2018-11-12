<?php  
 function checkBalance($user_key){

		$postQuery = array();
		$postQuery['method'] = 'get_packages_info';
		$postQuery['userkey'] = $user_key;
		$postq = http_build_query($postQuery, '', '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/account');
		// curl_setopt ($ch, CURLOPT_PROXY, "124.41.211.23:57112"); 
		// curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postq);
		$json = curl_exec($ch);
		$errno = curl_errno($ch);

		if (!$errno)
				{
					$resAdd = json_decode($json);
					if (isset($resAdd->size))
					{
						$size = $resAdd->size;
						print_r($size);
						return($size);
						
					}
					else
					{
						$error_code = $resAdd->error_code;
						$error_desc = $resAdd->error_desc;
						print_r($error_code);
					}
				}
				else
				{
					$errmsg = curl_error($ch);
					print_r($errmsg);
				}

				curl_close($ch);
		}
		// checkBalance($user_key);
?>