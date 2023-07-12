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

<section class="intro">
	<div class="container">
		<div class="intro__row">
			<? foreach ($arResult['PROPERTIES']['ICONS_TOP']['VALUE'] as $iconId) : ?>
				<img class="intro__img" src="<?= CFile::GetPath($iconId); ?>" alt="">
			<? endforeach; ?>
		</div>
		<div class="intro__content">
			<div class="intro__column">
				<? foreach ($arResult['PROPERTIES']['ICONS_LEFT']['VALUE'] as $iconId) : ?>
					<img class="intro__img" src="<?= CFile::GetPath($iconId); ?>" alt="">
				<? endforeach; ?>
			</div>
			<div class="intro__center">
				<h1>Привет!
					<br>
					Это база знаний
					<br> Бахрушинского музея
				</h1>
				<div class="intro__text">
					<?= $arResult['PREVIEW_TEXT'] ?>
				</div>
				<a href="/knowledgebase/start/" class="intro__btn btn"><? echo !empty($arResult['PROPERTIES']['BUTTON_TEXT']['VALUE']) ? $arResult['PROPERTIES']['BUTTON_TEXT']['VALUE'] : 'Войти в базу знаний'; ?></a>
			</div>
			<div class="intro__column">
				<? foreach ($arResult['PROPERTIES']['ICONS_RIGHT']['VALUE'] as $iconId) : ?>
					<img class="intro__img" src="<?= CFile::GetPath($iconId); ?>" alt="">
				<? endforeach; ?>
			</div>
		</div>
		<div class="intro__row">
			<? foreach ($arResult['PROPERTIES']['ICONS_BOTTOM']['VALUE'] as $iconId) : ?>
				<img class="intro__img" src="<?= CFile::GetPath($iconId); ?>" alt="">
			<? endforeach; ?>
		</div>
	</div>
</section>