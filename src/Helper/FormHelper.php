<?php

namespace Bcash\Helper;

use Bcash\Config\BcashConfig;

class FormHelper {

	public static function generateForm(array $requestArray, $formId= "bcash_checkout", $hidden = true, $endpoint = null) {
		if ($endpoint == null) {
			$endpoint = BcashConfig::$checkout_url;
		}

		$form = "<form id='{$formId}' method='post' action='{$endpoint}'>";
		$form .= self::generateInputs($requestArray, $hidden);
		$form .= "</form>";

		return $form;
	}

	public static function generateInputs(array $requestArray, $hidden = true) {
		$inputs = "";
		foreach ($requestArray as $id => $value) {
			$inputs .= self::input($id, $value, $hidden);
		}

		return $inputs;
	}

	public static function input($id, $value, $hidden = true) {
		$type = ($hidden ? "type='hidden'" : "type='text'");
		return "<input {$type} id='{$id}' name='{$id}' value='{$value}' />";
	}
}
