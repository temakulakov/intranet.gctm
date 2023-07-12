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

<section class="learning">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1>Обучающие материалы</h1>
		<p class="text-bg"><? echo CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "DESCRIPTION"); ?></p>
		<div class="learning__img">
			<img src="<? echo CFile::GetPath(CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "PICTURE")); ?>" alt="">
		</div>
		<div class="learning__materials">
			<? foreach ($arResult['ITEMS'] as $arItem) : ?>
				<div class="learning__materials-item material">
					<div class="material__logo">
						<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">
					</div>
					<div class="material__title">
						<?= $arItem['NAME'] ?>
					</div>
					<div class="material__text">
						<?= $arItem['PREVIEW_TEXT'] ?>
					</div>
					<a href="<?= ($arItem['PROPERTIES']['PRESENTATION_URL']['VALUE']) ? $arItem['PROPERTIES']['PRESENTATION_URL']['VALUE'] : CFile::GetPath($arItem['PROPERTIES']['PRESENTATION']['VALUE']); ?>" class="material__btn btn">
						<? echo $arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'] ? $arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'] : 'Смотреть презентацию'; ?>
					</a>
				</div>
			<? endforeach; ?>
		</div>
		<div class="showall">
			<a href="<?= $arParams['SHOW_ALL_URL']; ?>">Смотреть все матриалы</a>
		</div>
	</div>
</section>