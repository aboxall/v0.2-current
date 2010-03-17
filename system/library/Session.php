<?php

class Session
{
	public function __construct()
	{
		session_start();
	}
	
	public function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public function get($name)
	{
		return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
	}
}

// EOF
