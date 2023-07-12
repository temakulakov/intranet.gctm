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
<section class="albums">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1>
			Фотографии с наших мероприятий
		</h1>
		<div class="albums__wrapper">
			<? foreach ($arResult['ITEMS'] as $arItem) : ?>
				<div class="albums__item">
					<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
						<div class="albums__img">
							<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">
						</div>
						<div class="albums__title">
							<?= $arItem['NAME'] ?>
						</div>
						<div class="albums__date">
							<?= $arItem['PROPERTIES']['DATE']['VALUE'] ?>
						</div>
					</a>
				</div>
			<? endforeach; ?>
		</div>
	</div>
</section>