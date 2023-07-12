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
<section class="info">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1><?= $APPLICATION->ShowTitle(false); ?></h1>
		<p class="text-bg"><? echo CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "DESCRIPTION"); ?></p>
		<div class="info__wrapper">
			<? foreach ($arResult['ITEMS'] as $arItem) : ?>

					<a class="info__link" href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ? $arItem['PROPERTIES']['URL']['VALUE'] : $arItem['PROPERTIES']['URL']['VALUE']; ?>">
						<? echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($arItem['PROPERTIES']['ICON']['VALUE'])); ?>
						<div class="info__link-title">
							<?= $arItem['NAME'] ?>
						</div>
						<? if ($arItem['PREVIEW_TEXT']) : ?>
							<div class="info__link-text">
								
								<?= $arItem['PREVIEW_TEXT'] ?>

							</div>
						<? endif; ?>
					</a>
				
			<? endforeach; ?>
		</div>
	</div>
</section>