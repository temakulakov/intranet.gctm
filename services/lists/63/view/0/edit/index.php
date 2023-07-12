<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>

<?$APPLICATION->IncludeComponent("bitrix:lists.list.edit","",Array(
        "IBLOCK_TYPE_ID" => "lists",
        "IBLOCK_ID" => "12",
        "LISTS_URL" => "lists.lists.php",
        "LIST_URL" => "lists.list.php?list_id=#list_id#",
        "LIST_EDIT_URL" => "lists.list.edit.php?list_id=#list_id#",
        "LIST_FIELDS_URL" => "lists.fields.php?list_id=#list_id#",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600"
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
