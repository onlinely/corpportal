<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (!defined("WIZARD_DEFAULT_SITE_ID") && !empty($_REQUEST["wizardSiteID"]))
    define("WIZARD_DEFAULT_SITE_ID", $_REQUEST["wizardSiteID"]);

$arWizardDescription = array(
    "NAME" => GetMessage("PRIMECORP_WIZARD_NAME"),
    "DESCRIPTION" => GetMessage("PRIMECORP_WIZARD_DESC"),
    "VERSION" => "1.0.0",
    "START_TYPE" => "WINDOW",
    "WIZARD_TYPE" => "INSTALL",
    "IMAGE" => "/images/" . LANGUAGE_ID . "/solution.jpg",
    "PARENT" => "wizard_sol",
    "TEMPLATES" => array(
        array("SCRIPT" => "wizard_sol")
    ),
    "STEPS" => (defined("WIZARD_DEFAULT_SITE_ID")
        ? array("SelectTemplateStep", "DataInstallStep", "FinishStep")
        : array("SelectSiteStep", "SelectTemplateStep", "DataInstallStep", "FinishStep"))
);
?>