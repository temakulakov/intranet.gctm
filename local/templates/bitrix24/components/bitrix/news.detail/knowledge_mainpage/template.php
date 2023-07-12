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
<section class="main">
	<div class="container">
		<h1>Главная страница</h1>
		<a href="" class="main__btn btn"><?= ($arResult['PROPERTIES']['BUTTON_TEXT']['VALUE']) ? $arResult['PROPERTIES']['BUTTON_TEXT']['VALUE'] : 'Добро пожаловать в базу знаний музея!'; ?></a>
		<p class="main__hint">Нажми чтобы попасть в быстрое меню</p>
		<div class="main__text">
			<?= $arResult['~PREVIEW_TEXT']; ?>
		</div>
		<? if ($arResult['REASONS']) : ?>
			<h3>Мы создали ее для того, чтобы:</h3>
			<div class="main__row">
				<? foreach ($arResult['REASONS'] as $reason) : ?>
					<div class="main__column tile">
						<img src="<?= $reason['PICTURE'] ?>" alt="">
						<div class="tile-title"><?= $reason['NAME'] ?></div>
					</div>
				<? endforeach; ?>
			</div>
		<? endif; ?>
	</div>
</section>