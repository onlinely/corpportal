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
	<div class="page-block block-projects">
		<div class="container">
			<div class="page-block__head">
				<div class="page-block__title">
					<h2><?=GetMessage('MAIN_PROJECTS_TITLE')?></h2>
				</div>
				<div class="page-block__link">
					<a href="<?=SITE_DIR?>projects/"><?=GetMessage('MAIN_PROJECTS_LINK')?></a>
				</div>
			</div>
			<div class="grid-list grid-list-three">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="grid-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="card card-project">
							<div class="card__img">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
									<img src="<?=$arItem['SLIDER']['SRC']?>" loading="lazy" width="<?=$arItem['SLIDER']['WIDTH']?>" height="<?=$arItem['SLIDER']['HEIGHT']?>" alt="">
								</a>
							</div>
							<div class="card__title">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
									<?=!empty($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem["NAME"];?>
								</a>
							</div>
							<?if(!empty($arItem['DISPLAY_PROPERTIES'])):?>
								<div class="card__props">
									<?foreach($arItem['DISPLAY_PROPERTIES'] as $prop):?>
										<?if(trim($prop['VALUE']) != ''):?>
										<div class="card__props-item">
											<div class="card__props-name"><span><?=$prop['NAME']?></span></div>
											<div class="card__props-value"><span><?=$prop['VALUE']?></span></div>
										</div>
										<?endif?>
									<?endforeach?>
								</div>
							<?endif?>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
<?endif?>
