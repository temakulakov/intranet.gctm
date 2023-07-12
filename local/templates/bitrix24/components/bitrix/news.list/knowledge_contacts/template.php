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
<section class="contacts">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1><? $APPLICATION->ShowTitle(false); ?></h1>
		<div class="contacts__wrapper">
			<? foreach ($arResult['ITEMS'] as $arItem) : ?>
				<div class="contacts__item">
					<div class="contacts__item-img">
						<img src="<?= ($arItem['PREVIEW_PICTURE']['SRC']) ? $arItem['PREVIEW_PICTURE']['SRC'] : $templateFolder . '/images/no-photo.png'; ?>" alt="">
					</div>
					<div class="contacts__item-content">
						<span class="work-position"><?= $arItem['PROPERTIES']['POST']['VALUE'] ?></span>
						<div class="contacts__item-name"><?= $arItem['NAME'] ?></div>
						<? if ($arItem['PREVIEW_TEXT']) : ?>
						
						<p class="contacts__item-title"><?=($arItem['NAME'] == "Трубинова Кристина Дмитриевна") ? "Приветственное слово" : "Курирует деятельность:"?></p>
							<div class="contacts__item-speach">
								<?= $arItem['~PREVIEW_TEXT'] ?>
							</div>
						<? endif; ?>
						<? if ($arItem['PROPERTIES']['TELEGRAM']['VALUE']) : ?>
							<p class="contacts__item-title">Телеграм</p>
							<a class="telegram-link" href="<?= $arItem['PROPERTIES']['TELEGRAM']['VALUE'] ?>">
								<img src="<?= SITE_TEMPLATE_PATH ?>/images/Telegram.svg" alt="">
							</a>
						<? endif; ?>
						
						
			
						<? if ($arItem['PROPERTIES']['PHONE']['VALUE']) : ?>
							<p class="contacts__item-title">Телефон</p>
							
							<a class="addphone-link" href="callto:<?= $arItem['PROPERTIES']['PHONE']['VALUE'] ?>" onclick="if(typeof(top.BXIM) !== 'undefined') { top.BXIM.phoneTo('<?= $arItem['PROPERTIES']['PHONE']['VALUE'] ?>', {}); }">
								<img src="<?= SITE_TEMPLATE_PATH ?>/images/add_phone.svg" alt="">
								<?= $arItem['PROPERTIES']['PHONE']['VALUE'] ?>
							</a>
						<? endif; ?>
						
						
						<? if ($arItem['PROPERTIES']['EMAIL']['VALUE']) : ?>
							<p class="contacts__item-title">Почта</p>
							<a class="email-link" href="mailto:<?= $arItem['PROPERTIES']['EMAIL']['VALUE'] ?>"><?= $arItem['PROPERTIES']['EMAIL']['VALUE'] ?></a>
							<a href="#" class="contacts__item-btn btn" data-form="appeal" data-recipient="<?= $arItem['PROPERTIES']['EMAIL']['VALUE']; ?>">Направить обращение</a>
						<? endif; ?>
						
						
						
						
						
					</div>
				</div>
			<? endforeach; ?>
		</div>
	</div>
</section>