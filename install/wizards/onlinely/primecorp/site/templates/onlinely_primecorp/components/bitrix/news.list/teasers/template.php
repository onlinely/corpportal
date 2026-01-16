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
<div class="teasers">
    <div class="container">
        <div class="teasers__items">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="teasers__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="teasers__card">
						<div class="teasers__background">
							<div class="teasers__icon">
								<?if($arItem["PROPERTIES"]["TEASER_ICON"]["VALUE"]):?>
									<?=htmlspecialcharsBack($arItem["PROPERTIES"]["TEASER_ICON"]["VALUE"]["TEXT"])?>
								<?else:?>
									<svg width="22" height="22" viewBox="0 0 22 22" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M7.94012 11C7.94012 10.5858 8.27591 10.25 8.69012 10.25H20.9978C21.412 10.25 21.7478 10.5858 21.7478 11C21.7478 11.4142 21.412 11.75 20.9978 11.75H8.69012C8.27591 11.75 7.94012 11.4142 7.94012 11Z" />
										<path fill-rule="evenodd" clip-rule="evenodd" d="M12.2974 7.39274C12.5903 7.68564 12.5903 8.16051 12.2974 8.4534L9.75078 11L12.2974 13.5466C12.5903 13.8395 12.5903 14.3144 12.2974 14.6072C12.0045 14.9001 11.5296 14.9001 11.2367 14.6072L8.15979 11.5303C7.8669 11.2374 7.8669 10.7626 8.15979 10.4697L11.2367 7.39274C11.5296 7.09985 12.0045 7.09985 12.2974 7.39274Z" />
										<path fill-rule="evenodd" clip-rule="evenodd" d="M14.2515 2.33951C12.3784 1.63673 10.3279 1.56017 8.4076 2.12133C6.48729 2.68248 4.80068 3.85109 3.60072 5.45189C2.40076 7.05269 1.75214 8.99938 1.75214 11C1.75214 13.0006 2.40076 14.9473 3.60072 16.5481C4.80068 18.1489 6.48729 19.3175 8.4076 19.8787C10.3279 20.4398 12.3784 20.3633 14.2515 19.6605C16.1246 18.9577 17.7194 17.6666 18.7966 15.9808C19.0197 15.6317 19.4834 15.5296 19.8325 15.7526C20.1815 15.9757 20.2837 16.4394 20.0606 16.7885C18.8087 18.7477 16.9553 20.2482 14.7784 21.0649C12.6016 21.8816 10.2186 21.9706 7.98686 21.3185C5.75516 20.6663 3.79504 19.3082 2.40049 17.4478C1.00594 15.5874 0.252136 13.325 0.252136 11C0.252136 8.67496 1.00594 6.41259 2.40049 4.5522C3.79504 2.69181 5.75516 1.33369 7.98686 0.681541C10.2186 0.0293891 12.6016 0.118358 14.7784 0.935103C16.9553 1.75185 18.8087 3.25234 20.0606 5.21154C20.2837 5.56058 20.1815 6.02433 19.8325 6.24737C19.4834 6.47041 19.0197 6.36827 18.7966 6.01923C17.7194 4.33341 16.1246 3.04229 14.2515 2.33951Z" />
									</svg>
								<?endif?>
							</div>
						</div>
						<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
							<h3 class="teasers__text">
								<?=$arItem["NAME"]?>
							</h3>
						<?endif;?>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
</div>