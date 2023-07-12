<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent(
	"bitrix:lists.list", 
	"template6", 
	array(
		"BIZPROC_LOG_URL" => "bizproc.log.php?ID=#document_state_id#",
		"BIZPROC_WORKFLOW_ADMIN_URL" => "bizproc.workflow.admin.php?list_id=#list_id#",
		"BIZPROC_WORKFLOW_START_URL" => "bizproc.workflow.start.php?element_id=#element_id#&list_id=#list_id#&workflow_template_id=#workflow_template_id#",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "template6",
		"IBLOCK_ID" => "63",
		"IBLOCK_TYPE_ID" => "lists",
		"LISTS_URL" => "lists.lists.php",
		"LIST_EDIT_URL" => "lists.list.edit.php?list_id=#list_id#",
		"LIST_ELEMENT_URL" => "/services/lists/63/view/0/lists.element.edit.php?list_id=#list_id#&section_id=#section_id#&element_id=#element_id#",
		"LIST_FILE_URL" => "lists.file.php?list_id=#list_id#&section_id=#section_id#&element_id=#element_id#&field_id=#field_id#&file_id=#file_id#",
		"LIST_SECTIONS_URL" => "lists.sections.php?list_id=#list_id#&section_id=#section_id#",
		"LIST_URL" => "lists.list.php?list_id=#list_id#&section_id=#section_id#",
		"SECTION_ID" => "{\$_REQUEST[\"section_id\"]}"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:lists.fields", 
	".default", 
	array(
		"IBLOCK_TYPE_ID" => "lists",
		"IBLOCK_ID" => "63",
		"LISTS_URL" => "lists.lists.php",
		"LIST_URL" => "lists.list.php?list_id=#list_id#",
		"LIST_EDIT_URL" => "lists.list.edit.php?list_id=#list_id#",
		"LIST_FIELDS_URL" => "lists.fields.php?list_id=#list_id#",
		"LIST_FIELD_EDIT_URL" => "lists.field.edit.php?list_id=#list_id#&field_id=#field_id#",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>