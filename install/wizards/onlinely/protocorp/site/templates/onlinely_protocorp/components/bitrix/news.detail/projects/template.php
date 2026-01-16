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
	<div class="news-detail__two-column">
		<div class="news-detail__left">
			<div class="news-detail__img">
				<img src='<?=$arResult["SLIDER"]['SRC']?>' loading='lazy' width='<?=$arResult["SLIDER"]['WIDTH']?>' height='<?=$arResult["SLIDER"]['HEIGHT']?>' alt=''>
			</div>
		</div>
		<div class="news-detail__right">
			<?if(!empty($arResult["DISPLAY_PROPERTIES"])):?>
				<div class="news-detail__props">
					<?foreach($arResult["DISPLAY_PROPERTIES"] as $code => $prop):?>
						<?if(trim($prop['VALUE']) != ''):?>
							<div class="news-detail__props-item">
								<div class="news-detail__props-name"><span><?=$prop['NAME']?></span></div>
								<div class="news-detail__props-value"><span><?=$prop['VALUE']?></span></div>
							</div>
						<?endif?>
					<?endforeach?>
				</div>
			<?endif?>
		</div>
	</div>
	<div class="news-detail__description typography">
		<?=$arResult["DETAIL_TEXT"]?>
	</div>
</div>
