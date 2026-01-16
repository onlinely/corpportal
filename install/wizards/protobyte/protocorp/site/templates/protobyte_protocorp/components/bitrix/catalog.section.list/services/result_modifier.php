<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
			
$idSect = $arResult['SECTION']['ID'];
$activeElements = CIBlockSection::GetSectionElementsCount($idSect, Array("CNT_ACTIVE"=>"Y"));

$arResult["SECTION_ELEMENTS_COUNT"] = $activeElements;

foreach ($arResult['SECTIONS'] as $cell => $arElement):
	$picture = CFile::ResizeImageGet($arElement["PICTURE"]['ID'], array('width'=>690, 'height'=>250), BX_RESIZE_IMAGE_PROPORTIONAL, true, array());   
	$arResult["SECTIONS"][$cell]["PICTURE"]['SRC'] = $picture['src'];
	$arResult["SECTIONS"][$cell]["PICTURE"]['WIDTH'] = $picture['width'];
	$arResult["SECTIONS"][$cell]["PICTURE"]['HEIGHT'] = $picture['height'];
endforeach;
?>