<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Uri_lib {

	function uri_combine($uri1 = '', $uri2 = '', $uri3 = '', $uri4 = '') {

		if ($uri1 == '') :

			$result = 'dashboard';

		elseif ($uri2 == '') :

			$result = $uri1;

		elseif ($uri3 == '') :

			$result = $uri1 . '/' . $uri2;

		elseif ($uri4 == '') :

			$result = $uri1 . '/' . $uri2 . '/' . $uri3;

		elseif ($uri1 != '' AND $uri2 != '' AND $uri3 != '' AND $uri4 != '') :

			$result = $uri1 . '/' . $uri2 . '/' . $uri3 . '/' . $uri4;

		else :

			$result = 'dashboard';

		endif;

		return $result;

	}
	// End of function uri_combine

}

/*
	End of class Uri_lib
	End of file Uri_lib.php
	Location: ./application/libraries/Uri_lib.php
*/

