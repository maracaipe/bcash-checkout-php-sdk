<?php

namespace Bcash\Domain;

class Product implements Postable {
	private $code;
	private $description;
	private $quantity;
	private $amount;
	private $weight;
	private $extra;

	public function __construct($code, $description, $quantity, $amount, $weight = 0, $extra = "") {
		$this->code = $code;
		$this->description = $description;
		$this->quantity = $quantity;
		$this->amount = $amount;
		$this->weight = $weight;
		$this->extra = $extra;
	}

	public function toPostArray($postfix = "") {
		return array(
				"produto_codigo$postfix" => $this->code,
				"produto_descricao$postfix" => $this->description,
				"produto_qtde$postfix" => $this->quantity,
				"produto_valor$postfix" => $this->amount,
				"produto_extra$postfix" => $this->extra
		);
	}
}
