<?
if (!empty($arResult['PROPERTIES']['VIEW_MORE']['VALUE'])) {
    $rsElement = CIBlockElement::GetList(
        array("SORT" => "ASC"),
        array(
            "ACTIVE"    => "Y",
            "ID" => $arResult['PROPERTIES']['VIEW_MORE']['VALUE']
        ),
        false,
        false,
        array("ID", "NAME", "PREVIEW_TEXT", "PROPERTY_URL")
    );
    while ($arElement = $rsElement->fetch()) {
        $temp = [];
        $temp['NAME'] = $arElement['NAME'];
        $temp['TEXT'] = $arElement['PREVIEW_TEXT'];
        $temp['URL'] = $arElement['PROPERTY_URL_VALUE'];
        $arResult['VIEW_MORE'][] = $temp;
    }
    unset($temp);
}
