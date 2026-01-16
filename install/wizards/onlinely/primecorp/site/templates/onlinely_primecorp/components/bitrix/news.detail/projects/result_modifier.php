<?
$arResult["SLIDER"] = array();
if(!empty($arResult["DETAIL_PICTURE"]["ID"]))
{
  $file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"],array('width' => 570,'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true);
  $arResult["SLIDER"]['WIDTH'] = $file['width'];
  $arResult["SLIDER"]['HEIGHT'] = $file['height'];
  $arResult["SLIDER"]['SRC'] = $file['src'];
}
if(empty($arResult["SLIDER"]) && !empty($arResult["PREVIEW_PICTURE"]["ID"])){

  $file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"],array('width' => 570,'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true);
  $arResult["SLIDER"]['WIDTH'] = $file['width'];
  $arResult["SLIDER"]['HEIGHT'] = $file['height'];
  $arResult["SLIDER"]['SRC'] = $file['src'];
  $sliderCountElements++;
}

if(empty($arResult["SLIDER"])){
  $arResult["SLIDER"]['WIDTH'] = '570';
  $arResult["SLIDER"]['HEIGHT'] = '470';
  $arResult["SLIDER"]['SRC'] = SITE_TEMPLATE_PATH . '/img/no-photo570.jpg';
}

