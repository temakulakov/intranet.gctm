<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$cp = $this->__component; // объект компонента

if (is_object($cp)) {
    foreach ($cp->arResult['ELEMENTS_ROWS'] as $key => $value) {
        $cp->arResult['ELEMENTS_ROWS'][$key]['columns']['PROPERTY_280'] = preg_replace('~\(.+\)~s', '', $cp->arResult['ELEMENTS_ROWS'][$key]['columns']['PROPERTY_280']);
        $cp->arResult['ELEMENTS_ROWS'][$key]['columns']['PROPERTY_293'] = preg_replace('~\(.+\)~s', '', $cp->arResult['ELEMENTS_ROWS'][$key]['columns']['PROPERTY_293']);
    }
}

if (str_contains( $_SERVER['REQUEST_URI'], "/komandirovki/")) {
    foreach ($cp->arResult['ELEMENTS_ROWS'] as $key => $value) {
        preg_match_all("/\d+/", $cp->arResult['ELEMENTS_ROWS'][$key]['columns']['PROPERTY_293'], $matches);
        if ($matches[0][0] != $USER->GetID()) {
            unset($cp->arResult['ELEMENTS_ROWS'][$key]);
        }
    }
}

?>

<?php

// Удаление из фильтров, заголовков и непосредственно массивов информации о начальнике

unset($cp->arResult['ELEMENTS_HEADERS'][2]); //[8]
unset($cp->arResult['FILTER'][3]); //[9]
foreach ($arResult['ELEMENTS_ROWS'] as $key => $value) {
    unset($cp->arResult['ELEMENTS_ROWS'][$key]['columns']['PROPERTY_280']);
}
?>


<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!empty($arResult["ELEMENTS_ROWS"]))
{
    foreach ($arResult['ELEMENTS_ROWS'] as $key => $value) {

    }
    foreach ($arResult["ELEMENTS_ROWS"] as $key => &$row)
    {
        if (!empty($row["actions"]))
        {
            foreach($row["actions"] as &$action)
            {
                if (isset($action['ID']) && $action["ID"] == "delete")
                {
                    $action["ONCLICK"] = "javascript:BX.Lists['".$arResult['JS_OBJECT']."'].deleteElement('".
                        $arResult["GRID_ID"]."', '".$row["id"]."')";
                }
            }
        }
    }
}