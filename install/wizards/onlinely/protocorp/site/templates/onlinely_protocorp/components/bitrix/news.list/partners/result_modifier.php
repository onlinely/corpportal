<?foreach($arResult["ITEMS"] as $cell => $arElement)
{
  $sliderCountElements = 0;
  $slider = array();
  if($arElement["PREVIEW_PICTURE"]["ID"])
  {
    $file = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"]["ID"],array('width' => 250,'height' => 140), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $slider['WIDTH'] = $file['width'];$slider['HEIGHT'] = $file['height'];$slider['SRC'] = $file['src'];
    $sliderCountElements++;
  }

  if($sliderCountElements == 0 && !empty($arElement["DETAIL_PICTURE"]["ID"]))
  {
    $file = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"]["ID"],array('width' => 250,'height' => 140), BX_RESIZE_IMAGE_PROPORTIONAL, true);$slider['WIDTH'] = $file['width'];
    $slider['HEIGHT'] = $file['height'];$slider['SRC'] = $file['src'];
    $sliderCountElements++;
  }
  $arResult["ITEMS"][$cell]['SLIDER'] = $slider;
}
