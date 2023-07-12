<?php
/**
 * @global  \CMain $APPLICATION
 */
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/intranet/public/company/vis_structure.php');
$APPLICATION->SetTitle(GetMessage('COMPANY_TITLE'));
$APPLICATION->AddChainItem(GetMessage('COMPANY_TITLE'), 'vis_structure.php');
?><?php
$APPLICATION->IncludeComponent("bitrix:intranet.structure.visual", "template1", Array(
	"DETAIL_URL" => SITE_DIR."company/structure.php?set_filter_structure=Y&structure_UF_DEPARTMENT=#ID#",	// Страница структуры компании
		"PROFILE_URL" => SITE_DIR."company/personal/user/#ID#/",	// Страница профиля пользователя
		"PM_URL" => SITE_DIR."company/personal/messages/chat/#ID#/",	// Страница отправки личного сообщения
		"NAME_TEMPLATE" => "",	// Отображение имени
		"USE_USER_LINK" => "Y",	// Выводить всплывающие информационные карточки пользователей
	),
	false
);
?><?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');