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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));?>
<?if (0 < $arResult["SECTIONS_COUNT"]):?>
	<div class="page-block block-section-list">
		<div class="container">
			<div class="page-block__head">
				<div class="page-block__title">
					<h2><?=GetMessage('CATALOG_CATEGORY_TITLE')?></h2>
				</div>
				<div class="page-block__link">
					<a href="<?=SITE_DIR?>catalog/"><?=GetMessage('CATALOG_CATEGORY_ALL')?></a>
				</div>
			</div>
			<div class="section-list">
				<?foreach ($arResult['SECTIONS'] as &$arSection): 
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);?>
					<div class="section-list__item">
						<div class="section-list__card" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
							<a href="<?=$arSection['SECTION_PAGE_URL']?>">
								<div class="section-list__img">
									<?if($arSection['PICTURE']['ID']):?>
										<img src="<?=$arSection['PICTURE']['SRC']?>"
										alt="<?=$arSection['NAME']?>"
										width="<?=$arSection['PICTURE']['WIDTH']?>"
										height="<?=$arSection['PICTURE']['HEIGHT']?>"
										loading='lazy'>
									<?else:?>
										<img
											src="<?=SITE_DIR . 'include//img/no-photo510.jpg'?>"
											width="1020"
											height="370"
											alt="no-photo"
											title="no-photo"
											loading='lazy'
											/>
									<?endif?>
								</div>
								<div class="section-list__name">
									<div class="section-list__title"><?=$arSection['NAME']?></div>
									<div class="section-list__icon">
										<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1.5 8.5L4.42787 5.18846C4.45064 5.16429 4.46879 5.1351 4.48119 5.10268C4.4936 5.07027 4.5 5.03532 4.5 5C4.5 4.96468 4.4936 4.92973 4.48119 4.89732C4.46879 4.8649 4.45064 4.83571 4.42787 4.81154L1.5 1.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
										</svg>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?endforeach?>
			</div>
		</div>
	</div>
<?endif?>
