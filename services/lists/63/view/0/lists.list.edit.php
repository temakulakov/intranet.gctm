<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent(
	"bitrix:lists.list.edit", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "63",
		"IBLOCK_TYPE_ID" => "lists",
		"LISTS_URL" => "lists.lists.php",
		"LIST_EDIT_URL" => "lists.list.edit.php?list_id=#list_id#",
		"LIST_FIELDS_URL" => "lists.fields.php?list_id=#list_id#",
		"LIST_URL" => "index.php?list_id=#list_id#",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>