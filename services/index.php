<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/services/index.php");
$APPLICATION->SetTitle(GetMessage("SERVICES_TITLE"));
?><?$APPLICATION->IncludeComponent(
	"bitrix:calendar.grid",
	"",
	Array(
		"ALLOW_RES_MEETING" => "Y",
		"ALLOW_SUPERPOSE" => "Y",
		"CALENDAR_TYPE" => "location"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>