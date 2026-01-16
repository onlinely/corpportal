<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$currentSectionId = $arResult['VARIABLES']['SECTION_ID'];
$iblockId = $arParams['IBLOCK_ID'];
$sectionIds = [$currentSectionId];
$subSections = CIBlockSection::GetList(
    ['LEFT_MARGIN' => 'ASC'],
    [
        'IBLOCK_ID' => $iblockId,
        'SECTION_ID' => $currentSectionId,
    ],
    false,
    ['ID']
);
while ($subSection = $subSections->Fetch()) {
    $sectionIds[] = $subSection['ID'];
}
$elementFilter = [
    'IBLOCK_ID' => $iblockId,
    'SECTION_ID' => $sectionIds,
    'ACTIVE' => 'Y',
];
$elements = CIBlockElement::GetList([], $elementFilter, false, false, ['ID'])->Fetch();
$GLOBALS['arrFilter'] = array(
    'SECTION_ID' => $currentSectionId,
    'INCLUDE_SUBSECTIONS' => 'Y',
    'SECTION_GLOBAL_ACTIVE' => 'Y'
);
?>
<div class="page-content-sidebar catalog-section-sidebar">
    <div class="sidebar">
        <?if($arParams["USE_FILTER"]=="Y" && $elements):
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.smart.filter",
                "smart-filter",
                [
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "FILTER_NAME" => "arrFilter",
                    "PRICE_CODE" => $arParams["PRICE_CODE"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "SAVE_IN_SESSION" => "N",
                    "FILTER_VIEW_MODE" => "VERTICAL",
                    "XML_EXPORT" => "N",
                    "SECTION_ID" => $currentSectionId,
                    "SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
                    "INSTANT_RELOAD" => "Y",
                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    "DISPLAY_ELEMENT_COUNT" => "Y",
                ],
                $component,
                ['HIDE_ICONS' => 'Y']
            );
        endif;?>
        <?include($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/page_blocks/sidebar.php");?>
    </div>
    <div class="content">
        
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
                "SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
                "SECTION_FIELDS" => array("",""),
                "SECTION_ID" => $arResult['VARIABLES']['SECTION_ID'],
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array("",""),
                "SHOW_PARENT_NAME" => "Y",
                "TOP_DEPTH" => "1",
                "VIEW_MODE" => "LINE"
            )
        );?>
        <?if($elements):?>
            <div class="cards__top">
				<?
				$sort = $arParams["SORT_BY1"];
				$order = $arParams["SORT_ORDER1"];
                
                if (!empty($_GET["sort"]) && !empty($_GET["order"])){
                    $sort = $_GET["sort"];
                    $order = $_GET["order"];
				}?>
				<div class="sort-panel">
                    <ul class="sort-panel__items">
                        <li class="sort-panel__item all-sort <?=$sort == 'SORT' && $order == 'ASC' ?'active' : ''?>">
                            <a href="<?=$APPLICATION->GetCurPageParam("sort=SORT&order=ASC", array("sort", "order", 'bxajaxid'))?>">
                                <span><?=GetMessage('SORT_POPULAR')?></span>
                            </a>
                        </li>
                        <?$sortForAlphName = 'NAME';
                        $sortForAlphsORT = 'ASC';
                        $class = 'sort_toggle';
                        $checked = '';?>
                        <?if($sort == 'NAME'){
                            $checked = "active";
                            if($order == 'ASC'){
                                $class = '';
                                $sortForAlphsORT = 'DESC';
                            }
                        }?>
                        <li class="sort-panel__item name-sort <?=$class?> <?=$checked?>">
                            <a href="<?=$APPLICATION->GetCurPageParam("sort={$sortForAlphName}&order={$sortForAlphsORT}", array("sort", "order", 'bxajaxid'))?>">
                                <i>
                                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5.66699L6 1.00033L11 5.66699" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6 1V13" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </i> 
                                <span><?=GetMessage('SORT_NAME')?></span>
                            </a>
                        </li>
                        <?
                        $sortForPriceName = 'PROPERTY_PRICE_FILTER';
                        $sortForPriceSort = 'ASC';
                        $classPrice = 'sort_toggle';
                        $checkedPrice = '';
                        if ($_REQUEST["sort"] == 'PROPERTY_PRICE_FILTER') {
                            $checkedPrice = "active";
                            if ($_REQUEST["order"] == 'ASC') {
                                $classPrice = '';
                                $sortForPriceSort = 'DESC';
                            }
                        }
                        ?>
                        <li class="sort-panel__item name-sort <?=$classPrice?> <?=$checkedPrice?>">
                            <a href="<?=$APPLICATION->GetCurPageParam("sort={$sortForPriceName}&order={$sortForPriceSort}", array("sort", "order", 'bxajaxid'))?>">
                                <i>
                                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5.66699L6 1.00033L11 5.66699" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6 1V13" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </i> 
                                <span><?=GetMessage('SORT_PRICE')?></span>
                            </a>
                        </li>
                    </ul>
                </div>

			</div>
        <?endif?>
        <div class="catalog-section">
            <div class="catalog-section__filter-mobile"></div>
            <?$dbProperties = CIBlockProperty::GetList(array(),array("IBLOCK_ID" => $arParams["IBLOCK_ID"]));
            $arProperty = $dbProperties->Fetch();               
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "catalog",
                [
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                    "SORT_BY1" => $sort,
                    "SORT_ORDER1" => $order,
                    "SORT_BY2" => $arParams["SORT_BY2"],
                    "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                    "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                    "PROPERTY_CODE" => array($arProperty['CODE']),
                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                    "SET_TITLE" => $arParams["SET_TITLE"],
                    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                    "SHOW_404" => $arParams["SHOW_404"],
                    "FILE_404" => $arParams["FILE_404"],
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                    "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                    "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                    "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                    "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                    "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                    "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                    "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                    "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                    "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                    "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                    "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                    "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                    "FILTER_NAME" => "arrFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                    "CHECK_DATES" => $arParams["CHECK_DATES"],
                    "STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],
                    "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
                    "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                ],
                $component
            );?>
        </div>
        <?if(empty($elements)):?>
            <div class="catalog-none"><?=GetMessage('EMPTY_SECTION')?></div>
        <?endif?>
    </div>
</div>