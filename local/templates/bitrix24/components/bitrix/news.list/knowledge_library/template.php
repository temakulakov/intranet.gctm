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

<section class="library">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1>Библиотека</h1>
		<div class="library__wrapper">
			<? $key = 1;
			foreach ($arResult['ITEMS'] as $arSection) : ?>
				<div class="library__row">
					<div class="library__row-title">
						<span><?= $key ?></span> <?= $arSection['NAME'] ?>
					</div>
					<div class="library__row-wrapper">
						<? foreach ($arSection['ITEMS'] as $arItem) :
							if ($arItem['PROPERTIES']['BOOK']['VALUE']) {
								$url = CFile::GetPath($arItem['PROPERTIES']['BOOK']['VALUE']);
							} elseif ($arItem['PROPERTIES']['URL']['VALUE']) {
								$url = $arItem['PROPERTIES']['URL']['VALUE'];
							} else {
								$url = '#';
							}
						?>
							<div class="library__book book">
								<a href="<?= $url ?>" target="_blank">
									<div class="book__img">
										<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">
									</div>
									<div class="book__name"><?= $arItem['NAME'] ?></div>
									<div class="book__author"><?= $arItem['PROPERTIES']['AUTHOR']['VALUE'] ?></div>
								</a>
							</div>
						<? endforeach; ?>
					</div>
				</div>
			<? $key++;
			endforeach; ?>
		</div>
	</div>
</section>