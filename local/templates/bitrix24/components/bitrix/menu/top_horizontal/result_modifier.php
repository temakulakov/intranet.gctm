<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

if (!is_array($arResult) || empty($arResult))
{
	return;
}

// Костыль для выборки элементов шапки в сервисе журнала учета выездов


// Массив элементов шапки в сервисе журнала учета выездов

$journalItems = array (
    0 =>
        array (
            'TEXT' => 'Оформление заявки',
            'LINK' => 'https://intranet.gctm.ru/services/lists/?mode=edit&list_id=64§ion_id=0&element_id=0&list_section_id=',
            'SELECTED' => NULL,
            'PERMISSION' => 'Z',
            'ADDITIONAL_LINKS' =>
                array (

                ),
            'ITEM_TYPE' => 'U',
            'ITEM_INDEX' => 0,
            'PARAMS' =>
                array (
                    'menu_item_id' => 4265986112,
                    'class' => NULL,
                ),
            'CHAIN' =>
                array (
                    0 => 'Оформление заявки',
                ),
            'DEPTH_LEVEL' => 1,
            'IS_PARENT' => NULL,
        ),
    1 =>
        array (
            'TEXT' => 'Ваши заявки',
            'LINK' => '/komandirovki/',
            'SELECTED' => NULL,
            'PERMISSION' => 'X',
            'ADDITIONAL_LINKS' =>
                array (
                ),
            'ITEM_TYPE' => 'D',
            'ITEM_INDEX' => 1,
            'PARAMS' =>
                array (
                    'menu_item_id' => 3393982525,
                    'class' => NULL,
                ),
            'CHAIN' =>
                array (
                    0 => 'Ваши заявки',
                ),
            'DEPTH_LEVEL' => 1,
            'IS_PARENT' => NULL,
        ),
    2 =>
        array (
            'TEXT' => 'Согласование заявок',
            'LINK' => 'https://intranet.gctm.ru/company/personal/bizproc/',
            'SELECTED' => NULL,
            'PERMISSION' => 'Z',
            'ADDITIONAL_LINKS' =>
                array (
                ),
            'ITEM_TYPE' => 'D',
            'ITEM_INDEX' => 2,
            'PARAMS' =>
                array (
                    'menu_item_id' => 4201682415,
                    'class' => NULL,
                ),
            'CHAIN' =>
                array (
                    0 => 'Согласование заявок',
                ),
            'DEPTH_LEVEL' => 1,
            'IS_PARENT' => NULL,
        ),
    3 =>
        array (
            'TEXT' => 'Журнал учета',
            'LINK' => 'https://intranet.gctm.ru/services/lists/?mode=view&list_id=64§ion_id=0&list_section_id=',
            'SELECTED' => NULL,
            'PERMISSION' => 'Z',
            'ADDITIONAL_LINKS' =>
                array (
                ),
            'ITEM_TYPE' => 'U',
            'ITEM_INDEX' => 3,
            'PARAMS' =>
                array (
                    'menu_item_id' => 2954258152,
                    'class' => NULL,
                ),
            'CHAIN' =>
                array (
                    0 => 'Журнал учета',
                ),
            'DEPTH_LEVEL' => 1,
            'IS_PARENT' => NULL,
        ),
    4 =>
        array (
            'TEXT' => 'История согласований',
            'LINK' => '/komandirovki/history.php',
            'SELECTED' => NULL,
            'PERMISSION' => 'X',
            'ADDITIONAL_LINKS' =>
                array (
                ),
            'ITEM_TYPE' => 'P',
            'ITEM_INDEX' => 4,
            'PARAMS' =>
                array (
                    'menu_item_id' => 2083362808,
                    'class' => NULL,
                ),
            'CHAIN' =>
                array (
                    0 => 'История согласований',
                ),
            'DEPTH_LEVEL' => 1,
            'IS_PARENT' => NULL,
        ),
);
$arResult = array();
$arResult = $journalItems;

foreach ($journalItems as &$item)
{
	$item["PARAMS"] = $item["PARAMS"] ?? [];
	// id to item
	if (empty($item["PARAMS"]["menu_item_id"]))
	{
		$item["PARAMS"]["menu_item_id"] = ($item["PARAMS"]["name"] == "live_feed") ? "menu_live_feed"
			: crc32($item["LINK"]);
	}
	$item["PARAMS"]["class"] = isset($item["PARAMS"]["class"]) ? $item["PARAMS"]["class"] : "";
}

