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
$this->setFrameMode(true);
$detailShowPropertyId = \Bitrix\Iblock\Model\PropertyFeature::getDetailPageShowPropertyCodes($arParams["IBLOCK_ID"]);

$rsProperty = \Bitrix\Iblock\PropertyTable::getList(array(
    'filter' => array(
        'IBLOCK_ID' => $arParams["IBLOCK_ID"],
        '=ID' => $detailShowPropertyId,
    ),
    'select' => array(
        'ID', 'CODE', 'SORT',
    ),
    'order' => array(
        'SORT' => 'ASC',
    ),
));

$detailShowPropertyCode = array();
while ($property = $rsProperty->fetch()) {
    $detailShowPropertyCode[] = $property['CODE'];
}

if (empty($detailShowPropertyCode)) {
    $dbProperties = CIBlockProperty::GetList(
        array('SORT' => 'ASC'),
        array("IBLOCK_ID" => $arParams["IBLOCK_ID"])
    );
    while ($arProperty = $dbProperties->Fetch()) {
        $detailShowPropertyCode[] = $arProperty['CODE'];
    }
}
?>
<div class="page-content-sidebar catalog-section-sidebar">
<div class="content">
<h1 class="page-title"><?$APPLICATION->ShowTitle();?></h1>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"services",
	[
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $detailShowPropertyCode,
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "NAME",
		"SORT_ORDER2" => "DESC",
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
		'STRICT_SECTION_CHECK' => $arParams['STRICT_SECTION_CHECK'],
	],
	$component
);?>
    </div> <!-- content -->
    <div class="sidebar">
        <?include($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/page_blocks/sidebar.php");?>
    </div>
</div>
<?if ($ElementID > 0) {
    
    $currentSectionId = null;
    if ($arResult['VARIABLES']['SECTION_CODE']) {
        $rsSection = CIBlockSection::GetList(
            [],
            ['CODE' => $arResult['VARIABLES']['SECTION_CODE'], 'IBLOCK_ID' => $arParams['IBLOCK_ID']],
            false,
            ['ID']
        );
        if ($arSection = $rsSection->Fetch()) {
            $currentSectionId = $arSection['ID'];
        }
    }

    if (!$currentSectionId) {
        $rsElement = CIBlockElement::GetList(
            [],
            ['ID' => $ElementID, 'IBLOCK_ID' => $arParams['IBLOCK_ID']],
            false,
            false,
            ['ID', 'IBLOCK_SECTION_ID']
        );
        if ($arElement = $rsElement->Fetch()) {
            $currentSectionId = $arElement['IBLOCK_SECTION_ID'];
        }
    }

    if ($currentSectionId) {
        if (!isset($arParams['DETAIL_SHOW_POPULAR']) || $arParams['DETAIL_SHOW_POPULAR'] != 'N') {
            // Получаем количество товаров в разделе
            $arFilter = [
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'SECTION_ID' => $currentSectionId,
                'ACTIVE' => 'Y',
            ];
            $dbItems = CIBlockElement::GetList([], $arFilter, false, false, ['ID']);
            $itemsCount = 0;
            while ($dbItems->GetNext()) {
                $itemsCount++;
            }
    
            if ($itemsCount > 1) {
                $GLOBALS['arrFilter'] = [
                    '!ID' => $ElementID,
                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                    'SECTION_ID' => $currentSectionId,
                    'ACTIVE' => 'Y',
                ];?>
                <div class="page-block block-catalog-list" style="width: 100%;">
                    <div class="page-block__head">
                        <div class="page-block__title">
                            <h2><?=GetMessage('OTHER_SERVICES_TITLE')?></h2>
                        </div>
                        <div class="page-block__link">
                            <a href="<?=SITE_DIR?>services/"><?=GetMessage('SERVICES_LINK')?></a>
                        </div>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        'bitrix:news.list',
                        'services',
                        [
                            'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                            'FILTER_NAME' => 'arrFilter',
                            'NEWS_COUNT' => 3,
                            'SORT_BY1' => 'SHOW_COUNTER',
                            'SORT_ORDER1' => 'DESC',
                            'SORT_BY2' => 'SORT',
                            'SORT_ORDER2' => 'ASC',
                            'FIELD_CODE' => ['ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL'],
                            'PROPERTY_CODE' => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
                            'SET_TITLE' => 'N',
                            'SET_BROWSER_TITLE' => 'N',
                            'SET_META_KEYWORDS' => 'N',
                            'SET_META_DESCRIPTION' => 'N',
                            'SET_LAST_MODIFIED' => 'N',
                            'INCLUDE_SUBSECTIONS' => 'Y',
                            'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                            'CACHE_TIME' => $arParams['CACHE_TIME'],
                            'CACHE_FILTER' => $arParams['CACHE_FILTER'],
                            'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                            'DISPLAY_TOP_PAGER' => 'N',
                            'DISPLAY_BOTTOM_PAGER' => 'N',
                            'PAGER_SHOW_ALWAYS' => 'N',
                            'PAGER_TEMPLATE' => '',
                            'PAGER_SHOW_ALL' => 'N',
                            'ADD_SECTIONS_CHAIN' => 'N',
                            'ADD_ELEMENT_CHAIN' => 'N',
                            'INCLUDE_IBLOCK_INTO_CHAIN' => 'N'
                        ],
                        $component
                    );?>
                </div>
            <?}
        }
    }
}