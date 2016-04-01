<?php
	/**
	 * It translates a text to other language
	 */
	function translate($text, $language){
		require('../resources/lang/' . $language . '.php');
		return $dictionary[$text];
	}
?>