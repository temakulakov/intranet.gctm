<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:lists.element.edit", 
	".default", 
	array(
		"IBLOCK_TYPE_ID" => "lists",
		"IBLOCK_ID" => "63",
		"SECTION_ID" => $_REQUEST["section_id"],
		"ELEMENT_ID" => $_REQUEST["element_id"],
		"LISTS_URL" => "lists.lists.php",
		"LIST_URL" => "index.php?list_id=#list_id#§ion_id=#section_id#",
		"LIST_ELEMENT_URL" => "lists.element.edit.php?list_id=#list_id#§ion_id=#section_id#&element_id=#element_id#",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"BIZPROC_LOG_URL" => "bizproc.log.php?ID=#document_state_id#",
		"BIZPROC_WORKFLOW_START_URL" => "bizproc.workflow.start.php?element_id=#element_id#&list_id=#list_id#",
		"BIZPROC_TASK_URL" => "bizproc.task.php?task_id=#task_id#",
		"COMPONENT_TEMPLATE" => ".default",
		"LIST_FILE_URL" => "lists.file.php?list_id=#list_id#&section_id=#section_id#&element_id=#element_id#&field_id=#field_id#&file_id=#file_id#"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>