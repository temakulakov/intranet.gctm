<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<?if (!str_contains($_SERVER["REQUEST_URI"], "/tasks/")):?>
<div class="section_menu">
    <?
    $cUser = $USER->GetID();

    // Удаляю стандартные ссылки и оставляю лишь те, что добавлены вручную:

    if ($arResult[0]['TEXT'] == 'Структура компании') {
        $selectedItem = 0;
        switch ($_SERVER["REQUEST_URI"]) {
            case '/company/vis_structure.php':
                $selectedItem = 0;
                break;
            case '/company/':
                $selectedItem = 1;
                break;
        }

        // Установка активного элемента меню Сотрудники:
        for ($i = 0; $i < count($arResult); $i++) {
            $arResult[$i]['SELECTED'] = 0;
            if ($i == $selectedItem) {
                $arResult[$i]['SELECTED'] = 1;
            }

        }
    }

    if ($arResult[0]['TEXT'] == 'Оформление заявки') {
        if (
            in_array(1, $USER->GetUserGroupArray()) or  // Администраторы
            in_array(9, $USER->GetUserGroupArray()) or  // Отдел кадров
            in_array(10, $USER->GetUserGroupArray()) or // Руководство
            in_array(18, $USER->GetUserGroupArray())    // Служба безопасности
        ) {
            $ruccal = [
                'TEXT' => 'Журнал учета',
                'LINK' => 'https://intranet.gctm.ru/services/lists/?mode=view&list_id=64&section_id=0&list_section_id=',
                'PERMISSION' => 'X'
            ];
            array_push($arResult, $ruccal);
        }

        $selectedItem = 2;

        // Костыльная логика для указания активного элемента меню Журнал учета и удаление активности у последующих элементов:
        switch ($_SERVER["REQUEST_URI"]) {
            case '/services/lists/?mode=edit&list_id=64&section_id=0&element_id=0&list_section_id=':
                $selectedItem = 0;
                break;
            case '/komandirovki/':
                $selectedItem = 1;
                break;
            case '/company/personal/bizproc/':
                $selectedItem = 2;
                break;
            case '/komandirovki/history.php':
                $selectedItem = 3;
                break;
            case '/services/lists/?mode=view&list_id=64&section_id=0&list_section_id=':
                $selectedItem = 4;
                break;
        }

        // Установка активного элемента меню Журнале учета:
        for ($i = 0; $i < count($arResult); $i++) {
            $arResult[$i]['SELECTED'] = 0;
            if ($i == $selectedItem) {
                $arResult[$i]['SELECTED'] = 1;
            }

        }
    }

    if ($arResult[0]['TEXT'] == 'Мой календарь') {
        $arResult[0]['LINK'] = '/calendar/my_calendar.php';
        if (
            $cUser == 1552 or
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

        $selectedItem = 0;

        switch ($_SERVER["REQUEST_URI"]) {
            case '/calendar/my_calendar.php':
                $selectedItem = 0;
                break;
            case '/calendar/':
                $selectedItem = 1;
                break;
            case '/calendar/rooms/':
                $selectedItem = 2;
                break;
        }

        for ($i = 0; $i < count($arResult); $i++) {
            $arResult[$i]['SELECTED'] = 0;
            if ($i == $selectedItem) {
                $arResult[$i]['SELECTED'] = 1;
            }

        }
    }

    ?>
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a>
	<?else:?>
		<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
	<?endif?>
	
<?endforeach?>

</div>
<?endif?>
<?endif?>