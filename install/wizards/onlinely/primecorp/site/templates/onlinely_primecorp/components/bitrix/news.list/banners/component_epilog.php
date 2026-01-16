<?
use Bitrix\Main\Page\Asset;
if(!empty($arResult['TEMPLATE_FOLDER'])){
    Asset::getInstance()->addCss($arResult['TEMPLATE_FOLDER'] . '/banners.css');
}
?>