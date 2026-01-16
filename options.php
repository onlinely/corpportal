<?

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Bitrix\Main\IO;

Loc::loadMessages( __FILE__ );

$request   = HttpApplication::getInstance()->getContext()->getRequest();
$module_id = htmlspecialchars( $request['mid'] != '' ? $request['mid'] : $request['id'] );

if (!Loader::includeModule($module_id)) {
    throw new \Bitrix\Main\LoaderException(Loc::getMessage("MODULE_NOT_INSTALLED"));
}


$rsSites = CSite::GetList( $by = "sort", $order = "ASC", array( "ACTIVE" => "Y" ) );
while ( $arSite = $rsSites->Fetch() ) {
	$aTabs[] = array(
		'DIV'     => "site_{$arSite["ID"]}",
		'TAB'     => $arSite["NAME"],
		'TITLE'   => Loc::getMessage( 'SITE_TITLE' ) . $arSite["NAME"],
		'OPTIONS' => array(
			array(
				"print_window_settings_{$arSite["ID"]}",
				Loc::getMessage( 'OPTIONS_PRINT_WINDOW_SETTINGS' ),
				'Y',
				array( 'checkbox' )
			),
		),
	);
}


$tabControl = new CAdminTabControl(
	'tabControl',
	$aTabs
);

$tabControl->begin();
?>
    <form action="<?= $APPLICATION->getCurPage(); ?>?mid=<?= $module_id; ?>&lang=<?= LANGUAGE_ID; ?>" method="post">
		<?= bitrix_sessid_post(); ?>
		<?
		foreach ( $aTabs as $aTab ) {
			if ( $aTab['OPTIONS'] ) {
				$tabControl->beginNextTab();
				__AdmSettingsDrawList( $module_id, $aTab['OPTIONS'] );
			}
		}
		$tabControl->buttons();
		?>
        <input type="submit" name="apply"
               value="<?= Loc::GetMessage( 'OPTIONS_INPUT_APPLY' ); ?>" class="adm-btn-save"/>
        <input type="submit" name="default"
               value="<?= Loc::GetMessage( 'OPTIONS_INPUT_DEFAULT' ); ?>"/>
    </form>

<?
$tabControl->end();

if ( $request->isPost() && check_bitrix_sessid() ) {
	$tabControl_active_tab = "";
	foreach ( $aTabs as $aTab ) {
		foreach ( $aTab['OPTIONS'] as $arOption ) {
			if ( ! is_array( $arOption ) ) {
				continue;
			}
			if ( $arOption['note'] ) {
				continue;
			}
			if ( $request['apply'] ) {
				$optionValue = $request->getPost( $arOption[0] );
				if ( array_search( "checkbox", $arOption[3] ) !== false ) {
					if ( $optionValue == '' ) {
						$optionValue = 'N';
					}
				}

				Option::set( $module_id, $arOption[0], is_array( $optionValue ) ? implode( ',', $optionValue ) : $optionValue);
			} elseif ( $request['default'] ) {
				Option::set( $module_id, $arOption[0], $arOption[2] );
			}
		}
	}

	LocalRedirect( $APPLICATION->getCurPage() . '?mid=' . $module_id . '&lang=' . LANGUAGE_ID . $tabControl_active_tab );

}
?>