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

<section class="about">
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1>О музее</h1>
		<div class="about__row">
			<div class="about__row-img">
				<img src="<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>" alt="">
			</div>
			<div class="about__row-text">
				<h2>Наша миссия</h2>
				<p class="text-bg">
					<?= $arResult['PREVIEW_TEXT'] ?>
				</p> 
			</div>
			

		</div>
		
		<div class="moreLinkWrap">
				<a class="linkMoreInfo" >
					
				<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1 1H29M29 1V29M29 1L1 29" stroke="#111111" stroke-width="2"></path>
					</svg>	
				</a>
		</div>
			
	</div>
	

	
	<? if (!empty($arResult['PROPERTIES']['VALUES']['VALUE'])) : ?>
		<div  class="container values">
			<div class="about__row values">
				<h2>Ценности музея</h2>
				<ul class="values__list">
					<? foreach ($arResult['PROPERTIES']['VALUES']['VALUE'] as $value) : ?>
						<li><?= $value ?></li>
					<? endforeach; ?>
				</ul>
			</div>
		</div>
	<? endif; ?>
	<? if (!empty($arResult['VIEW_MORE'])) : ?>
		<div class="container">
			<div class="about__row links">
				<h2>Смотрите также</h2>
				<div class="about__row-wrapper">
					<? foreach ($arResult['VIEW_MORE'] as $item) : ?>
						<div class="tile-link">
							<a href="<?= $item['URL'] ?>">
								<div class="tile-link__wrapper">
									<div class="tile-link__title"><?= $item['NAME'] ?></div>
									<?= $item['TEXT'] ?>
								</div>
								<div class="tile-link__arrow">
									<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1 1H29M29 1V29M29 1L1 29" stroke="#111111" stroke-width="2" />
									</svg>
								</div>
							</a>
						</div>
					<? endforeach; ?>
				</div>
			</div>
		</div>
	<? endif; ?>
</section>