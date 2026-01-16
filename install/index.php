<?php
use Bitrix\Main\Application;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

IncludeModuleLangFile(__FILE__);

class onlinely_protocorp extends CModule
{
    var $MODULE_ID = 'onlinely.protocorp';
    protected $installPath = '';

    public $requiredModules = [];

    function __construct()
    {
        $arModuleVersion = array();
        $this->installPath = __DIR__;
        include(__DIR__ . '/version.php');
        $this->requiredModules = include(__DIR__.'/require.php');
        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
	        $this->MODULE_NAME = Loc::getMessage('PROTO_PROTOCORP_MODULE_NAME');
	        $this->MODULE_DESCRIPTION = Loc::getMessage('PROTO_PROTOCORP_MODULE_DESCRIPTION');
	        $this->PARTNER_NAME     =  Loc::getMessage('PROTO_PROTOCORP_PARTNER_NAME');
	        $this->PARTNER_URI      =  Loc::getMessage('PROTO_PROTOCORP_PARTNER_URI');
        }
    }

	public function InstallDB($install_wizard = true)
	{
		global $DB, $DBType, $APPLICATION;

		RegisterModuleDependences("main", "OnBeforeProlog", "onlinely.protocorp", "CProtoCorp", "ShowPanel");

		return true;
	}

	public function UnInstallDB($arParams = Array())
	{
		global $DB, $DBType, $APPLICATION;

		UnRegisterModuleDependences("main", "OnBeforeProlog", "onlinely.protocorp", "CProtoCorp", "ShowPanel");

		return true;
	}

	public function InstallEvents()
	{
		return true;
	}

	public function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles()
	{
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/onlinely.protocorp/install/wizards/onlinely/protocorp", $_SERVER["DOCUMENT_ROOT"]."/bitrix/wizards/onlinely/protocorp", true, true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/onlinely.protocorp/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
		return true;
	}

	function UnInstallFiles()
	{
		DeleteDirFilesEx("/bitrix/wizards/onlinely/protocorp");
		return true;
	}

    public function DoInstall()
    {
        $this->checkDependencies();
        ModuleManager::registerModule($this->MODULE_ID);
        Loader::includeModule($this->MODULE_ID);

        $this->installFiles();
		$this->InstallDB(false);
		$this->InstallEvents();
    }


    public function DoUninstall()
    {
        global $USER, $DB, $APPLICATION, $step, $module_id;
        $step = (int)$step;
        $module_id = $this->MODULE_ID;

        if (!$USER->IsAdmin()) {
            return;
        }

        Loader::includeModule($this->MODULE_ID);

		$this->UnInstallDB();
		$this->UnInstallFiles();
		$this->UnInstallEvents();

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }


    protected function checkDependencies(){
        $result = [];
        foreach ($this->requiredModules as $module){
            if (!Loader::includeModule($module)){
                $result[] = $module;
            }
        }
        if (!empty($result)){
            $this->showError($this->installPath . '/install/modules_not_installed.php', ['modules'=>$result]);
        }
        return true;
    }

    protected function showError($file, $arVariables, $strTitle=''){
        //define all global vars
        $keys = array_keys($GLOBALS);
        $keys_count = count($keys);
        for($i=0; $i<$keys_count; $i++)
            if($keys[$i]!="i" && $keys[$i]!="GLOBALS" && $keys[$i]!="strTitle" && $keys[$i]!="filepath")
                global ${$keys[$i]};

        //title
        $APPLICATION->SetTitle($strTitle);
        include($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/prolog_admin_after.php");
        include($file);
        include($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");
        die();
    }

    /**
     * @return \Bitrix\Main\DB\Connection
     */

}