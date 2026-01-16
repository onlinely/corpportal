<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

CModule::IncludeModule('fileman');
$arMenuTypes = GetMenuTypes(WIZARD_SITE_ID);

$newMenuTypes = array(
	'top' => GetMessage("WIZ_MENU_TOP"),
	'left' => GetMessage("WIZ_MENU_LEFT"),
	'bottomone' => GetMessage("WIZ_MENU_BOTTOMONE"),
	'bottomtwo' => GetMessage("WIZ_MENU_BOTTOMTWO"),
	'bottomthree' => GetMessage("WIZ_MENU_BOTTOMTHREE"),
);

foreach ($newMenuTypes as $type => $name) {
    if (!isset($arMenuTypes[$type]) || $arMenuTypes[$type] != $name) {
        $arMenuTypes[$type] = $name;
    }
}


SetMenuTypes($arMenuTypes, WIZARD_SITE_ID);

COption::SetOptionInt("fileman", "num_menu_param", 2, false, WIZARD_SITE_ID);
?>