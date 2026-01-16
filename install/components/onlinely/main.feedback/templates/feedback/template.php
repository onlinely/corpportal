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
<div class="modal__wrap">
	<div class="modal__head">
		<div class="modal__head-title">
			<?=$arParams["TITLE_FORM"]?>
		</div>
	</div>
	<div class="modal__body">
		<div class="mfeedback feedback">
			<?if(!empty($arResult["ERROR_MESSAGE"]))
			{
				foreach($arResult["ERROR_MESSAGE"] as $v)
					ShowError($v);
			}
			if($arResult["OK_MESSAGE"] <> ''):?>
				<div class="feedback__success" style="display: none;">
					<div class="feedback__success-title"><?=GetMessage('MFT_SUCCESS_TITLE')?></div>
					<div class="feedback__success-text"><?=GetMessage('MFT_SUCCESS_TEXT')?></div>
					<div class="feedback__success-btn">
						<a class="btn-default" data-fancybox-close><?=GetMessage('MFT_SUCCESS_CLOSE')?></a>
					</div>
				</div>
				<script>
					$(document).ready(function () {
						console.log("Document is ready");
						setTimeout(function() {
							$('.modal__head').hide();
							$('.feedback__form').hide();
							$('.feedback__success').show();
						}, 100);
						console.log("SetTimeout executed");
					});
				</script>
			<?endif?>
			<?$sanitizedUri = preg_replace('#/+#', '/', POST_FORM_ACTION_URI);?>
			<form action="<?=$sanitizedUri?>" method="POST" class="feedback__form form-submit">
				<?=bitrix_sessid_post()?>
				<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
				<input type="hidden" name="PAGE_LINK" id="input_page_link_tovar" value="">

				<div class="feedback__group " id="input1-group">
					<div class="feedback__error"><?=GetMessage('MFT_REQUIRED')?></div>
					<div class="feedback__inner">
						<input name="user_name" id="cname" class="form-control <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>required<?endif?>" type="text" placeholder=" " <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>required="required"<?endif?> >
						<label for="cname"><?=GetMessage('MFT_NAME')?> <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span>*</span><?endif?></label>
					</div>
				</div>

				<div class="feedback__group " id="input2-group">
					<div class="feedback__error"><?=GetMessage('MFT_REQUIRED')?></div>
					<div class="feedback__inner">
						<input name="user_phone" id="cphone" class="tel form-control <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?>required<?endif?>" data-tel-input="" type="tel" placeholder="+7 ___ ___ ____" <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?>required="required"<?endif?>>
						<label for="cphone"><?=GetMessage('MFT_PHONE')?> <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?><span>*</span><?endif?></label>
					</div>
				</div>

				<div class="feedback__group " id="input3-group">
					<div class="feedback__error"><?=GetMessage('MFT_EMAIL_ERROR')?></div>
					<div class="feedback__inner">
						<input name="user_email" id="cemail" class="mailfield form-control <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>required<?endif?>" type="email" placeholder=" " <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>required="required"<?endif?>>
						<label for="cemail"><?=GetMessage('MFT_EMAIL')?> <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span>*</span><?endif?></label>
					</div>
				</div>
				<?if(!empty($arParams["NAME_TOVAR"])):?>
					<div class="feedback__group " id="input3-group">
						<div class="feedback__inner">
							<input name="NAME_TOVAR" id="input_name_tovar" class="form-control" type="email" placeholder=" " value="<?=$arParams["NAME_TOVAR"]?>">
							<label for="input_name_tovar"><?=$arParams["NAME_TOVAR"]?></label>
						</div>
					</div>
				<?endif?>
				<div class="feedback__group " id="input5-group">
					<div class="feedback__error"><?=GetMessage('MFT_REQUIRED')?></div>
					<div class="feedback__inner text-form">
						<textarea id="cmessage" name="MESSAGE" class="<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?>required<?endif?>" maxlength="600" placeholder=" " <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>required="required"<?endif?>></textarea>
						<label for="cmessage"><?=GetMessage('MFT_MESSAGE')?> <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span>*</span><?endif?></label>
					</div>
				</div>
				<?if($arParams["USE_CAPTCHA"] == "Y"):?>
					<div class="feedback__group feedback__captcha mf-captcha">
						<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>" >
						<img class="feedback__captcha-img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
						<div class="feedback__inner">
							<input type="text" id="ccaptcha" name="captcha_word" class="form-control required" placeholder=" " value="" required="required">
							<label for="ccaptcha"><?=GetMessage('MFT_CAPTCHA_CODE')?></label>
						</div>
					</div>
				<?endif;?>
				<div class="form-group">
					<div class="feedback__consent form-group__form-check">
						<input 
							id="consent" 
							name="consent" 
							type="checkbox" 
							required 
							aria-required="true" 
							class="checkbox" 
							checked 
							onchange="this.form.querySelector('#form__submit').disabled = !this.checked"
						>
						<label for="consent"><?=GetMessage("MFT_CONSET_MESS_1")?> <a href="<?=SITE_DIR?>policy/"><?=GetMessage("MFT_CONSET_MESS_2")?></a></label>
					</div>
				</div>
				<div class="feedback__btn">
					<button type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" id="form__submit" class="btn-default">
						<?=GetMessage("MFT_SUBMIT")?>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

