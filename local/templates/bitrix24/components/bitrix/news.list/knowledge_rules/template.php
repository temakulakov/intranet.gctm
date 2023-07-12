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

<section class="museum-rules">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1>Основные правила жизни в музее</h1>
		<div class="museum-rules__tiles">
			<? foreach ($arResult['ITEMS'] as $arItem) : ?>
				<a class="museum-rules__tile tile" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
					<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">
					<div class="tile-title"><?= $arItem['NAME'] ?></div>
					<p><?= $arItem['PREVIEW_TEXT'] ?></p>
				</a>
			<? endforeach; ?>
		</div>
	</div>
</section>