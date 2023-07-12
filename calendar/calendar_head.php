<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/about/calendar.php");
$APPLICATION->SetTitle('Календарь руководителей');
?>
<?

/*<iframe id="hc-frame" src="https://calendar.google.com/calendar/u/0/r/day?pli=1" style="height: 1080px; width: 99%; ">
    </iframe>*/
$calendar = file_get_contents('https://calendar.google.com/calendar/u/0/r/day?pli=1');

?>
    <iframe id="hc-frame" src="https://calendar.google.com/calendar/u/0/r/day?pli=1" style="height: 1080px; width: 99%; ">
    </iframe>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>