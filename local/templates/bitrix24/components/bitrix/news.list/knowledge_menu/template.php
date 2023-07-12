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
<div class="menu">
	<div class="menu-container">
		<ul class="menu-nav">
			<? foreach ($arResult['ITEMS'] as $arItem) : ?>
				<li class="menu-link"><a href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>"><?= $arItem['NAME'] ?></a></li>
			<? endforeach; ?>
		</ul>
	</div>
</div>