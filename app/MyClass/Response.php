<?php

namespace App\MyClass;

class Response {

	public static function success($array = [])
	{
		if(!array_key_exists('message', $array)) {
			$array['message'] = 'Berhasil';
		}

		return response()->json(array_merge($array, [
			'code'		=> 200,
		]));
	}

	public static function error($e)
	{
		return response()->json([
			'message'	=> "{$e->getFile()} : {$e->getLine()} {$e->getMessage()}",
			'trace'		=> $e->getTraceAsString()
		], 500);
	}

}