<?php
/**
 * @global  \CMain $APPLICATION
 */
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("");
IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/intranet/public/company/structure.php');

$APPLICATION->SetTitle(GetMessage('COMPANY_TITLE'));
$APPLICATION->AddChainItem(GetMessage('COMPANY_TITLE'), 'structure.php');
?><?$APPLICATION->IncludeComponent(
	"bitrix:intranet.structure",
	"",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COLUMNS" => "2",
		"COLUMNS_FIRST" => "2",
		"DATE_FORMAT" => "d.m.Y",
		"DATE_FORMAT_NO_YEAR" => "d.m",
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
		"FILTER_1C_USERS" => "N",
		"FILTER_NAME" => "structure",
		"FILTER_SECTION_CURONLY" => "Y",
		"MAX_DEPTH" => "2",
		"MAX_DEPTH_FIRST" => "5",
		"NAME_TEMPLATE" => "#LAST_NAME# #NAME# #SECOND_NAME#",
		"NAV_TITLE" => GetMessage('COMPANY_NAV_TITLE'),
		"PATH_TO_CONPANY_DEPARTMENT" => "/company/structure.php?set_filter_structure=Y&structure_UF_DEPARTMENT=#ID#",
		"PM_URL" => SITE_DIR.'company/personal/messages/chat/#USER_ID#/',
		"SEARCH_URL" => "index.php",
		"SHOW_ERROR_ON_NULL" => "N",
		"SHOW_FROM_ROOT" => "N",
		"SHOW_LOGIN" => "Y",
		"SHOW_NAV_BOTTOM" => "Y",
		"SHOW_NAV_TOP" => "Y",
		"SHOW_SECTION_INFO" => "Y",
		"SHOW_UNFILTERED_LIST" => "N",
		"SHOW_YEAR" => "Y",
		"USERS_PER_PAGE" => "25",
		"USER_PROPERTY" => array()
	)
);?>