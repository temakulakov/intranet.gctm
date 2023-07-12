<?
$result = [];

foreach ($arResult['ITEMS'] as $arItem) {
    if (!isset($result[$arItem['IBLOCK_SECTION_ID']])) {
        $arSection = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID'])->fetch();
        if (is_array($arSection)) {
            $result[$arItem['IBLOCK_SECTION_ID']]['NAME'] = $arSection['NAME'];
        }
    }
    $result[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
}

$arResult['ITEMS'] = $result;
