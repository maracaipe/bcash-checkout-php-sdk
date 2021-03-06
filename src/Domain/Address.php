<?php

namespace Bcash\Domain;

class Address implements Postable {
	
	private $street;
	private $number;
	private $complement;
	private $city;
	private $state;
	private $neighborhood;
	private $zipcode;

	/**
	 * Construtor grande
	 * 
	 * @param Integer $zipcode
	 * @param String $street
	 * @param Integer $number
	 * @param String $city
	 * @param String $state
	 * @param string $neighborhood
	 * @param string $complement
	 */
	public function __construct($zipcode, $street, $number, $city, $state, $neighborhood = "", $complement = "") {
		$this->setZipCode($zipcode);
		$this->setStreet($street);
		$this->setNumber($number);
		$this->setComplement($complement);
		$this->setNeighborhood($neighborhood);
		$this->setCity($city);
		$this->setState($state);
	}


	/**
	 * Endere�o do comprador
	 * Tamanho maximo: 100 caracteres
	 * Ex.: Av. Paulista
	 *
	 * @return street
	 */
	public function getStreet() {
	
		return $this->street;
	}
	
	/**
	 * Endere�o do comprador<br>
	 * <i>Tamanho m�ximo: 100 caracteres</i><br>
	 * <b>Campo obrigat�rio</b>
	 *
	 * @param String $street
	 *            , ex.: Av. Paulista
	 */
	public function setStreet($street) {
	
		$this->street = $street;
	}
	
	
	/**
	 * N�mero do endere�o<br>
	 * <i>Tamanho m�ximo: 10 caracteres</i><br>
	 *
	 * @return number
	 *            , ex.: 1254
	 */
	public function getNumber() {
	
		return $this->number;
	}
	
	
	/**
	 * N�mero do endere�o<br>
	 * <i>Tamanho m�ximo: 10 caracteres</i><br>
	 * <b>Campo obrigat�rio</b>
	 *
	 * @param number
	 *            , ex.: 1254
	 */
	public function setNumber($number) {
	
		$this->number = $number;
	}
	
	
	/**
	 * Complemento do endere�o do comprador<br>
	 * <i>Tamanho m�ximo: 80 caracteres</i><br>
	 *
	 * @return complement
	 *            , ex.: Apartamento 10
	 */
	public function getComplement() {
	
		return $this->complement;
	}
	
	
	/**
	 * Complemento do endere�o do comprador<br>
	 * <i>Tamanho m�ximo: 80 caracteres</i><br>
	 *
	 * @param complement
	 *            , ex.: Apartamento 1010
	 */
	public function setComplement($complement) {
	
		$this->complement = $complement;
	}
	
	
	/**
	 * Bairro do comprador<br>
	 * <i>Tamanho m�ximo: 50 caracteres</i><br>
	 *
	 * @return neighborhood
	 *            , ex.: Centro
	 */
	public function getNeighborhood() {
	
		return $this->neighborhood;
	}
	
	
	/**
	 * Bairro do comprador<br>
	 * <i>Tamanho m�ximo: 50 caracteres</i><br>
	 * <b>Campo obrigat�rio</b>
	 *
	 * @param neighborhood
	 *            , ex.: Centro
	 */
	public function setNeighborhood($neighborhood) {
	
		$this->neighborhood = $neighborhood;
	}
	
	
	/**
	 * Cidade do comprador<br>
	 * <i>Tamanho m�ximo: 255 caracteres</i><br>
	 *
	 * @return city
	 *            , ex.: S�o Paulo
	 */
	public function getCity() {
	
		return $this->city;
	}
	
	
	/**
	 * Cidade do comprador<br>
	 * <i>Tamanho m�ximo: 255 caracteres</i><br>
	 * <b>Campo obrigat�rio</b>
	 *
	 * @param city
	 *            , ex.: S�o Paulo
	 */
	public function setCity($city) {
	
		$this->city = $city;
	}
	
	
	/**
	 * Estado do comprador<br>
	 * <i>Tamanho m�ximo: 2 caracteres</i><br>
	 *
	 * @return state
	 */
	public function getState() {
	
		return $this->state;
	}
	
	
	/**
	 * Estado do comprador
	 * Tamanho maximo: 2 caracteres
	 * Campo obrigatorio
	 *
	 * @param state
	 */
	public function setState($state ) {
	
		$this->state = $state;
	}
	
	
	/**
	 * CEP do comprador
	 * Tamanho: 9 caracteres
	 *
	 * @return zipCode
	 *            , ex.: 01300000
	 */
	public function getZipCode() {
	
		return $this->zipcode;
	}
	
	
	/**
	 * CEP do comprador<br>
	 * <i>Tamanho m�ximo: 9 caracteres</i><br>
	 * <b>Campo obrigat�rio</b>
	 *
	 * @param zipCode
	 *            , ex.: 01300000
	 */
	public function setZipCode($zipCode) {
	
		$this->zipcode = $zipCode;
	}
		
	/**
	 * Converte Post para Array
	 * @return array
	 */
	public function toPostArray() {
		$street = trim($this->getStreet()) . (strlen(trim($this->getStreet())) == 0 ? '' : ', ' . $this->getNumber());
		return array(
				'cep' => $this->getZipCode(),
				'endereco' => $street,
				'bairro' => $this->getNeighborhood(),
				'cidade' => $this->getCity(),
				'estado' => $this->getState(),
				'complemento' => $this->getComplement()
		);
	}
}