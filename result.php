<?php

// подключение конфигов, дополнительных модулей и функций

define('LMI_SECRET_KEY','---------------'); // здесь указывается ваш Merchant Key
$data = $_POST; // или $_GET, смотря какой тип передачи мы указали в настройках магазина

if(!$order->checkShop($data['LMI_PAYEE_PURSE'])) { // проверяем идентификатор магазина
	die("Ошибка: идентификатор магазина отличается от настроек сайта");
}

if(!$order->checkPrice($data['LMI_PAYMENT_AMOUNT'])) { // проверяем сумму оплаты, совпадает ли с заказом
	die("Ошибка: сумма оплаты меньше чем выставлена в заказе");
}

// генерирует контрольную сумму
$_hash = md5(
	$data['LMI_PAYEE_PURSE'] . $data['LMI_PAYMENT_AMOUNT'] . $data['LMI_PAYMENT_NO'] . 
	$data['LMI_MODE'] . $data['LMI_SYS_INVS_NO'] . $data['LMI_SYS_TRANS_NO'] . 
	$data['LMI_SYS_TRANS_DATE'] . LMI_SECRET_KEY . $data['LMI_PAYER_PURSE'] . $data['LMI_PAYER_WM']
);

if($data['LMI_HASH'] == strtoupper($_hash)) { // сравниваем хеши
	$order->confirmOrder($data['LMI_PAYMENT_NO']); // меняем статус заказа на "оплаченный"
} else {
	die("Ошибка: контрольная сумма неправильная");
}

?>