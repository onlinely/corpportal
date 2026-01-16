<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="mfeedback">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if($arResult["OK_MESSAGE"] <> '')
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
<label for="cname" class="sr-only"><?=GetMessage("MFT_NAME")?></label>
	<input type="text" class="form-control" id="cname" placeholder="Имя <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">

	<label for="cemail" class="sr-only"><?=GetMessage("MFT_EMAIL")?></label>
	<input type="email" class="form-control" id="cemail" placeholder="Email <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">

	<label for="cphone" class="sr-only"><?=GetMessage("MFT_PHONE")?></label>
	<input type="tel" class="form-control" id="cphone" placeholder="Телефон <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" name="user_phone" value="<?=$arResult["AUTHOR_PHONE"]?>" required="">

	<label for="cmessage" class="sr-only"><?=GetMessage("MFT_MESSAGE")?></label>
	<textarea name="MESSAGE" class="form-control" cols="30" rows="4" id="cmessage" required="" placeholder="Сообщение <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>"><?=$arResult["MESSAGE"]?></textarea>

	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">

	<div class="text-center">
		<button type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" class="btn btn-outline-primary-2 btn-minwidth-sm">
			<span><?=GetMessage("MFT_SUBMIT")?></span>
			<i class="icon-long-arrow-right"></i>
		</button>
	</div>
</form>
</div>