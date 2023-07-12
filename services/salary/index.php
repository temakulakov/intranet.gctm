<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/services/salary/index.php");
$APPLICATION->SetTitle(GetMessage("SERVICES_TITLE"));?><?$APPLICATION->IncludeComponent(
	"bitrix:payroll.1c",
	".default",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"ORG_LIST" => array(0=>GetMessage("SERVICES_ORG_LIST"),),
		"PR_LOGIN_0" => "",
		"PR_NAMESPACE" => "http://www.1c-bitrix.ru",
		"PR_PASSWORD_0" => "",
		"PR_PORT_0" => "80",
		"PR_TIMEOUT" => "25",
		"PR_URL_0" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:lists.lists",
	"",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"IBLOCK_TYPE_ID" => "lists",
		"LINE_ELEMENT_COUNT" => "3",
		"LISTS_URL" => "lists.lists.php",
		"LIST_EDIT_URL" => "lists.list.edit.php?list_id=#list_id#",
		"LIST_URL" => "lists.list.php?list_id=#list_id#"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>