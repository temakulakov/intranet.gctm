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
		<h1>Информация отделов</h1>
		<p class="text-bg"><? echo CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "DESCRIPTION"); ?></p>
		<div class="info__wrapper">
			<? foreach ($arResult['SECTIONS'] as $arSection) : ?>
				<div class="info__link">
					<a href="<?= $arSection['SECTION_PAGE_URL'] ?>">
						<?= $arSection['~UF_SVG_ICON'] ?>
						<div class="info__link-title">
							<?= $arSection['NAME'] ?>
						</div>
						<div class="info__link-text">
							<?= $arSection['DESCRIPTION'] ?>
						</div>
					</a>
				</div>
			<? endforeach; ?>
		</div>
	</div>
</section>