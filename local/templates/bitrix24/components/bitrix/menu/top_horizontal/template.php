
<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

$this->setFrameMode(true);


global $APPLICATION;

CJSCore::Init(array('ajax', 'jquery'));

if (!is_array($arResult) || empty($arResult))
{
	return;
}

$parents = [];
$items = [];

$cUser = $USER->GetID();

if ($arResult[0]['TEXT'] == 'Оформление заявки') {
    $userGroups = CUser::GetUserGroup($cUser);
    if (
		$userGroups == 1 or // Администраторы
        $userGroups == 9 or // Отдел кадров
        $userGroups == 10 or // Руководство
        $userGroups == 18 // Служба безопасности
    ) {
        $journal = [
            'TEXT' => 'Журнал учета',
            'LINK' => 'https://intranet.gctm.ru/services/lists/?mode=view&list_id=64&section_id=0&list_section_id=',
            'PERMISSION' => 'X',
            'PARAMS' => [
                'target' => '_blank'
            ]
        ];
        array_push($arResult, $journal);
    }
}

if ($arResult[0]['TEXT'] == 'Мой календарь') {
    $arResult[0]['LINK'] = '/calendar/my_calendar.php';
    if (
        $cUser == 1447 or
        $cUser == 1516 or
        $cUser == 1635 or
        $cUser == 1462 or
        $cUser == 1505 or
        $cUser == 1431 or
        $cUser == 1513 or
        $cUser == 1385 or
        $cUser == 1480 or
        $cUser == 1439 or
        $cUser == 1549 or
        $cUser == 1353 or
        $cUser == 1473 or
        $cUser == 1481 or
        $cUser == 1511 or
        $cUser == 406 or
        $cUser == 588 or
        $cUser == 1498 or
        $cUser == 160
    ) {
        $ruccal = [
            'TEXT' => 'Календарь руководителей',
            'LINK' => 'https://calendar.google.com/calendar/u/0/r/day?pli=1',
            'PERMISSION' => 'X',
            'PARAMS' => [
                'target' => '_blank'
            ]
        ];
        array_push($arResult, $ruccal);
    }
}






foreach ($arResult as $item)
{
	$menuItem = [
		'TEXT' => $item['TEXT'],
		'URL' => $item["PARAMS"]["real_link"] ?? $item["LINK"],
		'ID' => $item['PARAMS']['menu_item_id'],
		'COUNTER' =>
			isset($item['PARAMS']['counter_num']) && (int)$item['PARAMS']['counter_num']
				? (int)$item['PARAMS']['counter_num']
				: ''
		,
		'COUNTER_ID' => $item['PARAMS']['counter_id'] ?? '',
		'IS_ACTIVE' => $item['SELECTED'],
		'IS_LOCKED' => isset($item['PARAMS']['is_locked']) && $item['PARAMS']['is_locked'] === true,
		'IS_NEW' => isset($item['PARAMS']['is_new']) && $item['PARAMS']['is_new'] === true,
		'SUPER_TITLE' =>
			isset($item['PARAMS']['super_title']) && is_array($item['PARAMS']['super_title'])
			? $item['PARAMS']['super_title']
			: ''
		,
		'ON_CLICK' =>
			isset($item['PARAMS']['onclick']) && is_string($item['PARAMS']['onclick'])
				? $item['PARAMS']['onclick']
				: ''
		,
		'SUB_LINK' => $item["PARAMS"]["sub_link"] ?? '',
		'CLASS' => $item['PARAMS']['class'],
		'IS_DISABLED' => $item['PARAMS']['is_disabled'] ?? false,
		'IS_DELIMITER' => $item['PARAMS']['is_delimiter'] ?? false,
		// 'CLASS_SUBMENU_ITEM',
	];

	if (isset($item['PARAMS']['action']) && is_array($item['PARAMS']['action']))
	{
		if (isset($item['PARAMS']['action']['ID']) && $item['PARAMS']['action']['ID'] == 'CREATE')
		{
			$menuItem['SUB_LINK'] = [
				//'CLASS' => 'crm-menu-plus-btn',
				'URL' => $item['PARAMS']['action']['URL'],
			];
		}
	}

	$index = $item['DEPTH_LEVEL'] - 1;
	if (isset($parents[$index]))
	{
		if (!isset($parents[$index]['ITEMS']))
		{
			$parents[$index]['ITEMS'] = [];
		}

		if ($menuItem['IS_ACTIVE'])
		{
			for ($i = $index; $i >= 1; $i--)
			{
				$parents[$i]['IS_ACTIVE'] = true;
			}
		}

		$parents[$index]['ITEMS'][] = $menuItem;

		$parents[$item['DEPTH_LEVEL']] = &$parents[$index]['ITEMS'][count($parents[$index]['ITEMS']) - 1];
	}
	else
	{
		$items[] = $menuItem;
		$parents[$item['DEPTH_LEVEL']] = &$items[count($items) - 1];
	}
}

$menuId = 'top_panel_menu';

//hack for complex component (/company/personal/ pages)
$topMenuSectionDir = $APPLICATION->GetPageProperty('topMenuSectionDir');
if (!empty($topMenuSectionDir))
{
	$arParams['MENU_DIR'] = $topMenuSectionDir;
}

if (isset($arParams['MENU_DIR']) && !empty($arParams['MENU_DIR']))
{
	$menuId = str_replace('/', '_', trim($arParams['MENU_DIR'], '/'));
	$menuId = 'top_menu_id_' . $menuId;
}

$APPLICATION->IncludeComponent("bitrix:main.interface.buttons", "template2", Array(
	"ID" => $menuId,
		"ITEMS" => $items
	),
	false
);
?>

<script>
    $('a[href="https://calendar.google.com/calendar/u/0/r/day?pli=1"]')[0].setAttribute('target', '_blank');
</script>

<?if ($userGroups == 1 or
        $userGroups == 9 or
        $userGroups == 10 or
        $userGroups == 18):?>

<?endif?>


<script>

    BX.ready(function () {
        const arrButtons = Array.from(document.getElementsByClassName("main-buttons-item"));


        if (window.location.href.includes("/calendar/my_calendar.php")) {
            arrButtons.forEach((item, index) => {
                item.classList.remove('main-buttons-item-active');

            });
            arrButtons[0].classList.add('main-buttons-item-active');
        }

        else if (window.location.href.includes("/calendar/rooms/")) {
            arrButtons.forEach((item, index) => {
                item.classList.remove('main-buttons-item-active');

            });
            arrButtons[2].classList.add('main-buttons-item-active');
        }

        else if (window.location.href.includes("/services/lists/)) {
            arrButtons.forEach((item, index) => {
                item.classList.remove('main-buttons-item-active');

            });
        const menu = document.getElementById("top_menu_id_services_4265986112");
        menu.classList.add('main-buttons-item-active');

    else if (window.location.href.includes("/company/personal/bizproc/")) {
        arrButtons.forEach((item, index) => {
            item.classList.remove('main-buttons-item-active');

        });
        arrButtons[2].classList.add('main-buttons-item-active');
    }

    else if (window.location.href.includes("/komandirovki/history.php")) {
        arrButtons.forEach((item, index) => {
            item.classList.remove('main-buttons-item-active');
        });
        arrButtons[3].classList.add('main-buttons-item-active');
    }

    else if (window.location.href.includes("/services/lists/?mode=view&list_id=64&section_id=0&list_section_id=")) {
        arrButtons.forEach((item, index) => {
            item.classList.remove('main-buttons-item-active');
        });
        arrButtons[4].classList.add('main-buttons-item-active');
    }
    });

</script>

