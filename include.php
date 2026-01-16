<?php
$requiredModules = include(__DIR__.'/install/require.php');
foreach ($requiredModules as $module){
    \Bitrix\Main\Loader::includeModule($module);
}
CModule::AddAutoloadClasses('onlinely.primecorp', array(
));

IncludeModuleLangFile(__FILE__);
use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;

class Cprimecorp
{
	public static function ShowPanel()
	{
		if ($GLOBALS["USER"]->IsAdmin() && COption::GetOptionString("main", "wizard_solution", "", SITE_ID) == "primecorp")
		{
			$GLOBALS["APPLICATION"]->SetAdditionalCSS("/bitrix/wizards/onlinely/primecorp/css/panel.css"); 

			$arMenu = Array(
				Array(		
					"ACTION" => "jsUtils.Redirect([], '".CUtil::JSEscape("/bitrix/admin/wizard_install.php?lang=".LANGUAGE_ID."&wizardSiteID=".SITE_ID."&wizardName=onlinely:primecorp&".bitrix_sessid_get())."')",
					"ICON" => "bx-popup-item-wizard-icon",
					"TITLE" => GetMessage("STOM_BUTTON_TITLE_W1"),
					"TEXT" => GetMessage("STOM_BUTTON_NAME_W1"),
				)
			);

			$GLOBALS["APPLICATION"]->AddPanelButton(array(
				"HREF" => "/bitrix/admin/wizard_install.php?lang=".LANGUAGE_ID."&wizardName=onlinely:primecorp&wizardSiteID=".SITE_ID."&".bitrix_sessid_get(),
				"ID" => "primecorp_wizard",
				"ICON" => "bx-panel-site-wizard-icon",
				"MAIN_SORT" => 2500,
				"TYPE" => "BIG",
				"SORT" => 10,	
				"ALT" => GetMessage("SCOM_BUTTON_DESCRIPTION"),
				"TEXT" => GetMessage("SCOM_BUTTON_NAME"),
				"MENU" => $arMenu,
			));


			$request = Application::getInstance()->getContext()->getRequest();
			$uriString = $request->getRequestUri();
			$uri = new Uri($uriString);

		}
	}
}
?>