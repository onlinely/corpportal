<?if (!defined ('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
	<?if($curPage != SITE_DIR."index.php"):?>
		<?$is404 = defined("ERROR_404") && ERROR_404 === "Y";
		$noSidebar = $is404 || preg_match("~^".SITE_DIR."(catalog|articles|news|services|projects)/~", $curPage) || $APPLICATION->GetPageProperty("PRIMECORP_HIDE_SIDEBAR") == 'Y';?>
		<?if (!$noSidebar):?>
			</div> <!-- content -->
			<div class="sidebar">
				<?include($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/page_blocks/sidebar.php");?>
			</div>
		<?endif;?>
		</div><!-- content -->
		</div><!-- page-content || page-with-aside-->
		</div><!-- container -->
	<?endif?>
</div><!-- main-content -->

<?php
$logoOptionName = "LOGO_FILE_ID_" . SITE_ID;
$logoFileId = (int)\Bitrix\Main\Config\Option::get("onlinely.primecorp", $logoOptionName, 0);
$logoSrc = $logoFileId > 0 ? CFile::GetPath($logoFileId) : "";
?>
<footer class="footer">
	<div class="container container--footer">
		<div class="footer__wrapper">
			<div class="footer__top">
				<div class="footer__left">
					<div class="footer__menu">
						<h4 class="footer__menu-title">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR . "include/footer_menu_title_1.php"
							]); ?>
						</h4>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"menu_footer", 
							array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "",
								"COMPONENT_TEMPLATE" => "menu_footer",
								"COMPOSITE_FRAME_MODE" => "A",
								"COMPOSITE_FRAME_TYPE" => "AUTO",
								"DELAY" => "N",
								"MAX_LEVEL" => "1",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"ROOT_MENU_TYPE" => "bottomone",
								"USE_EXT" => "Y"
							),
							false
						);?>
					</div>
					<div class="footer__menu">
						<h4 class="footer__menu-title">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR . "include/footer_menu_title_2.php"
							]); ?>
						</h4>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"menu_footer", 
							array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "",
								"COMPONENT_TEMPLATE" => "menu_footer",
								"COMPOSITE_FRAME_MODE" => "A",
								"COMPOSITE_FRAME_TYPE" => "AUTO",
								"DELAY" => "N",
								"MAX_LEVEL" => "1",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"ROOT_MENU_TYPE" => "bottomtwo",
								"USE_EXT" => "Y"
							),
							false
						);?>
					</div>
					<div class="footer__menu footer__menu-last">
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"menu_footer", 
							array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "",
								"COMPONENT_TEMPLATE" => "menu_footer",
								"COMPOSITE_FRAME_MODE" => "A",
								"COMPOSITE_FRAME_TYPE" => "AUTO",
								"DELAY" => "N",
								"MAX_LEVEL" => "1",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"ROOT_MENU_TYPE" => "bottomthree",
								"USE_EXT" => "N"
							),
							false
						);?>
					</div>
				</div>
				<div class="footer__right">
					<div class="footer__right-item">
						<div class="footer__call-block">
							<div class="footer__call">
								<div class="footer__tel">
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR . "include/telephone.php"
									]); ?>
								</div>
								<div class="footer__messengers">
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR . "include/messengers.php"
									]);?>
								</div>
							</div>
							<div class="footer__tel">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR . "include/dop-telephone.php"
								]); ?>
							</div>
						</div>
					</div>
					<div class="footer__right-item">
						<div class="footer__address">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR . "include/address.php"
							]); ?>
						</div>
					</div>
					<div class="footer__right-item">
						<div class="footer__email">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR . "include/email.php"
							]);?>
						</div>
					</div>
				</div>
			</div>
			<div class="footer__bottom">
				<div class="footer__bottom-item">
					<div class="footer__publisher">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR . "include/publisher.php"
						]);?>
					</div>
				</div>
				<div class="footer__bottom-item">
					<div class="footer__copyright">
						<?if(!empty($logoSrc)):?>
							<a class="onlinely_copy" href="<?=SITE_DIR?>">
								<img alt="<?=getMessage('COMPANY_MIN')?>" src="<?=$logoSrc?>">
							</a>
						<?else:?>
							<a class="onlinely_copy" href="https://onlinely.ru" target="_blank"><img alt="<?=getMessage('COMPANY_MIN')?>" title="<?=getMessage('COMPANY_FULL')?>" src="<?=SITE_TEMPLATE_PATH?>/img/onlinely-copy-color-88-22.png"></a>
						<?endif?>
						<span id="bx-composite-banner"></span>
					</div>
				</div>
				<div class="footer__bottom-item">
					<div class="footer__policy">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR . "include/footer-policy.php"
						]);?>
					</div>
					<div class="footer__social-icons">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR . "include/footer-icons.php"
						]);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
		</div>     <!-- main-wrapper -->
	</body>
	<div class="modal fancybox__content" style="width: 500px;" id="dialog-content" style="display: none;"></div>
</div>
<?$APPLICATION->IncludeComponent(
			"onlinely:settings.primecorp", 
			".default", 
			array(
				"COMPONENT_TEMPLATE" => ".default",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "360000"
			),
			false
		);?>
</html>
<?ob_start();?>
<?= !$noSidebar ? 'page-content-sidebar' : '' ?>
<?$content = ob_get_clean();
$APPLICATION->AddViewContent("PRIMECORP_HIDE_SIDEBAR", $content);?>
