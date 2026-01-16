<?
$optionColor = 'COLOR_SITE_' . SITE_ID;
$optionFile = 'FILE_NAME_COLOR_' . SITE_ID;
$printSettings = 'print_window_settings_' . SITE_ID;

if(empty($arResult['CURRENT_SETTINGS'][$optionColor])){
	$arResult['CURRENT_SETTINGS'][$optionColor] = $arResult['DEFAULT_SETTINGS'][$optionColor];
}

if(empty($arResult['CURRENT_SETTINGS'][$optionFile])){
	$arResult['CURRENT_SETTINGS'][$optionFile] = $arResult['DEFAULT_SETTINGS'][$optionFile];
}
if(empty($arResult['CURRENT_SETTINGS'][$printSettings])){
	$arResult['CURRENT_SETTINGS'][$printSettings] = $arResult['DEFAULT_SETTINGS'][$printSettings];
}

if(!empty($arResult['CURRENT_SETTINGS'][$optionFile])){
    $fileName = $arResult['CURRENT_SETTINGS'][$optionFile];
    $fileInfo = pathinfo($fileName);

    if (!empty($fileInfo['extension'])) {
        $optionName = mb_substr($fileName, 0, -4); 
    } else {
        $optionName = $fileName;
    }
	$arCurrentColor = explode( '_', $optionName);

	$arResult['CURRENT_SETTINGS'][$optionFile] = array(
			"FILE_NAME" => $arResult['CURRENT_SETTINGS'][$optionFile],
			"TYPE" => $arCurrentColor[0],
			"MAIN" => '#' . strtoupper($arCurrentColor[1]),
			"HOVER" => '#' . strtoupper($arCurrentColor[2])
		); 
}


if(!empty($arResult['COLOR_ARRAY'])){
	foreach($arResult['COLOR_ARRAY'] as $name => $color){

		
		$arColor = explode( '_', $color );
		$arResult['COLOR_ARRAY'][$name] = array(
			"FILE_NAME" => $color . '.css',
			"TYPE" => $arColor[0],
			"MAIN" => '#' . strtoupper($arColor[1]),
			"HOVER" => '#' . strtoupper($arColor[2])
		); 
	}
}
