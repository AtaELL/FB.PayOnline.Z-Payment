<?php

// ����������� ��������, �������������� ������� � �������

define('LMI_SECRET_KEY','---------------'); // ����� ����������� ��� Merchant Key
$data = $_POST; // ��� $_GET, ������ ����� ��� �������� �� ������� � ���������� ��������

if(!$order->checkShop($data['LMI_PAYEE_PURSE'])) { // ��������� ������������� ��������
	die("������: ������������� �������� ���������� �� �������� �����");
}

if(!$order->checkPrice($data['LMI_PAYMENT_AMOUNT'])) { // ��������� ����� ������, ��������� �� � �������
	die("������: ����� ������ ������ ��� ���������� � ������");
}

// ���������� ����������� �����
$_hash = md5(
	$data['LMI_PAYEE_PURSE'] . $data['LMI_PAYMENT_AMOUNT'] . $data['LMI_PAYMENT_NO'] . 
	$data['LMI_MODE'] . $data['LMI_SYS_INVS_NO'] . $data['LMI_SYS_TRANS_NO'] . 
	$data['LMI_SYS_TRANS_DATE'] . LMI_SECRET_KEY . $data['LMI_PAYER_PURSE'] . $data['LMI_PAYER_WM']
);

if($data['LMI_HASH'] == strtoupper($_hash)) { // ���������� ����
	$order->confirmOrder($data['LMI_PAYMENT_NO']); // ������ ������ ������ �� "����������"
} else {
	die("������: ����������� ����� ������������");
}

?>