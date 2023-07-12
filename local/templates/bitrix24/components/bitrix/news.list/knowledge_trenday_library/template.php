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
<section class="menu-page">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1>Трендельники и библиотека</h1>
		<div class="menu-page__tiles">
			<? foreach ($arResult['ITEMS'] as $arItem) : ?>
				<div class="menu-page__tile tile">
					<a href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>">
						<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">
						<div class="tile-title"><?= $arItem['NAME'] ?></div>
						<?= $arItem['~PREVIEW_TEXT'] ?>
					</a>
				</div>
			<? endforeach; ?>
		</div>
	</div>
</section>