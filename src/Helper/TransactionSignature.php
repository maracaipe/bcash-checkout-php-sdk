<?php

namespace Bcash\Helper;

use Bcash\Domain\PaymentRequest;

class TransactionSignature {

	public static function generate(PaymentRequest $request) {
		$array = $request->toPostArray();
		ksort($array);

		$data = "";
		foreach ($array as $key => $value) {
			$data .= $key . "=" . urlencode($value) . "&";
		}
		$data = trim($data, "&");

		$data .= $request->getSeller()->getKeyAccess();
		return md5($data);
	}
}