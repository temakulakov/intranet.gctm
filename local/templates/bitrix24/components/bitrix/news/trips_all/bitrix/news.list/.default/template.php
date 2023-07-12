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
$isAjax = ($_REQUEST['AJAX'] == 'Y') ? true : false;
?>

<section class="publications">
	<div class="container">
		<!-- <a href="" class="previous-page-btn"><img src="" alt="">← Вернуться</a> -->
		<h1><? $APPLICATION->ShowTitle(false); ?></h1>
		<? if ($isAjax) : ?>
			<? $APPLICATION->RestartBuffer(); ?>
		<? endif; ?>
		<div class="publications__wrapper">
			<? foreach ($arResult["ITEMS"] as $arItem) : ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="publications__row" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<a href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ? $arItem['PROPERTIES']['URL']['VALUE'] : $arItem['DETAIL_PAGE_URL'] ?>" target="_blank">
						<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) : ?>
							<div class="publications__img">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">
							</div>
						<? endif; ?>
						<div class="publications__text">
							<? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]) : ?>
								<div class="publications__date">
									<? echo $arItem["DISPLAY_ACTIVE_FROM"] ?>
								</div>
							<? endif; ?>
							<div class="publications__title"><?= $arItem['NAME'] ?></div>
							<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) : ?>
								<div class="publications__subtitle">
									<? echo strip_tags($arItem["PREVIEW_TEXT"], '<p>'); ?>
								</div>
							<? endif; ?>
							<img class="publications__arrow" src="<?= $templateFolder ?>/images/publications-arrow.svg" alt="">
						</div>
					</a>
				</div>
			<? endforeach; ?>
		</div>
		<? if ($arResult['NAV_RESULT']->NavPageNomer < $arResult['NAV_RESULT']->NavPageCount) : ?>
			<div class="publications__button">
				<a href="#" class="publications__btn btn" data-page="<?= $APPLICATION->GetCurPage() . '?PAGEN_1=' . ($arResult['NAV_RESULT']->NavPageNomer + 1) ?>">Смотреть еще</a>
			</div>
		<? endif; ?>
		<? if ($isAjax) : ?>
			<? die(); ?>
		<? endif; ?>
	</div>
</section>

<?/*
<div class="news-list">
	<? if ($arParams["DISPLAY_TOP_PAGER"]) : ?>
		<?= $arResult["NAV_STRING"] ?><br />
	<? endif; ?>
	<? foreach ($arResult["ITEMS"] as $arItem) : ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="news-item-custom">
			<p class="news-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) : ?>
					<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) : ?>
						<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img class="preview_picture" border="0" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" style="float:left" /></a>
					<? else : ?>
						<img class="preview_picture" border="0" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" style="float:left" />
					<? endif; ?>
				<? endif ?>
				<? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]) : ?>
					<span class="news-date-time"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
				<? endif ?>
				<? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]) : ?>
					<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) : ?>
						<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><b><? echo $arItem["NAME"] ?></b></a><br />
					<? else : ?>
						<b><? echo $arItem["NAME"] ?></b><br />
					<? endif; ?>
				<? endif; ?>
				<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) : ?>
					<? echo $arItem["PREVIEW_TEXT"]; ?>
				<? endif; ?>
				<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) : ?>
			<div style="clear:both"></div>
		<? endif ?>
		<? foreach ($arItem["FIELDS"] as $code => $value) : ?>
			<small>
				<?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
			</small><br />
		<? endforeach; ?>
		<? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty) : ?>
			<small>
				<?= $arProperty["NAME"] ?>:&nbsp;
				<? if (is_array($arProperty["DISPLAY_VALUE"])) : ?>
					<?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
				<? else : ?>
					<?= $arProperty["DISPLAY_VALUE"]; ?>
				<? endif ?>
			</small><br />
		<? endforeach; ?>
		</p>
		<hr class="hr-line">
		</div>
	<? endforeach; ?>
	<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
		<br /><?= $arResult["NAV_STRING"] ?>
	<? endif; ?>
</div>
*/ ?>