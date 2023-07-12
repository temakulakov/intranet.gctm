<?

/** @global CMain $APPLICATION */
/** @global CUser $USER */

//phpinfo();
use Bitrix\Intranet\Integration\Templates\Bitrix24\ThemePicker;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use \Bitrix\Main\Page\AssetLocation;
use \Bitrix\Intranet;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

$asset = \Bitrix\Main\Page\Asset::getInstance();

//Ajax Performance Optimization
if (isset($_GET['RELOAD']) && $_GET['RELOAD'] == 'Y') {
	return; //Live Feed Ajax
} else if (mb_strpos($_SERVER['REQUEST_URI'], '/historyget/') > 0) {
	return;
} else if (isset($_GET['IFRAME']) && $_GET['IFRAME'] === 'Y' && !isset($_GET['SONET'])) {
	//For the task iframe popup
	$APPLICATION->SetPageProperty('BodyClass', 'task-iframe-popup');

	$asset->addCss(SITE_TEMPLATE_PATH . '/interface.css', true);
	$asset->addJs(SITE_TEMPLATE_PATH . '/bitrix24.js', true);
	return;
}

CModule::IncludeModule('intranet');

\Bitrix\Main\UI\Extension::load([
	"ui.fonts.opensans",
	"intranet.sidepanel.bitrix24",
	"socialnetwork.slider",
	"calendar.sliderloader",
	"ui.notification",
	"ui.info-helper",
	"ui.design-tokens",
]);

Loc::loadMessages($_SERVER['DOCUMENT_ROOT'] . '/bitrix/templates/' . SITE_TEMPLATE_ID . '/header.php');

$asset->moveJs('im');
$asset->moveJs('timeman');
$asset->setUnique('bx24', 'TEMPLATE');

$isCompositeMode = defined('USE_HTML_STATIC_CACHE');

$isIndexPage =
	$APPLICATION->GetCurPage(true) === SITE_DIR . 'stream/index.php' ||
	$APPLICATION->GetCurPage(true) === SITE_DIR . 'index.php' ||
	(defined('BITRIX24_INDEX_PAGE') && constant('BITRIX_INDEX_PAGE') === true);

$isBitrix24Cloud = ModuleManager::isModuleInstalled('bitrix24');

if ($isIndexPage) {
	if (!defined('BITRIX24_INDEX_PAGE')) {
		define('BITRIX24_INDEX_PAGE', true);
	}

	if ($isCompositeMode) {
		define('BITRIX24_INDEX_COMPOSITE', true);
	}
}

function showJsTitle()
{
	/** @global CMain $APPLICATION */
	global $APPLICATION;
	$APPLICATION->AddBufferContent("getJsTitle");
}

function getJsTitle()
{
	/** @global CMain $APPLICATION */
	global $APPLICATION;
	$title = $APPLICATION->GetTitle("title", true);
	$title = html_entity_decode($title, ENT_QUOTES, SITE_CHARSET);
	return CUtil::JSEscape($title);
}
?>
<!DOCTYPE html>
<html <? if (LANGUAGE_ID == "tr") : ?>lang="<?= LANGUAGE_ID ?>" <? endif ?>>

