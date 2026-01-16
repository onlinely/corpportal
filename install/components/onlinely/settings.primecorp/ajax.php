<?define("STOP_STATISTICS", true);?>
<?define("NO_AGENT_CHECK", true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if( !\Bitrix\Main\Loader::includeModule("onlinely.primecorp")){
	die();
}

global $USER;

if(!$USER->IsAdmin() ){
	LocalRedirect("/404.php", "404 Not Found");
}
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$requestValues = $request->getPostList()->toArray();
$ProtoSettings = Onlinely\Protocorp\ProtoSettingsCorp::getInstance();
if(!empty($requestValues["action"])){

	if($requestValues["action"] == "saveSettings"){
		$arColorsOld = $requestValues["currentColor"];
		$arColors = $requestValues["replaceColor"];

		$fileNamePattern = '/^(color|custom)_[0-9A-Fa-f]{6}_[0-9A-Fa-f]{6}\.css$/';
		$hexPattern      = '/^#[0-9A-Fa-f]{6}$/';

		if (isset($arColorsOld['File']) && !preg_match($fileNamePattern, $arColorsOld['File'])) {
			die('Invalid file name(currentColor).');
		}
		if (isset($arColors['File']) && !preg_match($fileNamePattern, $arColors['File'])) {
			die('Invalid file name (replaceColor).');
		}
 		if (isset($arColors['Main']) && !preg_match($hexPattern, $arColors['Main'])) {
            die('Invalid primary color format (Main).');
        }
        if (isset($arColors['Hover']) && !preg_match($hexPattern, $arColors['Hover'])) {
            die('Invalid hover color format (Hover).');
        }
		
		$returnArray = array();
		if(!empty($arColors)){
			$templatePath = $requestValues["path"];
			$currentFileName = $arColorsOld['File'];
			$NewCurrentFileName = $arColors['File'];
			$fullFilePath = $_SERVER["DOCUMENT_ROOT"] . $templatePath . '/css/themes/' . $currentFileName;
			$fullFilePathDefault = $_SERVER["DOCUMENT_ROOT"] . $templatePath . '/css/themes/custom_FFFFFF_DDDDDD.css';
			$NewFullFilePath = $_SERVER["DOCUMENT_ROOT"] . $templatePath . '/css/themes/' . $NewCurrentFileName;

			$openFile = file_get_contents($fullFilePathDefault);
			$fileMainColor = str_replace('#FFFFFF', $arColors['Main'], $openFile);
			$fileNewContent = str_replace('#DDDDDD', $arColors['Hover'], $fileMainColor);
			if(file_put_contents($NewFullFilePath, $fileNewContent)){
				$optColorName = 'COLOR_SITE_' . $requestValues["siteId"];
				$optFileName = 'FILE_NAME_COLOR_' . $requestValues["siteId"];
				$requestValues[$optColorName] = "CUSTOM";
				$requestValues[$optFileName] = $arColors['File'];
				$returnArray["SUCCESS_MAKE_COLOR_FILE"] = "Y";
			}else{
				$returnArray["ERROR_MAKE_COLOR_FILE"] = "UPDATE_THEME_ERROR";
			}
			$arFiles = array();
			$arFiles = $ProtoSettings->scanDir($_SERVER["DOCUMENT_ROOT"] . $templatePath . '/css/themes/');
			$returnArray["SUCCESS_MAKE_COLOR_FILE"] = "Y";
			foreach($arFiles as $file){
				if($file != 'custom_FFFFFF_DDDDDD.css' && $file != $NewCurrentFileName){
					$pattern = '/[_.]/';
					$arValues = preg_split( $pattern, $file );
					if($arValues[0] == 'custom'){
						unlink($_SERVER["DOCUMENT_ROOT"] . $templatePath . '/css/themes/' .$file);
					}
				}
			}
		}else {

		}


		if($saveResult = $ProtoSettings->saveSettings($requestValues)){
			$returnArray["SUCCESS"] = "Y";
		}
		else{
			$returnArray["ERROR"] = "Y";
			$returnArray["SAVE_SETTINGS"] = "Y";
		}
		echo \Bitrix\Main\Web\Json::encode($returnArray);
	}
}
