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
?>
<div class="news-detail">
	<div class="news-detail__top">
		<div class="news-detail__top-img">
		<img src='<?=$arResult["SLIDER"]['SRC']?>' loading='lazy' width='<?=$arResult["SLIDER"]['WIDTH']?>' height='<?=$arResult["SLIDER"]['HEIGHT']?>' alt=''>
		</div>
		<?if(!empty($arResult['DISPLAY_ACTIVE_FROM'])):?>
			<div class="news-detail__top-data"><?=$arResult['DISPLAY_ACTIVE_FROM']?></div>
		<?endif?>
	</div>
	<div class="news-detail__description typography">
		<?=$arResult["DETAIL_TEXT"]?>
	</div>
</div>