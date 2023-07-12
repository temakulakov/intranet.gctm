<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Командировки ваших сотрудников");
?><?$APPLICATION->IncludeComponent(
	"bitrix:calendar.grid.error",
	"",
Array()
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>