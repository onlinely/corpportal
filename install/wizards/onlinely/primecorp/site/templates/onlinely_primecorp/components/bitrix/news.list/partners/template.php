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
<?if(!empty($arResult["ITEMS"])):?>
	<div class="partners">
    	<div class="container">
			<div class="partners__slider swiper-container">
				<div class="partners__slider-wrapper swiper-wrapper">
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<?if(!empty($arItem['SLIDER'])):?>
						<div class="partners__slide swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="partners__slide-img">
								<img src="<?=$arItem['SLIDER']['SRC']?>" loading="lazy" width="<?=$arItem['SLIDER']['WIDTH']?>" height="<?=$arItem['SLIDER']['HEIGHT']?>" alt="">
							</div>
						</div>
						<?endif?>
					<?endforeach;?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
    	</div>
	</div>
<?endif?>