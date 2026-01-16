<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (!CModule::IncludeModule("main"))
    return;

$eventType = "PROTOCORP_FEEDBACK";

$rsET = CEventType::GetList([
    "TYPE_ID" => $eventType,
    "LID"     => "ru"
]);
if (!$rsET->Fetch())
{
    $obEventType = new CEventType;
    $arFields    = [
        "LID"         => "ru",
        "EVENT_NAME"  => $eventType,
        "NAME"        => GetMessage("PROTOCORP_FEEDBACK_NAME"),
        "DESCRIPTION" => GetMessage("PROTOCORP_FEEDBACK_DESCRIPTION")
    ];
    $obEventType->Add($arFields);
}

$dbTemplate = CEventMessage::GetList(
    ($by = "ID"),
    ($order = "DESC"),
    ["EVENT_NAME" => $eventType, "LID" => WIZARD_SITE_ID]
);
if (!$dbTemplate->Fetch())
{
    $arTemplateFields = [
        "ACTIVE"     => "Y",
        "EVENT_NAME" => $eventType,
        "LID"        => [WIZARD_SITE_ID],
        "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
        "EMAIL_TO"   => "#DEFAULT_EMAIL_FROM#",
        "SUBJECT"    => GetMessage("PROTOCORP_FEEDBACK_TEMPLATE_SUBJECT"),
        "BODY_TYPE"  => "html",
        "MESSAGE"    => GetMessage("PROTOCORP_FEEDBACK_TEMPLATE_MESSAGE")
    ];
    $et = new CEventMessage;
    $et->Add($arTemplateFields);
}
