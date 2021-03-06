<?php

namespace Bcash\Domain;

use Bcash\Helper\TransactionSignature;
		
class PaymentRequest implements Postable {
	private $orderId;
	private $seller;
	private $buyer;
	private $products;
	private $shipping;
	
	private $increase;
	private $discount;
	
	private $isRedirect;
	private $redirectUrl;
	private $redirectTime;
	
	private $notificationUrl;
	
	private $maxInstalments;
	
	private $commissions;
	
	private $paymentMethod;
	
	private $plataformId;
	private $free;

	private $signature; 
	
	public function __construct($sellerEmail, $keyAccess = null) {
		$this->seller = new Seller($sellerEmail, $keyAccess);
	}
	
	public function setOrderId($orderId) {
		$this->orderId = $orderId;
	}
	
	public function setBuyer($buyer){
		$this->buyer = $buyer;
	}
	
	public function addProduct($code, $description, $quantity, $amount, $weight = 0, $extra = "") {
		if ($this->products == null) {
			$this->products = array();
		}
		
		$this->products[] = new Product($code, $description, $quantity, $amount, $weight, $extra);
	}
	
	public function setShippingAddress($zipCode, $street, $number, $city, $state, $neighborhood = "", $complement = "") {
		if ($this->shipping == null) {
			$this->shipping = new Shipping();
		}

		$address = new Address($zipCode, $street, $number, $city, $state, $neighborhood, $complement);
		$this->shipping->setAddress($address);
	}
	
	public function setShippingType($type) {
		if ($this->shipping == null) {
			$this->shipping = new Shipping();
		}
		
		$this->shipping->setType($type);
	}
	
	public function setShippingAmount($amount) {
		if ($this->shipping == null) {
			$this->shipping = new Shipping();
		}
	
		$this->shipping->setAmount($amount);
	}
	
	public function setShippingWeight($weight) {
		if ($this->shipping == null) {
			$this->shipping = new Shipping();
		}
	
		$this->shipping->setWeight($weight);
	}
	
	public function setIncrease($increase) {
		$this->increase = $increase;
	}
	
	public function setDiscount($discount) {
		$this->discount = $discount;
	}
	
	public function setRedirect($url, $time = null, $redirect = 'True') {
		$this->isRedirect = $redirect;
		$this->redirectUrl = $url;
		$this->redirectTime = $time;
	}

	public function setReturnUrl($url) {
		$this->returnUrl = $url;
	}
	
	public function setNotificationUrl($url) {
		$this->notificationUrl = $url;
	}
	
	public function setMaxInstalments($max) {
		$this->maxInstalments = $max;
	}
	
	public function addComission($email, $amount) {
		if ($this->commissions == null) {
			$this->commissions = array();
		}
		
		$this->commissions[] = new Commission($email, $amount);
	}
	
	public function setPaymentMethod($method) {
		$this->paymentMethod = $method;
	}
	
	public function free($free) {
		$this->free = $free;
	}
	
	public function getSeller() {
		return $this->seller;
	}
	
	public function setPlataformId($plataform) {
		$this->plataformId = $plataform;
	}
	
	public function signature() {
		$this->signature = TransactionSignature::generate($this);
		return $this->signature;
	}
	
	public function toPostArray() {
		$vars = array(
			'id_pedido' => $this->orderId,
			'acrescimo' => $this->increase,
			'desconto' => $this->discount,
			'redirect' => $this->isRedirect,
			'url_retorno' => $this->redirectUrl,
			'redirect_time' => $this->redirectTime,
			'url_aviso' => $this->notificationUrl,
			'parcela_maxima' => $this->maxInstalments,
			'meio_pagamento' => $this->paymentMethod,
			'id_plataforma' => $this->plataformId,
			'free' => $this->free
		);
		if ($this->seller != null) {
			$vars = array_merge($vars, $this->seller->toPostArray());
		}
		
		if ($this->buyer != null) {
			$vars = array_merge($vars, $this->buyer->toPostArray());
		}
		
		if ($this->products != null) {
			$i = 1;
			foreach ($this->products as $product) {
				$vars = array_merge($vars, $product->toPostArray("_$i"));
				$i++;
			}
		}
		
		if ($this->shipping != null) { 
			$vars = array_merge($vars, $this->shipping->toPostArray());
		}

		if ($this->commissions != null) {
			$i = 1;
			foreach ($this->commissions as $commission) {
				$vars = array_merge($vars, $commission->toPostArray("_$i"));
				$i++;
			}
		}
		
		if ($this->signature != null) {
			$vars['hash'] = $this->signature;
		}
		
		return array_filter($vars, 'strlen');
	}
}
