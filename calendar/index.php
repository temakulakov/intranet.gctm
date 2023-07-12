<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/about/calendar.php");
$APPLICATION->SetTitle(GetMessage("ABOUT_TITLE"));
?><?$APPLICATION->IncludeComponent(
	"bitrix:calendar.grid", 
	".default", 
	array(
		"ALLOW_RES_MEETING" => "N",
		"ALLOW_SUPERPOSE" => "N",
		"CALENDAR_TYPE" => "company_calendar",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>