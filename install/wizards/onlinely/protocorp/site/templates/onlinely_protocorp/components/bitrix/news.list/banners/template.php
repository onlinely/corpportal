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
use Bitrix\Main\Page\Asset;
$this->setFrameMode(true);
?>
<?if(!empty($arResult["ITEMS"])):?>
	<div class="banners-block">
    	<div class="banners swiper-container">
			<div class="swiper-wrapper">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="swiper-slide <?=!empty($arItem['PROPERTIES']['LIGHT_TEXT_HEADER']['VALUE']) ? 'slide-white' : ''?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="banner" style="background-image: url('<?=$arItem['SLIDER']["BACKGROUND"]['SRC']?>');">
							<div class="banner__container container">
								<div class="banner__inner">
									<div class="banner__info">
										<?if(trim($arItem['PROPERTIES']['SUBTITLE']['VALUE']) != ''):?>
											<div class="banner__subtitle"><?=$arItem['PROPERTIES']['SUBTITLE']['VALUE']?></div>
										<?endif?>
										<div class="banner__title"><?=$arItem['NAME']?></div>
										<div class="banner__btns">
											<?if(!empty($arItem['PROPERTIES']['BTN']['VALUE'])):?>
												<div class="banner__btn">
													<div class="btn-default openFeedback" data-nameprod="<?=$arItem['NAME']?>" data-titleform="<?=GetMessage('BANNER_BTN')?>" data-pageform="<?=$full_url?>">
														<?=GetMessage('BANNER_BTN')?>
													</div>
												</div>
											<?endif?>
											<?if(!empty(trim($arItem['PROPERTIES']['LINK']['VALUE']))):?>
												<div class="banner__btn">
													<a href="<?=trim($arItem['PROPERTIES']['LINK']['VALUE'])?>" class="btn-transparent">
														<?=GetMessage('BANNER_LINK')?>
													</a>
												</div>
											<?endif?>
										</div>
									</div>
									<?if(!empty($arItem['SLIDER']["PREVIEW"]['SRC'])):?>
										<div class="banner__img-wrapper">
											<img src="<?=$arItem['SLIDER']["PREVIEW"]['SRC']?>" alt="" class="banner-object">
										</div>
									<?endif?>
								</div>
							</div>
						</div>
						<div class="banner__info-mobile">
							<?if(trim($arItem['PROPERTIES']['SUBTITLE']['VALUE']) != ''):?>
								<div class="banner__subtitle"><?=$arItem['PROPERTIES']['SUBTITLE']['VALUE']?></div>
							<?endif?>
							<div class="banner__title"><?=$arItem['NAME']?></div>
							<div class="banner__btns">
								<?if(!empty(trim($arItem['PROPERTIES']['BTN']['VALUE']))):?>
									<div class="banner__btn">
										<div class="btn-default openFeedback" data-nameprod="<?=$arItem['NAME']?>" data-titleform="<?=GetMessage('BANNER_BTN')?>" data-pageform="<?=$full_url?>">
											<?=GetMessage('BANNER_BTN')?>
										</div>
									</div>
								<?endif?>
								<?if(!empty(trim($arItem['PROPERTIES']['LINK']['VALUE']))):?>
									<div class="banner__btn">
										<a href="<?=trim($arItem['PROPERTIES']['LINK']['VALUE'])?>" class="btn-transparent">
											<?=GetMessage('BANNER_LINK')?>
										</a>
									</div>
								<?endif?>
							</div>
						</div>
					</div>
				<?endforeach;?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
<?endif?>
