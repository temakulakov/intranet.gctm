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

<section class="content">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1><?= $arResult['NAME'] ?></h1>
		<? if ($arResult['DETAIL_PICTURE']['SRC']) : ?>
			<img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" class="sample-img">
		<? endif; ?>
		<?= $arResult['~DETAIL_TEXT'] ?>
	</div>
</section>