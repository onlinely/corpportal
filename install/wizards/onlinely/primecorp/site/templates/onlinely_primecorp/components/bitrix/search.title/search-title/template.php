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

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if($INPUT_ID == '')
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if($CONTAINER_ID == '')
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';

if($arParams["SHOW_INPUT"] !== "N"):?>
<div id="<?echo $CONTAINER_ID?>" class="search">
	<form action="<?echo $arResult["FORM_ACTION"]?>" name="search">
		<div class="search__wrapper">
			<input id="<?echo $INPUT_ID?>" placeholder="<?=GetMessage("PRIMECORP_SEARCH_PLACEHOLDER");?>" type="text" name="q" value="<?=htmlspecialcharsbx($_REQUEST["q"])?>" autocomplete="off" class="search__input"/>
			<button class="search__btn btn" type="submit" name="s">
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M6.76061 12.0769C3.7018 12.0769 1.22215 9.59727 1.22215 6.53846C1.22215 3.47965 3.7018 1 6.76061 1C9.81942 1 12.2991 3.47965 12.2991 6.53846C12.2991 9.59727 9.81942 12.0769 6.76061 12.0769Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M17.2222 17L10.3545 10.76" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</button>
		</div>
		<div class="search__close">
			<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="11" cy="11" r="10.5" fill="white" stroke="#D9D9D9" />
				<path d="M15 7L7 15" stroke="#0D99F0" stroke-linecap="round" stroke-linejoin="round" />
				<path d="M7 7L15 15" stroke="#0D99F0" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
		</div>
	</form>
</div>

<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>

