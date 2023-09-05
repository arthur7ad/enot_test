<?php
	class Hash {
		public static function make($string, $salt = '') {
			return hash('sha256', $string.$salt);
		}

		public static function salt($length) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

            return substr(str_shuffle($permitted_chars), 0, 10);

		}

		public static function unique() {
			return self::make(uniqid());
		}
	}
?>