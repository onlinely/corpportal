<?foreach($arResult["ITEMS"] as $cell => $arElement)
{
  $sliderCountElements = 0;
  if($arElement["PREVIEW_PICTURE"]["ID"])
  {
    $file = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"]["ID"],array('width' => 500,'height' => 360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $slider['WIDTH'] = $file['width'];$slider['HEIGHT'] = $file['height'];$slider['SRC'] = $file['src'];
    $sliderCountElements++;
  }

  if($sliderCountElements == 0 && !empty($arElement["DETAIL_PICTURE"]["ID"]))
  {
    $file = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"]["ID"],array('width' => 500,'height' => 360), BX_RESIZE_IMAGE_PROPORTIONAL, true);$slider['WIDTH'] = $file['width'];$slider['HEIGHT'] = $file['height'];$slider['SRC'] = $file['src'];
    $sliderCountElements++;
  }
  
  if($sliderCountElements == 0){
    $slider['WIDTH'] = '270';
    $slider['HEIGHT'] = '270';
    $slider['SRC'] = SITE_DIR . 'include/img/no-photo270.jpg';
  }
  $arResult["ITEMS"][$cell]['SLIDER'] = $slider;
}
