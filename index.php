<?php
	session_start();
	require 'autoload.php';
	use Abraham\TwitterOAuth\TwitterOAuth;
	
	define('CONSUMER_KEY' ,	'2zo4RUqh9bxjbixyVM6StdQPk');
	define('CONSUMER_SECRET' ,	'o1dXoS9GvAZCeTMb69HcfX6KSsSbbfnnNc8TU9BhfxjS7roCrm');
	define('OAUTH_CALLBACK' , 	'https://mytweets.com/twaps/callback.php');
	
	if(!isset($_SESSION['access _token'])) {
		$connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);
		$request_token = $connection->oauth('oauth/request_token',array('oauth_callback' => OAUTH_CALLBACK));
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		$url = $connection->url('oauth/authorize',array('oauth_token' => $request_token['oauth_token']));
		echo $url;
	} else{
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token_secret['
			oauth_token_secret']);
		$user = $connection->get("account/verify_credentials");
		echo $user->status->text;
		echo "<pre>";
		echo "$user";
		echo "</pre>";
		$connection->setProxy([
    'CURLOPT_PROXY' => '127.0.0.0',
    'CURLOPT_PROXYUSERPWD' => '',
    'CURLOPT_PROXYPORT' => 8080,
]);
	}
	
	

?>