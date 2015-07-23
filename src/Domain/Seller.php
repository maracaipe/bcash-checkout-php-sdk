<?php

namespace Bcash\Domain;

class Seller implements Postable {
	private $email;
	private $keyAccess;

	public function __construct($email, $keyAccess = null) {
		$this->email = $email;
		$this->keyAccess = $keyAccess;
	}

	public function getKeyAccess() {
		return $this->keyAccess;
	}

	public function toPostArray() {
		return array (
				'email_loja' => $this->email
		);
	}
}
