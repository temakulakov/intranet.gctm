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
<section class="guide">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1>Инструкция для нового сотрудника</h1>
		<p class="text-bg">
			<? echo CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "DESCRIPTION"); ?>
		</p>
		<h3>Инструкция состоит из <?= count($arResult['ITEMS']); ?> простых этапов:</h3>
		<div class="guide__steps">
			<? foreach ($arResult['ITEMS'] as $arItem) : ?>
				<div class="guide__step step">
					<div class="step__title"><?= $arItem['NAME'] ?></div>
					<div class="step__text"><?= $arItem['PREVIEW_TEXT'] ?></div>
					<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="step__button" <? if ($arItem['CODE'] == 'pismo-hr-spetsialistu') : ?>data-form="hr" data-recipient="<?= $arItem['PROPERTIES']['EMAIL']['VALUE']; ?>" <? endif; ?>>
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_501_21027)">
								<path d="M2.25 14.25C3.27613 13.6576 4.44013 13.3457 5.625 13.3457C6.80987 13.3457 7.97387 13.6576 9 14.25C10.0261 13.6576 11.1901 13.3457 12.375 13.3457C13.5599 13.3457 14.7239 13.6576 15.75 14.25" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M2.25 4.50003C3.27613 3.9076 4.44013 3.5957 5.625 3.5957C6.80987 3.5957 7.97387 3.9076 9 4.50003C10.0261 3.9076 11.1901 3.5957 12.375 3.5957C13.5599 3.5957 14.7239 3.9076 15.75 4.50003" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M2.25 4.5V14.25" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M9 4.5V14.25" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M15.75 4.5V14.25" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</g>
							<defs>
								<clipPath id="clip0_501_21027">
									<rect width="18" height="18" fill="white" />
								</clipPath>
							</defs>
						</svg>
						<? echo ($arItem['PROPERTIES']['BUTTON_TEXT']['VALUE']) ? $arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'] : 'Читать'; ?>
					</a>
				</div>
			<? endforeach; ?>
		</div>
	</div>
</section>