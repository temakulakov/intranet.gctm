<?
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "OnBeforeIBlockElementAddHandler");

function OnBeforeIBlockElementAddHandler(&$arFields)
{
    if ($arFields['IBLOCK_ID'] == 16) {
        $previewText = $arFields['PREVIEW_TEXT'];
        $pos1 = strpos($previewText, '<image>');
        $pos2 = strpos($previewText, '</image>');
        $str1 = substr($previewText, 0, $pos1);
        $str2 = substr($previewText, $pos2 + 8);
        $imageStr = substr($previewText, $pos1, $pos2 + 8);
        $previewText = $str1 . $str2;

        $pos1 = strrpos($previewText, '<p>');
        $previewText = substr($previewText, 0, $pos1);
        $arFields['PREVIEW_TEXT'] = $previewText;

        $pos1 = strpos($imageStr, 'src="');
        $pos2 = strpos($imageStr, '"', $pos1 + 5);
        $imageUrl = substr($imageStr, $pos1 + 5, $pos2 - $pos1 - 5);
        $image = CFile::MakeFileArray($imageUrl);
        $arFields['PREVIEW_PICTURE'] = $image;

        $detailText = $arFields['DETAIL_TEXT'];
        $pos1 = strpos($detailText, '<image>');
        $pos2 = strpos($detailText, '</image>');
        $str1 = substr($detailText, 0, $pos1);
        $str2 = substr($detailText, $pos2 + 8);
        $detailText = $str1 . $str2;

        $pos1 = strrpos($detailText, '<p>');
        $detailText = substr($detailText, 0, $pos1);
        $arFields['DETAIL_TEXT'] = $detailText;
    }
}
