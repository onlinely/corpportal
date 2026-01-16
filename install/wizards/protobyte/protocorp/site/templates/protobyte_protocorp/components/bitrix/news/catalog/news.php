<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>

<div class="page-content-sidebar">
	<div class="content section-list-root">
		<h1 class="page-title"><?$APPLICATION->ShowTitle(false);?></h1>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"category",
			Array(
				"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
				"ADD_SECTIONS_CHAIN" => "N",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "AUTO",
				"COUNT_ELEMENTS" => "N",
				"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
				"FILTER_NAME" => "sectionsFilter",
				"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"IBLOCK_TYPE" => $arParams["IBLOCK_ID"],
				"SECTION_CODE" => "",
				"SECTION_FIELDS" => array("",""),
				"SECTION_ID" => $_REQUEST["SECTION_ID"],
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array("",""),
				"SHOW_PARENT_NAME" => "Y",
				"TOP_DEPTH" => "1",
				"VIEW_MODE" => "LINE"
			)
		);
		?>
	</div>
	<div class="sidebar">
		<?include($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/page_blocks/sidebar.php");?>
	</div>
</div>