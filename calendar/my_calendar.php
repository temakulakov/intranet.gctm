<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мой календарь");
?><?$APPLICATION->IncludeComponent(
	"bitrix:calendar.grid",
	".default",
	Array(
		"ALLOW_RES_MEETING" => "N",
		"ALLOW_SUPERPOSE" => "Y",
		"CALENDAR_TYPE" => "group",
		"COMPONENT_TEMPLATE" => ".default"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>