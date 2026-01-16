<?
$sliderCountElements = 0;
if(!empty($arResult["DETAIL_PICTURE"]["ID"]))
{
  $fileMin = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"],array('width' => 126,'height' => 126), BX_RESIZE_IMAGE_PROPORTIONAL, true);
  $arResult["SLIDER"][0]['WIDTH_MIN'] = $fileMin['width'];
  $arResult["SLIDER"][0]['HEIGHT_MIN'] = $fileMin['height'];
  $arResult["SLIDER"][0]['SRC_MIN'] = $fileMin['src'];

  $file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"],array('width' => 570,'height' => 430), BX_RESIZE_IMAGE_PROPORTIONAL, true);
  $arResult["SLIDER"][0]['WIDTH'] = $file['width'];
  $arResult["SLIDER"][0]['HEIGHT'] = $file['height'];
  $arResult["SLIDER"][0]['SRC'] = $file['src'];

  $fileBig = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"],array('width' => 1920,'height' => 1080), BX_RESIZE_IMAGE_PROPORTIONAL, true);
  $arResult["SLIDER"][0]['WIDTH_BIG'] = $fileBig['width'];
  $arResult["SLIDER"][0]['HEIGHT_BIG'] = $fileBig['height'];
  $arResult["SLIDER"][0]['SRC_BIG'] = $fileBig['src'];
  $sliderCountElements++;
}

if(!empty($arResult["PROPERTIES"]["MORE_PHOTO"]['VALUE'])){
  $key = 1;
  foreach($arResult["PROPERTIES"]["MORE_PHOTO"]['VALUE'] as $photo){
    $fileMin = CFile::ResizeImageGet($photo,array('width' => 126,'height' => 126), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["SLIDER"][$key]['WIDTH_MIN'] = $fileMin['width'];
    $arResult["SLIDER"][$key]['HEIGHT_MIN'] = $fileMin['height'];
    $arResult["SLIDER"][$key]['SRC_MIN'] = $fileMin['src'];
  
    $file = CFile::ResizeImageGet($photo,array('width' => 570,'height' => 430), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["SLIDER"][$key]['WIDTH'] = $file['width'];
    $arResult["SLIDER"][$key]['HEIGHT'] = $file['height'];
    $arResult["SLIDER"][$key]['SRC'] = $file['src'];
  
    $fileBig = CFile::ResizeImageGet($photo,array('width' => 1920,'height' => 1080), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["SLIDER"][$key]['WIDTH_BIG'] = $fileBig['width'];
    $arResult["SLIDER"][$key]['HEIGHT_BIG'] = $fileBig['height'];
    $arResult["SLIDER"][$key]['SRC_BIG'] = $fileBig['src'];
    $key++;
    $sliderCountElements++;
  }
}
if($sliderCountElements == 0 && !empty($arResult["PREVIEW_PICTURE"]["ID"])){

  $fileMin = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"],array('width' => 126,'height' => 126), BX_RESIZE_IMAGE_PROPORTIONAL, true);
  $arResult["SLIDER"][0]['WIDTH_MIN'] = $fileMin['width'];
  $arResult["SLIDER"][0]['HEIGHT_MIN'] = $fileMin['height'];
  $arResult["SLIDER"][0]['SRC_MIN'] = $fileMin['src'];

  $file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"],array('width' => 570,'height' => 430), BX_RESIZE_IMAGE_PROPORTIONAL, true);
  $arResult["SLIDER"][0]['WIDTH'] = $file['width'];
  $arResult["SLIDER"][0]['HEIGHT'] = $file['height'];
  $arResult["SLIDER"][0]['SRC'] = $file['src'];

  $fileBig = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"],array('width' => 1920,'height' => 1080), BX_RESIZE_IMAGE_PROPORTIONAL, true);
  $arResult["SLIDER"][0]['WIDTH_BIG'] = $fileBig['width'];
  $arResult["SLIDER"][0]['HEIGHT_BIG'] = $fileBig['height'];
  $arResult["SLIDER"][0]['SRC_BIG'] = $fileBig['src'];
  $sliderCountElements++;
}

if(empty($arResult["SLIDER"])){
  $arResult["SLIDER"][0]['WIDTH'] = '570';
  $arResult["SLIDER"][0]['HEIGHT'] = '470';
  $arResult["SLIDER"][0]['SRC'] = SITE_TEMPLATE_PATH . '/img/no-photo570.jpg';
}

$arResult["SLIDER_COUNTS"] = $sliderCountElements;

