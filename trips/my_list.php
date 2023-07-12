<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Мои заявки");
?><?$APPLICATION->IncludeComponent(
	"bitrix:lists.list",
	".default",
	Array(
		"BIZPROC_LOG_URL" => "",
		"BIZPROC_WORKFLOW_ADMIN_URL" => "",
		"BIZPROC_WORKFLOW_START_URL" => "",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => "64",
		"IBLOCK_TYPE_ID" => "lists",
		"LISTS_URL" => "lists.lists.php",
		"LIST_EDIT_URL" => "lists.list.edit.php?list_id=#list_id#",
		"LIST_ELEMENT_URL" => "lists.element.edit.php?list_id=#list_id#&section_id=#section_id#&element_id=#element_id#",
		"LIST_FILE_URL" => "lists.file.php?list_id=#list_id#&section_id=#section_id#&element_id=#element_id#&field_id=#field_id#&file_id=#file_id#",
		"LIST_SECTIONS_URL" => "lists.sections.php?list_id=#list_id#&section_id=#section_id#",
		"LIST_URL" => "lists.list.php?list_id=#list_id#&section_id=#section_id#",
		"SECTION_ID" => $_REQUEST["section_id"]
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_horizontal", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top_links",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "top_horizontal"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>