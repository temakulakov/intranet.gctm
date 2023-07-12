<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои заявки");
?><?$APPLICATION->IncludeComponent(
    "bitrix:lists.list",
    ".default",
    array(
        "BIZPROC_LOG_URL" => "",
        "BIZPROC_WORKFLOW_ADMIN_URL" => "",
        "BIZPROC_WORKFLOW_START_URL" => "",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "IBLOCK_ID" => "64",
        "IBLOCK_TYPE_ID" => "lists",
        "LISTS_URL" => "lists.lists.php",
        "LIST_EDIT_URL" => "lists.list.edit.php?list_id=#list_id#",
        "LIST_ELEMENT_URL" => "lists.element.edit.php?list_id=#list_id#&section_id=#section_id#&element_id=#element_id#",
        "LIST_FILE_URL" => "lists.file.php?list_id=#list_id#&section_id=#section_id#&element_id=#element_id#&field_id=#field_id#&file_id=#file_id#",
        "LIST_SECTIONS_URL" => "lists.sections.php?list_id=#list_id#&section_id=#section_id#",
        "LIST_URL" => "lists.list.php?list_id=#list_id#&section_id=#section_id#",
        "SECTION_ID" => $_REQUEST["section_id"],
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>