<?php

namespace Bcash\Domain;

class Commission implements Postable {
	private $email;
	private $amount;

	public function __construct($email, $amount) {
		$this->email = $email;
		$this->amount = $amount;
	}

	public function toPostArray($postfix = "") {
		return array(
				"email_dependente$postfix" => $this->email,
				"valor_dependente$postfix" => $this->amount
		);
	}
}
