<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arServices = Array(
	"main" => Array(
		"NAME" => GetMessage("SERVICE_MAIN_SETTINGS"),
		"STAGES" => Array(
			"files.php", // Copy files
			"template.php", // Install template
			"menu.php", // Install menu
			"settings.php", // Install settings
			"events.php", // Install post event
		),
	),
	"iblock" => Array(
		"NAME" => GetMessage("SERVICE_IBLOCK"),
		"STAGES" => Array(
			"types.php", //IBlock types
			"articles.php",
			"banner.php",
			"catalog.php",
			"icon-banner.php",
			"news.php",
			"partners.php",
			"projects.php",
			"services.php",
			"references.php",//reference of colors
			"references2.php",
		),
	),
);
?>