<head><?
		$asset->addString(
			'<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />',
			false,
			AssetLocation::BEFORE_CSS
		);
		$asset->addString(
			'<meta http-equiv="X-UA-Compatible" content="IE=edge" />',
			false,
			AssetLocation::BEFORE_CSS
		);

		if ($isBitrix24Cloud) {
			$asset->addString(
				'<meta name="apple-itunes-app" content="app-id=561683423" />',
				false,
				AssetLocation::BEFORE_CSS
			);
			$asset->addString(
				'<link rel="apple-touch-icon-precomposed" href="/images/iphone/57x57.png" />',
				false,
				AssetLocation::BEFORE_CSS
			);
			$asset->addString(
				'<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/iphone/72x72.png" />',
				false,
				AssetLocation::BEFORE_CSS
			);
			$asset->addString(
				'<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/iphone/114x114.png" />',
				false,
				AssetLocation::BEFORE_CSS
			);
			$asset->addString(
				'<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/iphone/144x144.png" />',
				false,
				AssetLocation::BEFORE_CSS
			);
		}

		$APPLICATION->ShowHead(false);
		$asset->addCss(SITE_TEMPLATE_PATH . '/interface.css', true);
		$asset->addJs(SITE_TEMPLATE_PATH . '/bitrix24.js', true);
		$asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.js', true);
		if (strpos($APPLICATION->GetCurPage(), '/knowledgebase/') !== false || strpos($APPLICATION->GetCurPage(), '/news/') !== false) {
			$asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery-ui.min.js', true);
			$asset->addJs(SITE_TEMPLATE_PATH . '/js/masonry.js', true);
			$asset->addJs(SITE_TEMPLATE_PATH . '/js/fancybox.js', true);
			$asset->addJs(SITE_TEMPLATE_PATH . '/js/main.js', true);
			$asset->addCss(SITE_TEMPLATE_PATH . '/fonts/fonts.css', true);
			$asset->addCss(SITE_TEMPLATE_PATH . '/css/jquery-ui.min.css', true);
			$asset->addCss(SITE_TEMPLATE_PATH . '/css/fancybox.css', true);
		}
		$asset->addCss(SITE_TEMPLATE_PATH . '/css/custom.css', true);

		ThemePicker::getInstance()->showHeadAssets();

		$bodyClass = "template-bitrix24";
		if ($isIndexPage) {
			$bodyClass .= " no-paddings start-page";
		}


		$bodyClass .= " bitrix24-" . ThemePicker::getInstance()->getCurrentBaseThemeId() . "-theme";

		$imBarExists =
			CModule::IncludeModule("im") &&
			CBXFeatures::IsFeatureEnabled("WebMessenger") &&
			!defined("BX_IM_FULLSCREEN");

		if ($imBarExists) {
			$bodyClass .= " im-bar-mode";
		}

		if ($USER->isAdmin()) {
			$bodyClass .= " admin-body";
		}

		$asset->addString(
			'<link rel="stylesheet" type="text/css" media="print" href="' . \CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . "/print.css") . '">',
			false,
			AssetLocation::AFTER_CSS
		);
		?><title><? if (!$isCompositeMode || $isIndexPage) $APPLICATION->ShowTitle() ?></title>
</head>

