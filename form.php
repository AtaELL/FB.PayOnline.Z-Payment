<?php
$setting = [
	'zp_shop_id' => '00000', // идентификатор магазина в Z-Payment
	'order_id' => '0000', // идентификатор заказа во внутренней системе
	'order_price' => '500', // сумма заказа
	'order_descr' => 'Тестовый платеж', // описание заказа
	'client_mail' => 'mymail@mysite.com', // e-mail клиента (необязятельно)
];
?>
<form action="https://z-payment.com/merchant.php" method="post">
    <input name="LMI_PAYEE_PURSE" type="hidden" value="<?=$setting['zp_shop_id'];?>">
    <input name="LMI_PAYMENT_AMOUNT" type="hidden" value="<?=$setting['order_price'];?>">
    <input name="LMI_PAYMENT_NO" type="hidden" value="<?=$setting['order_id'];?>">
    <input name="LMI_PAYMENT_DESC" type="hidden" value="<?=$setting['order_descr'];?>">
    <input name="CLIENT_MAIL" type="hidden" value="<?=$setting['client_mail'];?>">
    <input type="submit" value="Оплатить" />
</form>