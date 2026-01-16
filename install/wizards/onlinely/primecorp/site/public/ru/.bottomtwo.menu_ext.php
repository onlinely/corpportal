<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

$aMenuLinksExt = array();

if (CModule::IncludeModule('iblock')) {
    $IBLOCK_ID = '#SERVICES_IBLOCK_ID#';

    $arIBlock = CIBlock::GetByID($IBLOCK_ID)->GetNext();
    
    if ($arIBlock) {
        if (defined("BX_COMP_MANAGED_CACHE")) {
            $GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_" . $IBLOCK_ID);
        }

        $aMenuLinksExt = $APPLICATION->IncludeComponent(
            "onlinely:menu.sections",
            "",
            array(
                "IS_SEF" => "Y",
                "SEF_BASE_URL" => "",
                "SECTION_PAGE_URL" => $arIBlock['SECTION_PAGE_URL'],
                "DETAIL_PAGE_URL" => $arIBlock['DETAIL_PAGE_URL'],
                "IBLOCK_TYPE" => $arIBlock['IBLOCK_TYPE_ID'],
                "IBLOCK_ID" => $IBLOCK_ID,
                "DEPTH_LEVEL" => "1",
                "CACHE_TYPE" => "N",
            ),
            false,
            Array('HIDE_ICONS' => 'Y')
        );

        if (defined("BX_COMP_MANAGED_CACHE")) {
            $GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_new");
        }
    }
}

$aMenuLinks = array_merge(
    is_array($aMenuLinksExt) ? $aMenuLinksExt : array(),
    is_array($aMenuLinks) ? $aMenuLinks : array()
);
?>