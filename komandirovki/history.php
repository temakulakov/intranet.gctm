<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Историия ваших согласований");
?><?$APPLICATION->IncludeComponent("bitrix:lists.list", "history", Array(
	"BIZPROC_LOG_URL" => "bizproc.log.php?ID=#document_state_id#",	// URL просмотра журнала бизнес-процесса
		"BIZPROC_WORKFLOW_ADMIN_URL" => "bizproc.workflow.admin.php?list_id=#list_id#",	// URL списка бизнес-процессов
		"BIZPROC_WORKFLOW_START_URL" => "bizproc.workflow.start.php?element_id=#element_id#&list_id=#list_id#&workflow_template_id=#workflow_template_id#",	// URL запуска бизнес-процесса
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => "64",	// Инфоблок
		"IBLOCK_TYPE_ID" => "lists",	// Тип инфоблока
		"LISTS_URL" => "lists.lists.php",	// URL главной страницы списков
		"LIST_EDIT_URL" => "lists.list.edit.php?list_id=#list_id#",	// URL настройки списка
		"LIST_ELEMENT_URL" => "https://intranet.gctm.ru/services/lists/?mode=edit&list_id=64&section_id=0&element_id=0&list_section_id=",	// Редактирование элемента
		"LIST_FILE_URL" => "lists.file.php?list_id=#list_id#&section_id=#section_id#&element_id=#element_id#&field_id=#field_id#&file_id=#file_id#",	// URL файла
		"LIST_SECTIONS_URL" => "lists.sections.php?list_id=#list_id#&section_id=#section_id#",	// Управление разделами
		"LIST_URL" => "lists.list.php?list_id=#list_id#&section_id=#section_id#",	// URL списка
		"SECTION_ID" => $_REQUEST["section_id"],	// Раздел
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>