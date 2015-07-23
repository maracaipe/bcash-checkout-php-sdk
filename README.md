# Bcash Checkout Web

[![Total Downloads](https://img.shields.io/packagist/dt/bcash/checkout.svg?style=flat)](https://packagist.org/packages/bcash/checkout)
[![GitHub tag](https://img.shields.io/github/tag/payu-br/checkout.svg)](https://github.com/payu-br/checkout)

```php

require_once 'autoloader.php';

use Bcash\Domain\PaymentRequest;
use Bcash\Domain\Buyer;
use Bcash\Helper\FormHelper;

$sellerMail = 'lojamodelo@bcash.com.br';

$buyerMail = 'comprador@comprador.com';
$buyerName = 'Comprador de Teste';
$buyerCpf = '983.007.561-32';
$buyerPhoneNumber = '11 3111-1111';

$urlReturn = 'https://www.bcash.com.br/lojamodelo/atualiza_status.php';
$redirectTime = 30;
$redirect = true;
$orderId = 123;

$products = array(
	new stdObject(
		'code' 		=> 123456,
		'description' 	=> 'Product1',
		'amount'	=> 2,
		'value'		=> 123.10,
		'weight'	=> 100,
		'extra'		=> 'Test'
	)
);

$request = new PaymentRequest($sellerMail);
$request->setRedirect($urlReturn, $redirectTime, $redirect  );
$request->setOrderId($orderId);


foreach($products as $product){
	$request->addProduct(
			$product->code,
			$product->description,
			$product->amount,
			$product->value,
			$product->weight,
			$product->extra
	);
}

$buyer = new Buyer();
$buyer->setEmail($buyerMail);
$buyer->setName($buyerName);
$buyer->setCpf($buyerCpf);
$buyer->setPhoneNumber($buyerPhoneNumber);
$request->setBuyer($buyer);

echo FormHelper::generateForm($request->toPostArray());

```
