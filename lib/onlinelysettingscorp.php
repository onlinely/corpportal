<?
namespace Onlinely\Primecorp;
use Bitrix\Main\Config\Option;

class OnlinelySettingsCorp {
	private $moduleName = "onlinely.primecorp";
	private static $instance = false;

	public static function getInstance(){

		if (!self::$instance){
			self::$instance = new OnlinelySettingsCorp();
		}
		return self::$instance;
	}

	public static function getCurrentSettings(){
		return Option::getForModule(static::$instance->moduleName);
	}

	public static function getDefaultSettings(){
		return Option::getDefaults(static::$instance->moduleName);
	}

	public static function setOption($nameOption="", $valueOption="", $SITE_ID = SITE_ID){
		return Option::set(static::$instance->moduleName, $nameOption, $valueOption );
	}

	public static function setColorThemes(){
		return array(
			'DEFAULT' => 'color_0D99F0_1D80BD',
			'COLOR1' => 'color_18D167_45E48A',
			'COLOR2' => 'color_023047_219EBC',
			'COLOR3' => 'color_FB8500_FFB703',
			'COLOR4' => 'color_BC6C25_DDA15E',
			'COLOR5' => 'color_606C38_283618',
			'COLOR6' => 'color_E76F51_F4A261',
			'COLOR7' => 'color_2A9D8F_264653',
			'COLOR8' => 'color_D62828_F77F00',
			'COLOR9' => 'color_3A5A40_588157',
			'COLOR10' => 'color_D90429_EF233C',
			'COLOR11' => 'color_774936_9D6B53',
			'CUSTOM' => 'custom_FFFFFF_DDDDDD'
		);
	}
	public static function scanDir ($path){

    	$arReturn = array();

    	if(!empty($path) && is_dir($path)){
			$arReturn = array_diff( scandir( $path), array('..', '.'));
		}

		return $arReturn;
    }

	public function searchCustomColor ($path){
		$arReturn = '';
		$arThemes = self::scanDir($path);
		if(!empty($arThemes)){

			foreach($arThemes as $name){
				if($name != 'custom_FFFFFF_DDDDDD.css'){
					$pattern = '/[_.]/';
					$arValues = preg_split( $pattern, $name );
					if($arValues[0] == 'custom'){
						$arReturn = array(
							"FILE" => $name,
							"MAIN_COLOR" =>  '#' . $arValues[1],
							"HOVER_COLOR" => '#' . $arValues[2]
						);
					}
				}
			}
		}
		return $arReturn;
	}

	public function saveSettings($requestData){

		if(!empty($requestData)){
			$FILE_NAME_COLOR = "FILE_NAME_COLOR_" . $requestData['siteId'];
			$COLOR_SITE = "COLOR_SITE_" . $requestData['siteId'];
			$arSettingsName = array(
				$FILE_NAME_COLOR,
				$COLOR_SITE,
			);

			foreach($arSettingsName as $nextSettingsName){
				if(!empty($requestData[$nextSettingsName])){
					self::setOption($nextSettingsName, $requestData[$nextSettingsName]);
				}
			}
		}
		
		return true;
	}

}
