<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<section class="hotline">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1>Горячая линия</h1>
		<p class="text-bg"><? echo CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "DESCRIPTION"); ?></p>
		<div class="hotline__tiles">
			<? foreach ($arResult['ITEMS'] as $arItem) : ?>
				<div class="hotline__tile tile">
					<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">
					<div class="tile-block"><div class="tile-title"><?= $arItem['NAME'] ?></div>
					<p><?= $arItem['PREVIEW_TEXT'] ?></p></div>
					<a href="#" class="hotline__btn <?= $arItem['PROPERTIES']['FORM_TYPE']['VALUE_XML_ID'] ?> btn" data-form="<?= $arItem['PROPERTIES']['FORM_TYPE']['VALUE_XML_ID'] ?>" data-recipient="<?= $arItem['PROPERTIES']['EMAIL']['VALUE'] ?>"><?= $arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'] ?></a>
				</div>
			<? endforeach; ?>
		</div>
	</div>
</section>