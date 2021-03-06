<?php

namespace Bcash\Domain;

class Buyer implements Postable {
	private $email;
	private $name;
	private $companyName;
	private $cpf;
	private $cnpj;
	private $phoneNumber;
	private $celphone;

	private $ip;

	public function getIP() {
		if (function_exists( 'apache_request_headers')) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}

		if (array_key_exists('X-Forwarded-For', $headers)
				&& filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
					$ip = $headers['X-Forwarded-For'];
				} elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $headers)
						&& filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )) {
					$ip = $headers['HTTP_X_FORWARDED_FOR'];
				} else {
					$ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
				}

				$this->ip = $ip;
	}

	public function toPostArray() {
		return array(
				'email' => $this->email,
				'nome' => $this->name,
				'cliente_razao_social' => $this->companyName,
				'cpf' => $this->cpf,
				'cliente_cnpj' => $this->cnpj,
				'telefone' => $this->phoneNumber,
				'celular' => $this->celphone
		);
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setCompanyName($companyName){
		$this->companyName = $companyName;
	}
	
	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function setCnpj($cnpj){
		$this->cnpj = $cnpj;
	}

	public function setPhoneNumber($phoneNumber){
		$this->phoneNumber = $phoneNumber;
	}
	
	public function setCelphone($celphone){
		$this->celphone = $celphone;
	}
}