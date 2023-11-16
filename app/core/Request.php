<?php


class Request
{
	/**
	 * Get the uri of a request.
	 * @return string
	 */
	public static function uri()
	{
		$rootUri = str_replace('/', '\\/', (App::get('root_uri') == '\\' ? '' : App::get('root_uri')));
		$uri = preg_replace("/^$rootUri/", '', $_SERVER['REQUEST_URI']);
		$uri = trim(
			parse_url($uri, PHP_URL_PATH),
			'/'
		);
		return $uri;
	}

	/**
	 * Get the request method.
	 *
	 * @return string
	 */
	public static function method()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		return $method;
	}
}