<body class="<?= $bodyClass ?>">
	<?
	ThemePicker::getInstance()->showBodyAssets();

	if ($isCompositeMode && !$isIndexPage) {
		$frame = new \Bitrix\Main\Page\FrameStatic("title");
		$frame->startDynamicArea();
	?>
		<script type="text/javascript">
			document.title = "<? showJsTitle() ?>";
		</script>
	<?
		$frame->finishDynamicArea();
	}

	$isExtranet =
		ModuleManager::isModuleInstalled("extranet") &&
		COption::GetOptionString("extranet", "extranet_site") === SITE_ID;

	$APPLICATION->ShowViewContent("im");
	$APPLICATION->ShowViewContent("im-fullscreen");

	$layoutMode = "";
	if (CUserOptions::GetOption("intranet", "left_menu_collapsed") === "Y") {
		$layoutMode .= " menu-collapsed-mode";
	}
	?>

	<? if (!$USER->IsAdmin()) { ?>
		<style>
			.menu-item-favorites-more {
				display: none !important;
			}

			.menu-favorites-more-btn {
				display: none !important;
			}

			.menu-extra-btn-box {
				display: none !important;
			}
		</style>
	<? } ?>
	<table class="bx-layout-table<?= $layoutMode ?>">
		<tr class="theme-custom-header">
			<td class="bx-layout-header">
				<? if ((!$isBitrix24Cloud || $USER->IsAdmin()) && !defined("SKIP_SHOW_PANEL")) : ?>
					<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
				<? endif ?>
				<?
				if ($isBitrix24Cloud) {
					if (Option::get('bitrix24', 'creator_confirmed', 'N') !== 'Y') {
						$APPLICATION->IncludeComponent(
							'bitrix:bitrix24.creatorconfirmed',
							'',
							array(),
							null,
							array('HIDE_ICONS' => 'Y')
						);
					}

					if (
						Option::get("bitrix24", "domain_changed", 'N') === 'N' ||
						is_array(\CUserOptions::GetOption('bitrix24', 'domain_changed', false))
					) {
						CJSCore::Init(array('b24_rename'));
					}
				}
				?>
				<div id="header" class="<? $APPLICATION->ShowProperty("HeaderClass"); ?>">
					<div id="header-inner">
						<?
						//This component was used for menu-create-but.
						//We have to include the component before bitrix:timeman for composite mode.
						if (CModule::IncludeModule('tasks') && CBXFeatures::IsFeatureEnabled('Tasks')) :
							$APPLICATION->IncludeComponent(
								"bitrix:tasks.iframe.popup",
								".default",
								array(
									"ON_TASK_ADDED" => "#SHOW_ADDED_TASK_DETAIL#",
									"ON_TASK_CHANGED" => "BX.DoNothing",
									"ON_TASK_DELETED" => "BX.DoNothing"
								),
								null,
								array("HIDE_ICONS" => "Y")
							);
						endif;

						if (!$isExtranet) {
							if (
								!ModuleManager::isModuleInstalled("timeman") ||
								!$APPLICATION->IncludeComponent('bitrix:timeman', 'bitrix24', array(), false, array("HIDE_ICONS" => "Y"))
							) {
								$APPLICATION->IncludeComponent('bitrix:planner', 'bitrix24', array(), false, array("HIDE_ICONS" => "Y"));
							}
						} else {
							CJSCore::Init("timer"); ?>
							<div class="timeman-container timer-container timeman-container-<?= LANGUAGE_ID ?><?= (IsAmPmMode() ? " am-pm-mode" : "") ?>" id="timeman-container">
								<div class="timeman-wrap">
									<span id="timeman-block" class="timeman-block">
										<span class="bx-time" id="timeman-timer"></span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
								BX.ready(function() {
									BX.timer.registerFormat("bitrix24_time", B24.Timemanager.formatCurrentTime);
									BX.timer({
										container: BX("timeman-timer"),
										display: "bitrix24_time"
									});
								});
							</script>
						<?
						}
						?>
						<!--suppress CheckValidXmlInScriptTagBody -->
						<script type="text/javascript" data-skip-moving="true">
							(function() {
								var isAmPmMode = <?= (IsAmPmMode() ? "true" : "false") ?>;
								var time = document.getElementById("timeman-timer");
								var hours = new Date().getHours();
								var minutes = new Date().getMinutes();
								if (time) {
									time.innerHTML = formatTime(hours, minutes, 0, isAmPmMode);
								} else if (document.addEventListener) {
									document.addEventListener("DOMContentLoaded", function() {
										time.innerHTML = formatTime(hours, minutes, 0, isAmPmMode);
									});
								}

								function formatTime(hours, minutes, seconds, isAmPmMode) {
									var ampm = "";
									if (isAmPmMode) {

										ampm = hours >= 12 ? "PM" : "AM";
										ampm = '<span class="time-am-pm">' + ampm + '</span>';
										hours = hours % 12;
										hours = hours ? hours : 12;
									} else {
										hours = hours < 10 ? "0" + hours : hours;
									}

									return '<span class="time-hours">' + hours + '</span>' + '<span class="time-semicolon">:</span>' +
										'<span class="time-minutes">' + (minutes < 10 ? "0" + minutes : minutes) + '</span>' + ampm;
								}
							})();
						</script>
						<div class="header-logo-block">
							<? include(__DIR__ . "/logo.php"); ?>
						</div>

						<? if (Loader::includeModule("bitrix24") && \CBitrix24::IsPortalAdmin($USER->GetID())) {
							if (!\CBitrix24::isDomainChanged()) {
						?>
								<div class="header-logo-block-settings header-logo-block-settings-show" data-rename-portal="true">
									<span class="header-logo-block-settings-item" onclick="BX.Bitrix24.renamePortal(this)" title="<?= GetMessage('BITRIX24_SETTINGS_TITLE') ?>">
									</span>
								</div>
							<?
							}
							if (isset($_GET["b24renameform"])) {
							?>
								<script>
									BX.ready(function() {
										if (!!BX.Bitrix24 && !!BX.Bitrix24.renamePortal) {
											BX.Bitrix24.renamePortal()
										}
									});
								</script>
						<?
							}
						}
						?>

						<div class="header-search">
							<?
							if (!IsModuleInstalled("bitrix24")/*IsModuleInstalled("search")*/) {
								$searchParams = array(
									"NUM_CATEGORIES" => "4",
									"CATEGORY_3_TITLE" => GetMessage("BITRIX24_SEARCH_MICROBLOG"),
									"CATEGORY_3" => array(
										0 => "microblog", 1 => "blog",
									),
								);
							} else {
								$searchParams = array(
									"NUM_CATEGORIES" => "3",
								);
							}

							$APPLICATION->IncludeComponent(
								(ModuleManager::isModuleInstalled("search") ? "bitrix:search.title" : "bitrix:intranet.search.title"),
								(ModuleManager::isModuleInstalled("search")
									&& COption::GetOptionString("intranet", "search_title_old", "") == "Y" ? ".default_old" : ""
								),
								array_merge(
									array(
										"CHECK_DATES" => "N",
										"SHOW_OTHERS" => "N",
										"TOP_COUNT" => 7,
										"CATEGORY_0_TITLE" => GetMessage("BITRIX24_SEARCH_EMPLOYEE"),
										"CATEGORY_0" => array(
											0 => "custom_users",
										),
										"CATEGORY_1_TITLE" => GetMessage("BITRIX24_SEARCH_GROUP"),
										"CATEGORY_1" => array(
											0 => "custom_sonetgroups",
										),
										"CATEGORY_2_TITLE" => GetMessage("BITRIX24_SEARCH_MENUITEMS"),
										"CATEGORY_2" => array(
											0 => "custom_menuitems",
										),
										"CATEGORY_OTHERS_TITLE" => GetMessage("BITRIX24_SEARCH_OTHER"),
										"SHOW_INPUT" => "N",
										"INPUT_ID" => "search-textbox-input",
										"CONTAINER_ID" => "search",
										"USE_LANGUAGE_GUESS" => (LANGUAGE_ID == "ru") ? "Y" : "N"
									),
									$searchParams
								),
								false,
								array('HIDE_ICONS' => 'Y')
							);
							?>
						</div>
						<div class="header-personal">
							<?
							$profileLink = $isExtranet ? SITE_DIR . "contacts/personal" : SITE_DIR . "company/personal";
							$APPLICATION->IncludeComponent(
								"bitrix:intranet.user.profile.button",
								"museum",
								array(
									"PATH_TO_USER_PROFILE" => $profileLink . "/user/#user_id#/",
									"PATH_TO_USER_PROFILE_EDIT" => $profileLink . "/user/#user_id#/edit/",
									"PATH_TO_USER_STRESSLEVEL" => $profileLink . "/user/#user_id#/stresslevel/",
									"PATH_TO_USER_COMMON_SECURITY" => $profileLink . "/user/#user_id#/common_security/",
								),
								false
							);
							?>
							<div class="header-item" id="header-buttons">
								<?php
								$APPLICATION->IncludeComponent(
									IsModuleInstalled('bitrix24') ?
										"bitrix:bitrix24.license.widget" :
										"bitrix:intranet.license.widget",
									"",
									[]
								);
								$APPLICATION->IncludeComponent("bitrix:intranet.invitation.widget", "", []);
								?>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr class="theme-custom-content">
			<td class="bx-layout-cont">
				<?php
				$dynamicArea = new \Bitrix\Main\Composite\StaticArea("inline-scripts");
				$dynamicArea->startDynamicArea();

				$APPLICATION->ShowViewContent("inline-scripts");

				$dynamicArea->finishDynamicArea();
				?>
				<table class="bx-layout-inner-table">
					<tr class="bx-layout-inner-top-row">
						<td class="bx-layout-inner-left" id="layout-left-column">
							<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left_vertical", 
	array(
		"ROOT_MENU_TYPE" => file_exists($_SERVER["DOCUMENT_ROOT"].SITE_DIR.".superleft.menu_ext.php")?"superleft":"top",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "604800",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_USE_USERS" => "Y",
		"CACHE_SELECTED_ITEMS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "left_vertical",
		"CHILD_MENU_TYPE" => "left"
	),
	false
);

							if ($imBarExists) {
								//This component changes user counters on the page.
								//User counters can be changed in the left menu (left_vertical template).
								$APPLICATION->IncludeComponent(
									"bitrix:im.messenger",
									"",
									array(
										"CONTEXT" => "POPUP-FULLSCREEN",
										"RECENT" => "Y",
										'PATH_TO_SONET_EXTMAIL' => Option::get('intranet', 'path_mail_client', SITE_DIR . 'mail/'),
									),
									false,
									array("HIDE_ICONS" => "Y")
								);
							}
							?>
						</td>
						<td class="bx-layout-inner-center" id="content-table">
							<?
							if ($isCompositeMode && !$isIndexPage) {
								$isDefaultTheme = ThemePicker::getInstance()->getCurrentThemeId() === "default";
								$bodyClass = $isDefaultTheme ? "" : " no-background";
								$dynamicArea = new \Bitrix\Main\Page\FrameStatic("workarea");
								$dynamicArea->setAssetMode(\Bitrix\Main\Page\AssetMode::STANDARD);
								$dynamicArea->setContainerId("content-table");
								$dynamicArea->setStub(
									'
							<table class="bx-layout-inner-inner-table composite-mode' . $bodyClass . '">
								<colgroup>
									<col class="bx-layout-inner-inner-cont">
								</colgroup>
								<tr class="bx-layout-inner-inner-top-row">
									<td class="bx-layout-inner-inner-cont">
										<div class="pagetitle-wrap"></div>
									</td>
								</tr>
								<tr>
									<td class="bx-layout-inner-inner-cont">
										<div id="workarea" class="workarea">
											<div id="workarea-content" class="workarea-content">
												<div class="workarea-content-paddings">
													<div style="position: relative; height: 50vh;">
														<div class="intranet-loader-container" id="b24-loader">
															<svg class="intranet-loader-circular" viewBox="25 25 50 50">
																<circle class="intranet-loader-path" 
																	cx="50" cy="50" r="20" fill="none" 
																	stroke-miterlimit="10"
																/>
															</svg>
														</div>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
							</table>
							<script>B24.showLoading();</script>'
								);
								$dynamicArea->startDynamicArea();
							}
							?>
							<table class="bx-layout-inner-inner-table <? $APPLICATION->ShowProperty("BodyClass"); ?>">
								<colgroup>
									<col class="bx-layout-inner-inner-cont">
								</colgroup>
								<? if (!$isIndexPage && strpos($APPLICATION->GetCurPage(), '/knowledgebase/') === false) : ?>
									<tr class="bx-layout-inner-inner-top-row">
										<td class="bx-layout-inner-inner-cont">
											<div class="page-header">
												<div class="page-navigation">
													<?
													$APPLICATION->ShowViewContent("above_pagetitle");
													$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"gctm", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"CHILD_MENU_TYPE" => "sub",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "604800",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_USE_USERS" => "Y",
		"CACHE_SELECTED_ITEMS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "3",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "gctm",
		"MENU_THEME" => "site"
	),
	false
); ?>
													<div class="page-toolbar">
														<?
														$APPLICATION->IncludeComponent("bitrix:ui.toolbar", "template6", Array(
	"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
														?>
													</div>
												</div>
												<div class="pagetitle-below"><? $APPLICATION->ShowViewContent("below_pagetitle") ?></div>
											</div>
										</td>
									</tr>
								<? endif ?>
								<tr>
									<td class="bx-layout-inner-inner-cont">
										<div id="workarea" class="workarea">
											<? if ($APPLICATION->GetProperty("HIDE_SIDEBAR", "N") != "Y") :
											?>
												<div id="sidebar">
													<?
													$APPLICATION->ShowViewContent("sidebar");
													$APPLICATION->ShowViewContent("sidebar_tools_1");
													$APPLICATION->ShowViewContent("sidebar_tools_2");
													?>
												</div>
											<? endif ?>
											<div id="workarea-content" class="workarea-content">
												<? if (strpos($APPLICATION->GetCurPage(), "knowledgebase") !== false) : ?>
													<style>
														.workarea-content-paddings {
															padding-left: 0px;
															padding-right: 0px;
														}
													</style>
													<a href="" class="menu-button">
													</a>
													<div class="overlay"></div>
													<? $APPLICATION->IncludeComponent(
														"bitrix:news.list",
														"knowledge_menu",
														array(
															"DISPLAY_DATE" => "Y",
															"DISPLAY_NAME" => "Y",
															"DISPLAY_PICTURE" => "Y",
															"DISPLAY_PREVIEW_TEXT" => "Y",
															"AJAX_MODE" => "N",
															"IBLOCK_TYPE" => "knowledge",
															"IBLOCK_ID" => "39",
															"NEWS_COUNT" => "2000",
															"SORT_BY1" => "SORT",
															"SORT_ORDER1" => "ASC",
															"SORT_BY2" => "SORT",
															"SORT_ORDER2" => "ASC",
															"FILTER_NAME" => "",
															"FIELD_CODE" => array("ID"),
															"PROPERTY_CODE" => array("DESCRIPTION", "URL"),
															"CHECK_DATES" => "Y",
															"DETAIL_URL" => "",
															"PREVIEW_TRUNCATE_LEN" => "",
															"ACTIVE_DATE_FORMAT" => "d.m.Y",
															"SET_TITLE" => "N",
															"SET_BROWSER_TITLE" => "N",
															"SET_META_KEYWORDS" => "N",
															"SET_META_DESCRIPTION" => "N",
															"SET_LAST_MODIFIED" => "N",
															"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
															"ADD_SECTIONS_CHAIN" => "N",
															"HIDE_LINK_WHEN_NO_DETAIL" => "N",
															"PARENT_SECTION" => "",
															"PARENT_SECTION_CODE" => "",
															"INCLUDE_SUBSECTIONS" => "Y",
															"CACHE_TYPE" => "A",
															"CACHE_TIME" => "36000000",
															"CACHE_FILTER" => "Y",
															"CACHE_GROUPS" => "Y",
															"DISPLAY_TOP_PAGER" => "N",
															"DISPLAY_BOTTOM_PAGER" => "N",
															"PAGER_TITLE" => "Новости",
															"PAGER_SHOW_ALWAYS" => "N",
															"PAGER_TEMPLATE" => "",
															"PAGER_DESC_NUMBERING" => "Y",
															"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
															"PAGER_SHOW_ALL" => "Y",
															"PAGER_BASE_LINK_ENABLE" => "Y",
															"SET_STATUS_404" => "N",
															"SHOW_404" => "N",
															"MESSAGE_404" => "",
															"PAGER_BASE_LINK" => "",
															"PAGER_PARAMS_NAME" => "arrPager",
															"AJAX_OPTION_JUMP" => "N",
															"AJAX_OPTION_STYLE" => "Y",
															"AJAX_OPTION_HISTORY" => "N",
															"AJAX_OPTION_ADDITIONAL" => ""
														)
													); ?>
												<? endif; ?>
												<div class="workarea-content-paddings">
													<? $APPLICATION->ShowViewContent("topblock") ?>
													<? if ($isIndexPage) : ?>
														<div class="pagetitle-wrap <? $APPLICATION->ShowProperty("TitleClass"); ?>">
															<div class="pagetitle-inner-container">
																<div class="pagetitle-menu" id="pagetitle-menu"><? $APPLICATION->ShowViewContent("pagetitle") ?></div>
																<div class="pagetitle" id="pagetitle"><? $APPLICATION->ShowTitle(false); ?></div>
																<? $APPLICATION->ShowViewContent("inside_pagetitle") ?>
															</div>
														</div>
													<? endif ?>
													<? CPageOption::SetOptionString("main.interface", "use_themes", "N"); //For grids
													?>