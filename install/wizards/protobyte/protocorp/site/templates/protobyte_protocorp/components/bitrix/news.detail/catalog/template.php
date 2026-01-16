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
$APPLICATION->SetTitle("");
?>
 <div class="catalog-detail">
	<div class="catalog-detail__top">
		<div class="catalog-detail__top-left">
			<div class="catalog-detail__slider">
				<div class="catalog-detail__main-slider-wrap">
					<div class="catalog-detail__main-slider swiper-container">
						<div class="catalog-detail__main-slider-items swiper-wrapper">
							<?foreach($arResult["SLIDER"] as $numb => $slide):?>
								<div class="catalog-detail__main-slider-item swiper-slide">
									<?if($arResult["SLIDER_COUNTS"] > 0):?>
									<a href="<?=$slide['SRC_BIG']?>" data-fancybox="product">
										<img src='<?=$slide['SRC']?>' width='<?=$slide['WIDTH']?>' height='<?=$slide['WIDTH']?>' alt='<?=$arResult["NAME"]?><?=$numb?>'>
									</a>
									<?else:?>
										<img src='<?=$slide['SRC']?>' width='<?=$slide['WIDTH']?>' height='<?=$slide['WIDTH']?>' alt='no-photo'>
									<?endif?>	
								</div>
							<?endforeach?>
						</div>
					</div>
				</div>
				<div class="swiper-pagination"></div>
				<div class="catalog-detail__thumbnail-slider swiper-container">
					<div class="catalog-detail__thumbnail-slider-items swiper-wrapper">
						<?if($arResult["SLIDER_COUNTS"] > 1):?>
							<?foreach($arResult["SLIDER"] as $numb => $slide):?>
								<div class="catalog-detail__thumbnail-slider-item swiper-slide">
									<img src='<?=$slide['SRC_MIN']?>' width='<?=$slide['WIDTH_MIN']?>' height='<?=$slide['WIDTH_MIN']?>' alt='<?=$arResult["NAME"]?><?=$numb?>'>
								</div>
							<?endforeach?>
						<?endif?>
					</div>
					<div class="catalog-detail__arrows" style="display: none;">
						<div class="swiper-button-next">
							<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.5 8.5L4.42787 5.18846C4.45064 5.16429 4.46879 5.1351 4.48119 5.10268C4.4936 5.07027 4.5 5.03532 4.5 5C4.5 4.96468 4.4936 4.92973 4.48119 4.89732C4.46879 4.8649 4.45064 4.83571 4.42787 4.81154L1.5 1.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
						<div class="swiper-button-prev">
							<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.5 8.5L1.57213 5.18846C1.54936 5.16429 1.53121 5.1351 1.51881 5.10268C1.5064 5.07027 1.5 5.03532 1.5 5C1.5 4.96468 1.5064 4.92973 1.51881 4.89732C1.53121 4.8649 1.54936 4.83571 1.57213 4.81154L4.5 1.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="catalog-detail__top-right">
			<?if(!empty($arResult['PROPERTIES']['OUR_OFFERS']['VALUE'])):?>
				<div class="catalog-detail__stickers">
					<?foreach($arResult['PROPERTIES']['OUR_OFFERS']['VALUE'] as $key => $name):?>
						<div class="catalog-detail__stickers-item">
							<div class="catalog-detail__stickers-card stick-<?=$arResult['PROPERTIES']['OUR_OFFERS']['VALUE_XML_ID'][$key]?>"><?=$name?></div>
						</div>
					<?endforeach?>
				</div>
			<?endif?>
			<div class="catalog-detail__title">
				<h1><?=!empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult["NAME"];?></h1>
			</div>
			<?if(!empty($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'])):?>
				<div class="catalog-detail__article"><?=getMessage('ELEMENT_ARTICLE')?><?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></div>
			<?endif?>
			<?$price = trim($arResult['PROPERTIES']['PRICE_CARD']['VALUE']);?>
			<?if($price != ''):?>
				<div class="catalog-detail__prices">
					<div class="catalog-detail__price-actual"><?=$price?></div>
					<?$priceOld = trim($arResult['PROPERTIES']['OLD_PRICE_CARD']['VALUE']);?>
					<?if($priceOld != ''):?>
						<div class="catalog-detail__price-old"><?=$priceOld?></div>
					<?endif?>
				</div>
			<?endif?>
			<div class="catalog-detail__btn">
				<div class="btn-default openFeedback" data-nameprod="<?=$arResult['NAME']?>" data-titleform="<?=getMessage('ELEMENT_BY')?>&laquo;<?=$arResult['NAME']?>&raquo;" data-pageform="<?=$GLOBALS['full_url']?>"><?=getMessage('ELEMENT_BY')?></div>
			</div>
			<?if(!empty($arResult['DISPLAY_PROPERTIES'])):?>

				<div class="catalog-detail__props">
					<?foreach(array_slice($arResult['DISPLAY_PROPERTIES'], 0, 3) as $property):?>
						<div class="catalog-detail__props-item">
							<div class="catalog-detail__props-name"><span><?=$property['NAME']?></span></div>
							<div class="catalog-detail__props-value"><span><?=is_array($property['DISPLAY_VALUE']) ? implode(', ', $property['DISPLAY_VALUE']): $property['DISPLAY_VALUE']?></span></div>
						</div>
					<?endforeach?>
				</div>
			<?endif?>
		</div>
	</div>
	<?if(!empty(trim($arResult['DETAIL_TEXT']))
	|| !empty($arResult['DISPLAY_PROPERTIES'] && is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 3)
	|| $arParams['PRODUCT_ADD_INFO'] == 'Y'
	|| $arParams['PRODUCT_DELIVERY'] == 'Y'):?>
		<div class="product-detail__tabs">
			<div class="detail-tabs tabs">
				<ul class="tabs__caption">
					<?$isFirstTabActive = true;?>
					<?if(!empty(trim($arResult['DETAIL_TEXT']))):?>
						<li class="<?=$isFirstTabActive ? 'active' : ''?>" data-entity="tab" data-value="description">
							<a href="javascript:void(0);"><?=getMessage('TAB_DESC')?></a>
						</li>
						<?$isFirstTabActive = false;?>
					<?endif?>
					<?if(!empty($arResult['DISPLAY_PROPERTIES'] && is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 3 )):?>
						<li class="<?=$isFirstTabActive ? 'active' : ''?>" data-entity="tab" data-value="properties">
							<a href="javascript:void(0);"><?= getMessage('TAB_PROPS')?></a>
						</li>
						<?$isFirstTabActive = false;?>
					<?endif?>
					<?if($arParams['PRODUCT_DELIVERY'] == 'Y'):?>
						<li class="<?=$isFirstTabActive ? 'active' : ''?>" data-entity="tab" data-value="add_delivery">
							<a href="javascript:void(0);"><?=empty($arParams['MESS_DELIVERY_TAB']) ? getMessage('TAB_DELIVERY') : $arParams['MESS_DELIVERY_TAB']?></a>
						</li>
						<?$isFirstTabActive = false;?>
					<?endif?>
					<?if($arParams['PRODUCT_ADD_INFO'] == 'Y'):?>
						<li class="<?=$isFirstTabActive ? 'active' : ''?>" data-entity="tab" data-value="add_info">
							<a href="javascript:void(0);"><?=empty($arParams['MESS_DELIVERY_TAB']) ? getMessage('TAB_DOP') : $arParams['MESS_DELIVERY_TAB']?></a>
						</li>
						<?$isFirstTabActive = false;?>
					<?endif?>
				</ul>
				<?$isFirstTabActive = true;?>
				<?if(!empty(trim($arResult['DETAIL_TEXT']))):?>
					<div class="tabs__content <?=$isFirstTabActive ? 'active' : ''?> typography" data-entity="tab-container" data-value="description" itemprop="description">
						<?=$arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>';?>
					</div>
					<?$isFirstTabActive = false;?>
				<?endif?>
				<?if(!empty($arResult['DISPLAY_PROPERTIES'] && is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 3)):?>
					<div class="tabs__content <?=$isFirstTabActive ? 'active' : ''?>" data-entity="tab-container" data-value="properties">
						<div class="catalog-detail__props">
							<?foreach($arResult['DISPLAY_PROPERTIES'] as $property):?>
								<div class="catalog-detail__props-item">
									<div class="catalog-detail__props-name"><span><?=$property['NAME']?></span></div>
									<div class="catalog-detail__props-value typography">
										<span>
											<?=is_array($property['DISPLAY_VALUE']) ? implode(', ', $property['DISPLAY_VALUE']): $property['DISPLAY_VALUE']?>
										</span>
									</div>
								</div>
							<?endforeach?>
						</div>
					</div>
					<?$isFirstTabActive = false;?>
				<?endif?>
				<?if($arParams['PRODUCT_DELIVERY'] == 'Y'):?>
					<div class="tabs__content <?=$isFirstTabActive ? 'active' : ''?> typography" data-entity="tab-container" data-value="add_delivery">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR . "include/delivery_and_payment.php"
						]); ?>
					</div>
					<?$isFirstTabActive = false;?>
				<?endif?>
				<?if($arParams['PRODUCT_ADD_INFO'] == 'Y'):?>
					<div class="tabs__content <?=$isFirstTabActive ? 'active' : ''?> typography" data-entity="tab-container" data-value="add_info">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR . "include/add_info.php"
						]); ?>
					</div>
					<?$isFirstTabActive = false;?>
				<?endif?>
			</div>
		</div>
	<?endif?>
</div>
