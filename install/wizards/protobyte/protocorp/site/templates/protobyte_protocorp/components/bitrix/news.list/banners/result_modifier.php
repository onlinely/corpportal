<?
if(!empty($arResult["ITEMS"])){
  foreach($arResult["ITEMS"] as $cell => $arElement)
  {
    $slider = array();
    if($arElement["PREVIEW_PICTURE"]["ID"])
    {
      $file = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"]["ID"],array('width' => 650,'height' => 850), BX_RESIZE_IMAGE_PROPORTIONAL, true);
      $slider["PREVIEW"]['WIDTH'] = $file['width'];
      $slider["PREVIEW"]['HEIGHT'] = $file['height'];
      $slider["PREVIEW"]['SRC'] = $file['src'];
    }

    if($sliderCountElements == 0 && !empty($arElement["DETAIL_PICTURE"]["ID"]))
    {
      $file = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"]["ID"],array('width' => 1920,'height' => 850), BX_RESIZE_IMAGE_PROPORTIONAL, true);
      $slider["BACKGROUND"]['WIDTH'] = $file['width'];
      $slider["BACKGROUND"]['HEIGHT'] = $file['height'];
      $slider["BACKGROUND"]['SRC'] = $file['src'];
    }
    
    $arResult["ITEMS"][$cell]['SLIDER'] = $slider;
  }

  $cp = $this->__component;
  if (is_object($cp)) {
      $cp->arResult['TEMPLATE_FOLDER'] = $this->GetFolder();     
      $cp->SetResultCacheKeys(array('TEMPLATE_FOLDER'));
  }
}