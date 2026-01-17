<?if (!defined ('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset;
IncludeTemplateLangFile(__FILE__);
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$curPage = $APPLICATION->GetCurPage(true);
$GLOBALS['full_url'] = $protocol . $host . $curPage;
if(\Bitrix\Main\Loader::includeModule("onlinely.primecorp")){
	$ProtoSettings = \Onlinely\Primecorp\ProtoSettingsCorp::getInstance();
	$arTemplateSettings = $ProtoSettings->getCurrentSettings();
	$FILE_NAME_COLOR = 'FILE_NAME_COLOR_' . SITE_ID;
};
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/svg+xml" sizes="any" href="<?=SITE_DIR?>favicon.svg">
	<title><?$APPLICATION->ShowTitle();?></title>
	<?$APPLICATION->ShowHead();?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/plugins/swiper-bundle.min.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/plugins/jquery.fancybox.min.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.css');?>
	<?if($arTemplateSettings[$FILE_NAME_COLOR] != ''){Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/themes/' . $arTemplateSettings[$FILE_NAME_COLOR]);}?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/custom.css');?>

	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/plugins/dynamicAdapt.js');?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/plugins/swiper-bundle.min.js');?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/plugins/jquery-3.6.0.min.js');?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/plugins/flexmenu.min.js');?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/plugins/jquery.fancybox.min.js');?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/plugins/maskedinput.min.js');?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/script.js');?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/custom.js');?>
	<script>
		BX.message({
			SITE_DIR: '<?=SITE_DIR ?>'
		});
	</script>
</head>
<body>
	<div class="admin-panel"><?$APPLICATION->ShowPanel();?></div>
	<div class="main-wrapper">
		<header class="header header__inner ">
			<?php
			$logoOptionName = "LOGO_FILE_ID_" . SITE_ID;
			$logoFileId = (int)\Bitrix\Main\Config\Option::get("onlinely.primecorp", $logoOptionName, 0);
			$logoSrc = $logoFileId > 0 ? CFile::GetPath($logoFileId) : "";
			?>
			<div class="container header__container">
				<div class="header__wrap-main">
					<div class="header__logo">
						<div class="header__logo-dark">
							<a href="<?=SITE_DIR?>">
								<?if(!empty($logoSrc)):?>
									<img src="<?=$logoSrc?>" alt="<?=getMessage('COMPANY_MIN')?>">
								<?else:?>
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR . "include/logo-dark.php"
									]); ?>
								<?endif?>
							</a>
						</div>
						<div class="header__logo-light">
							<a href="<?=SITE_DIR?>">
								<?if(!empty($logoSrc)):?>
									<img src="<?=$logoSrc?>" alt="<?=getMessage('COMPANY_MIN')?>">
								<?else:?>
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR . "include/logo-light.php"
									]); ?>
								<?endif?>
							</a>
						</div>
					</div>
					<div class="header__search-head"></div>
					<div class="header__wrap">
						<div class="header__top">
							<div class="header__top-left">
								<div class="header__include-wrap">
									<div class="header__include" data-da=".header__mobile-include,991,first">
										<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR . "include/address.php"
										]); ?>
									</div>
								</div>
								<div class="header__search" id="header__search" data-da=".header__mobile-search,991,first">
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR . "include/search-title.php"
									]); ?>
								</div>
							</div>
							<div class="header__top-right">
								<div class="header__call" data-da=".header__mobile-include,991,last">
									<div class="header__calling">
										<div class="header__tel">
											<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
												"AREA_FILE_SHOW" => "file",
												"PATH" => SITE_DIR . "include/telephone.php"
											]); ?>
										</div>
										<div class="header__calling-btn">
											<div class="btn-link openFeedback" data-nameprod="" data-titleform="<?=GetMessage('HEADER_CALLBACK_TITLE')?>" data-pageform="<?=$full_url?>">
												<?=GetMessage('HEADER_CALLBACK_TITLE')?>
											</div>
										</div>
									</div>
									<div class="header__messengers">
										<?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR . "include/messengers.php"
										]);?>
									</div>
								</div>
								<div class="header__feedback" data-da=".header__mobile-call,991,last">
									<div class="btn-default openFeedback" data-nameprod="" data-titleform="<?=GetMessage('HEADER_CALLREQUEST_TITLE')?>" data-pageform="<?=$full_url?>">
										<?=GetMessage('HEADER_CALLREQUEST_TITLE')?>
									</div>
								</div>
							</div>
						</div>
						<div class="header__bottom">
							<?$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"main-menu", 
								array(
									"ALLOW_MULTI_SELECT" => "N",
									"CHILD_MENU_TYPE" => "",
									"COMPOSITE_FRAME_MODE" => "A",
									"COMPOSITE_FRAME_TYPE" => "AUTO",
									"DELAY" => "N",
									"MAX_LEVEL" => "2",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"ROOT_MENU_TYPE" => "top",
									"USE_EXT" => "Y",
									"COMPONENT_TEMPLATE" => "main-menu"
								),
								false
							);?>
						</div>
					</div>
					<div class="header__mobile-btns">
						<div class="header__search-mobile-btn">
							<svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.49221 14.8462C4.6687 14.8462 1.56913 11.7466 1.56913 7.92308C1.56913 4.09957 4.6687 1 8.49221 1C12.3157 1 15.4153 4.09957 15.4153 7.92308C15.4153 11.7466 12.3157 14.8462 8.49221 14.8462Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M24 21L15.4154 13.2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
						<div class="header__burger">
							<span></span>
							<span></span>
						</div>
					</div>
				</div>
				<div class="header__mobile">
					<div class="header__mobile-search"></div>
					<div class="header__mobile-menu">
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"main-menu-mobile", 
							array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "",
								"COMPOSITE_FRAME_MODE" => "A",
								"COMPOSITE_FRAME_TYPE" => "AUTO",
								"DELAY" => "N",
								"MAX_LEVEL" => "2",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"ROOT_MENU_TYPE" => "top",
								"USE_EXT" => "Y",
								"COMPONENT_TEMPLATE" => "main-menu-mobile"
							),
							false
						);?>
					</div>
					<div class="header__mobile-info">
						<div class="header__mobile-include"></div>
						<div class="header__mobile-call"></div>
					</div>
				</div>
			</div>
		</header>
		<div class="main-content">
			<?if($curPage != SITE_DIR."index.php"):?>
				<?$is404 = defined("ERROR_404") && ERROR_404 === "Y";?>
				<?$noTitle = preg_match("~^".SITE_DIR."(catalog|articles|news|services|projects)/~", $curPage) || $is404;?>
				<?$notypography = preg_match("~^".SITE_DIR."(catalog|articles|news|services|projects)/~", $curPage) || $is404;?>
				
				<div class="container">
					<?if(!$is404):?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"breadcrumb",
						array(
							"START_FROM" => "0",
							"PATH" => "",
							"SITE_ID" => SITE_ID
						),
						false,
						Array('HIDE_ICONS' => 'Y')
					);?>
					<?endif?>
				<div class="page-content <?=$APPLICATION->ShowViewContent("PROTOCORP_HIDE_SIDEBAR");?> <?=($notypography ? "" : "typography")?>">
					<div class="content">
					<?if(!$noTitle):?>
						<h1 class="page-title"><?$APPLICATION->ShowTitle(false);?></h1>
					<?endif?>
			<?else:?>			
					<?include($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/page_blocks/main-page.php");?>
			<?endif?>
