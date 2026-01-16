<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var array $arCurrentValues */

$arTemplateParameters['PRODUCT_DELIVERY'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_PRODUCT_DELIVERY'),
	'TYPE' => 'CHECKBOX',
	'REFRESH' => 'Y',
	'DEFAULT' => 'Y',
);
if ($arCurrentValues['PRODUCT_DELIVERY'] === 'Y')
{
	$arTemplateParameters['MESS_DELIVERY_TAB'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MESS_DELIVERY_TAB'),
		'TYPE' => 'STRING',
		'REFRESH' => 'N',
		'DEFAULT' => GetMessage('CP_BC_TPL_MESS_DELIVERY_TAB_DEFAULT')
	);
}
$arTemplateParameters['PRODUCT_ADD_INFO'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_PRODUCT_ADD_INFO'),
	'TYPE' => 'CHECKBOX',
	'REFRESH' => 'Y',
	'DEFAULT' => 'Y',
);
if ($arCurrentValues['PRODUCT_ADD_INFO'] === 'Y')
{
	$arTemplateParameters['MESS_ADD_INFO_TAB'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MESS_ADD_INFO_TAB'),
		'TYPE' => 'STRING',
		'REFRESH' => 'N',
		'DEFAULT' => GetMessage('CP_BC_TPL_MESS_ADD_INFO_TAB_DEFAULT')
	);
}