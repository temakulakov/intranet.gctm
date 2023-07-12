<?
if ($arResult['PROPERTIES']['REASONS']['VALUE']) {
    $rsElement = CIBlockElement::GetList(
        array("SORT" => "ASC"),
        array(
            "ACTIVE"    => "Y",
            "ID" => $arResult['PROPERTIES']['REASONS']['VALUE']
        ),
        false,
        false,
        array("ID", "NAME", "PREVIEW_PICTURE")
    );
    while ($arElement = $rsElement->fetch()) {
        $temp = [];
        $temp['NAME'] = $arElement['NAME'];
        $temp['PICTURE'] = CFile::GetPath($arElement['PREVIEW_PICTURE']);
        $arResult['REASONS'][] = $temp;
    }
}
