<?php

namespace Bcash\Domain;

class Shipping implements Postable {
	private $amount;
	private $type;
	private $address;
	private $weight;

	public function setAddress(Address $address) {
		$this->address = $address;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public function setAmount($amount) {
		$this->amount = $amount;
	}

	public function setWeight($weight) {
		$this->weight = $weight;
	}

	public function toPostArray() {
		$vars = array(
				'frete' => $this->amount,
				'tipo_frete' => $this->type,
				'peso_total' =>$this->weight
		);

		$vars = array_merge($vars, $this->address->toPostArray());
		return $vars;
	}
}
