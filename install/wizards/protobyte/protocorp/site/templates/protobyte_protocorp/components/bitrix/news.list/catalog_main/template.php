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
<div class="page-block block-catalog-list">
    <div class="container">
        <div class="page-block__head">
            <div class="page-block__title">
                <h2><?=GetMessage('CATALOG_POPULAR_TITLE')?></h2>
            </div>
            <div class="page-block__link">
                <a href="<?=SITE_DIR?>catalog/"><?=GetMessage('CATALOG_ALL')?></a>
            </div>
        </div>
		<div class="catalog-list">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="catalog-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="product">
						<?if(!empty($arItem["PROPERTIES"]["OUR_OFFERS"]["VALUE_XML_ID"])):?>
							<div class="product__stickers">
								<?foreach($arItem["PROPERTIES"]["OUR_OFFERS"]["VALUE"] as $key => $item):?>
									<div class="product__stickers-item">
										<div class="product__stickers-card stick-<?=$arItem["PROPERTIES"]["OUR_OFFERS"]["VALUE_XML_ID"][$key]?>"><?=$item?></div>
									</div>
								<?endforeach?>
							</div>
						<?endif?>
						<div class="product__img">
							<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
								<img src='<?=$arItem['SLIDER']['SRC']?>' loading='lazy' width='<?=$arItem['SLIDER']['WIDTH']?>' height='<?=$arItem['SLIDER']['HEIGHT']?>' alt='<?=$arItem['NAME']?>'>
							</a>
						</div>
						<div class="product__info">
							<?if(!empty(trim($arItem["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]))):?>
								<div class="product__article"><?=GetMessage('ELEMENT_ARTICLE')?><?=trim($arItem["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])?></div> 
							<?endif?>
							<div class="product__name">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
									<?=!empty($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem["NAME"];?>
								</a>
							</div>
							<div class="product__prices">
								<?if(!empty(trim($arItem["PROPERTIES"]["PRICE_CARD"]["VALUE"]))):?>
									<div class="product__actual-price"><?=trim($arItem["PROPERTIES"]["PRICE_CARD"]["VALUE"])?></div> 
								<?endif?>
								<?if(!empty(trim($arItem["PROPERTIES"]["OLD_PRICE_CARD"]["VALUE"]))):?>
									<div class="product__old-price"><?=trim($arItem["PROPERTIES"]["OLD_PRICE_CARD"]["VALUE"])?></div> 
								<?endif?>
							</div>
						</div>
						<div class="product__btn">
							<a class="btn-default" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=GetMessage('ELEMENT_MORE')?></a>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
</div>