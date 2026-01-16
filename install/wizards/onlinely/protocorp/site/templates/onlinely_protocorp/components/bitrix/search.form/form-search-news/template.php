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
$this->setFrameMode(true);?>
<div class="widget widget__search">
	<form class="form__search" action="<?=$arResult["FORM_ACTION"]?>">
		<div class="widget__search-group">
			<input type="search" class="form-control" name="q" id="ws" placeholder="<?=GetMessage("BSF_T_SEARCH_PLACEHOLDER")?>" required>
			<button type="submit" class="btn"><?=GetMessage("BSF_T_SEARCH_BUTTON")?></button>
		</div>
	</form>
</div>