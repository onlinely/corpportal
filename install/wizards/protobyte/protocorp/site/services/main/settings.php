<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

COption::SetOptionString(
    "fileman",
    "propstypes",
    serialize(array(
        "description" => GetMessage("MAIN_OPT_DESCRIPTION"),
        "keywords" => GetMessage("MAIN_OPT_KEYWORDS"),
        "PROTOCORP_HIDE_SIDEBAR" => GetMessage("MAIN_OPT_PROTOCORP_HIDE_SIDEBAR")
    )),
    false,
    WIZARD_SITE_ID
);

COption::SetOptionInt("search", "suggest_save_days", 250);
COption::SetOptionString("search", "use_tf_cache", "Y");
COption::SetOptionString("search", "use_word_distance", "Y");
COption::SetOptionString("search", "use_social_rating", "Y");
COption::SetOptionString("iblock", "use_htmledit", "Y");
?>