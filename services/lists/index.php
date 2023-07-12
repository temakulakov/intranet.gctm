<?php
/**
 * @global  \CMain $APPLICATION
 */
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/intranet/public/services/lists/index.php');
$APPLICATION->SetTitle(GetMessage('SERVICES_TITLE'));

$APPLICATION->IncludeComponent("bitrix:lists", "template2", Array(
	"IBLOCK_TYPE_ID" => "lists",	// Тип инфоблока
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"SEF_FOLDER" => SITE_DIR."services/lists/",	// Каталог ЧПУ (относительно корня сайта)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"COMPONENT_TEMPLATE" => ".default",
		"VARIABLE_ALIASES" => array(
			"list_id" => "list_id",
			"field_id" => "field_id",
			"section_id" => "section_id",
			"element_id" => "element_id",
			"file_id" => "file_id",
			"mode" => "mode",
			"document_state_id" => "document_state_id",
			"task_id" => "task_id",
			"ID" => "ID",
		)
	),
	false
);

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');