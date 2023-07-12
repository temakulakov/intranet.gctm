<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Основные правила жизни в музее');
if ($_REQUEST['ELEMENT_CODE'] != 'kogda-u-kolleg-den-rozhdeniya') {
	$APPLICATION->IncludeComponent(
		"bitrix:news.detail",
		"content",
		array(
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"USE_SHARE" => "N",
			"SHARE_HIDE" => "N",
			"SHARE_TEMPLATE" => "",
			"SHARE_HANDLERS" => array("delicious"),
			"SHARE_SHORTEN_URL_LOGIN" => "",
			"SHARE_SHORTEN_URL_KEY" => "",
			"AJAX_MODE" => "N",
			"IBLOCK_TYPE" => "knowledge",
			"IBLOCK_ID" => "41",
			"ELEMENT_ID" => "",
			"ELEMENT_CODE" => $_REQUEST['ELEMENT_CODE'],
			"CHECK_DATES" => "Y",
			"FIELD_CODE" => array("ID", "PREVIEW_TEXT", "DETAIL_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE"),
			"PROPERTY_CODE" => array(),
			"IBLOCK_URL" => "",
			"DETAIL_URL" => "",
			"SET_TITLE" => "Y",
			"SET_CANONICAL_URL" => "Y",
			"SET_BROWSER_TITLE" => "Y",
			"BROWSER_TITLE" => "-",
			"SET_META_KEYWORDS" => "Y",
			"META_KEYWORDS" => "-",
			"SET_META_DESCRIPTION" => "Y",
			"META_DESCRIPTION" => "-",
			"SET_STATUS_404" => "Y",
			"SET_LAST_MODIFIED" => "Y",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
			"ADD_SECTIONS_CHAIN" => "Y",
			"ADD_ELEMENT_CHAIN" => "N",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"USE_PERMISSIONS" => "N",
			"GROUP_PERMISSIONS" => array("2"),
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "3600",
			"CACHE_GROUPS" => "Y",
			"DISPLAY_TOP_PAGER" => "Y",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Страница",
			"PAGER_TEMPLATE" => "",
			"PAGER_SHOW_ALL" => "Y",
			"PAGER_BASE_LINK_ENABLE" => "Y",
			"SHOW_404" => "Y",
			"MESSAGE_404" => "",
			"STRICT_SECTION_CHECK" => "Y",
			"PAGER_BASE_LINK" => "",
			"PAGER_PARAMS_NAME" => "arrPager",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N"
		)
	);
} else {
	//IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/intranet/public/company/birthdays.php');
	$APPLICATION->IncludeComponent("bitrix:intranet.structure.birthday.nearest", "museum", Array(
		"STRUCTURE_PAGE" => "structure.php",	// Страница структуры компании
		"PM_URL" => SITE_DIR."company/personal/messages/chat/#USER_ID#/",	// Страница отправки личного сообщения
		"PATH_TO_CONPANY_DEPARTMENT" => SITE_DIR."company/structure.php?set_filter_structure=Y&structure_UF_DEPARTMENT=#ID#",	// Шаблон пути к странице подразделения
		"PATH_TO_VIDEO_CALL" => SITE_DIR."company/personal/video/#USER_ID#/",
		"STRUCTURE_FILTER" => "structure",	// Имя фильтра страницы структуры компании
		"NUM_USERS" => "25",	// Количество выводимых пользователей
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"SHOW_YEAR" => "M",	// Показывать год рождения
		"USER_PROPERTY" => array(	// Пользовательские поля для вывода
			0 => "PERSONAL_PHONE",
			1 => "UF_DEPARTMENT",
			2 => "UF_PHONE_INNER",
			3 => "UF_SKYPE",
			4 => "PERSONAL_PHOTO",
		),
		"SHOW_FILTER" => "N",	// Отображать фильтр
	),
		false
	);
} ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>