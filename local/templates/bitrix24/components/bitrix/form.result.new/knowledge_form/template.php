<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="popup <?= $arParams['CLASS'] ?>" data-type="<?= $arParams['CLASS'] ?>">
	<a href="" class="popup-close-btn">
		<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M25 1L1.00011 24.9999" stroke="#111111" stroke-width="2" />
			<path d="M25 25L1.00011 1.00011" stroke="#111111" stroke-width="2" />
		</svg>
	</a>
	<div class="popup__title"><?= $arResult['arForm']['NAME'] ?></div>
	<form name="<?= $arResult["WEB_FORM_NAME"] ?>" action="<?= POST_FORM_ACTION_URI ?>" method="POST" enctype="multipart/form-data" class="form" novalidate="novalidate" data-id="<?= $arResult['arForm']['ID'] ?>">
		<input type="hidden" name="WEB_FORM_ID" value="<?= $arParams["WEB_FORM_ID"] ?>">
		<input type="hidden" name="web_form_submit" value="Y">
		<?= bitrix_sessid_post() ?>
		<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) : ?>
			<?= $arResult['funcGetInputHtml']($arQuestion, $arResult['arrVALUES'], $FIELD_SID) ?>
		<? endforeach; ?>
		<ul class="files-list">
		</ul>
		<div class="form__item">
			<button class="btn" type="submit" value="<?= $arResult["arForm"]["BUTTON"] ?>"><?= $arResult["arForm"]["BUTTON"] ?></button>
		</div>
	</form>
</div>

<?
/*if ($arResult["isUseCaptcha"] == "Y") {
?>
	<tr>
		<th colspan="2"><b><?= GetMessage("FORM_CAPTCHA_TABLE_TITLE") ?></b></th>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" width="180" height="40" /></td>
	</tr>
	<tr>
		<td><?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?><?= $arResult["REQUIRED_SIGN"]; ?></td>
		<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
	</tr>
<?
} // isUseCaptcha
*/
?>