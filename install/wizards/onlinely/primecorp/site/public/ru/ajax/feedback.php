<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$titleForm = htmlspecialchars($request->get("titleform"), ENT_QUOTES);
$pageForm = htmlspecialchars($request->get("pageform"), ENT_QUOTES);
$productName = htmlspecialchars($request->get("nameprod"), ENT_QUOTES);


$APPLICATION->IncludeComponent(
    "onlinely:main.feedback",
    "feedback",
    Array(
        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
        "REQUIRED_FIELDS" => array("PHONE"),
        "EMAIL_TO" => "",
        "EVENT_NAME" => "PROTOCORP_FEEDBACK",
        "EVENT_MESSAGE_ID" => array(),
        "USE_CAPTCHA" => "Y",
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_SHADOW" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "TITLE_FORM" => $titleForm,
        "PAGE_FORM" => $pageForm,
        "PRODUCT_NAME" => $productName
    )
);
?>
