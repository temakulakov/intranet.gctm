<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI;

UI\Extension::load("ui.tooltip");

$arUser = is_array($arParams['~USER']) ? $arParams['~USER'] : array();
$name = CUser::FormatName($arParams['NAME_TEMPLATE'], $arUser, $arResult["bUseLogin"]);

$arParams['USER_PROP']['UF_USR_1683828500926'] = 'Внутренний номер сотрудника';
unset($arParams['USER_PROP']['UF_PHONE_INNER']);

$arUserData = array();
if (is_array($arParams['USER_PROPERTY'])) {
	foreach ($arParams['USER_PROPERTY'] as $key) {
		if ($arUser[$key])
            if ($key == 'UF_PHONE_INNER') {
                $arUserData['UF_USR_1683828500926'] = $arUser['UF_USR_1683828500926'];
            } else {
                $arUserData[$key] = $arUser[$key];
            }
	}
}

if (!defined('INTRANET_ISP_MUL_INCLUDED')) :
	$APPLICATION->IncludeComponent(
		"bitrix:main.user.link",
		'',
		array(
			"AJAX_ONLY" => "Y",
			"PATH_TO_SONET_USER_PROFILE" => COption::GetOptionString('intranet', 'search_user_url', '/company/personal/user/#ID#/'),
			"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["PM_URL"],
			"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
			"SHOW_YEAR" => $arParams["SHOW_YEAR"],
			"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
			"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
			"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
			"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
		),
		false,
		array("HIDE_ICONS" => "Y")
	);

	define('INTRANET_ISP_MUL_INCLUDED', 1);
endif;
?>



<div class="itemUser">

		<?
		if ($arUser['SUBTITLE']) :
		?>


            <div class="userPic">



                <?

                if ($arResult['CAN_VIEW_PROFILE']) {
                ?>

                <a href="<? echo $arUser['DETAIL_URL'] ?>">
                    <?
                    }
                    if ($arUser['PERSONAL_PHOTO']) {
                        echo $arUser['PERSONAL_PHOTO'];
                    }
                    elseif (!$arUser['PERSONAL_PHOTO']) {
                        echo '<img src="/upload/medialibrary/4c1/lb9pai263hkaio05q1dd71xo6sm4s8lm/person.png" alt="no photo">';
                    }

                    if ($arResult['CAN_VIEW_PROFILE']) {
                    ?>
                </a>
            <?
            }

            ?>


            </div>










            <div class="wrapText">

                <div class="userName">
                    <a href="<? echo $arUser['DETAIL_URL'] ?>">
                      <?= CUser::FormatName($arParams['NAME_TEMPLATE'], $arUser, $arParams["SHOW_LOGIN"] != 'N'); ?>
                    </a>
                </div>



                <div class="titleBirth">День рождения</div>
                <div class="dayBirth">
                    <? echo (!empty($arUser['PREVIEW_TEXT_TYPE']) && $arUser['PREVIEW_TEXT_TYPE'] == 'html' ? $arUser['SUBTITLE'] : htmlspecialcharsbx($arUser['SUBTITLE'])) ?>
                </div>





                <div class="userPosition"><? echo htmlspecialcharsbx($arUser['WORK_POSITION']) ?></div>
                <div class="areaJob">
                    <? foreach ($arUserData as $key => $value) {
                        if (in_array($key, array('PERSONAL_PHOTO'))) {
                            continue;
                        }
                        echo $arParams['USER_PROP'][$key] ? $arParams['USER_PROP'][$key] : GetMessage('ISL_' . $key); ?>:
                        <? switch ($key) {
                            case 'EMAIL':
                                echo '';
                                break;

                            case 'PERSONAL_WWW':
                                echo '';
                                break;

                            case 'PERSONAL_PHONE':
                            case 'WORK_PHONE':
                            case 'PERSONAL_MOBILE':
                            case 'UF_USR_1683828500926':
                                $value_encoded = preg_replace('/[^\d\+]+/', '', $value);
                                echo '<a href="callto://', $value_encoded, '" onclick="if(typeof(top.BXIM) !== \'undefined\') { top.BXIM.phoneTo(\'', $value_encoded, '\', {}); return BX.PreventDefault(event); }">', htmlspecialcharsbx($value), '</a>';
                                break;

                            case 'PERSONAL_GENDER':
                                echo $value == 'F' ? GetMessage('INTR_ISP_GENDER_F') : ($value == 'M' ? GetMessage('INTR_ISP_GENDER_M') : '');
                                break;

                            case 'PERSONAL_BIRTHDAY':
                                echo FormatDateEx(
                                    $value,
                                    false,
                                    $arParams['DATE_FORMAT' . (($arParams['SHOW_YEAR'] == 'N' || $arParams['SHOW_YEAR'] == 'M' && $arUser['PERSONAL_GENDER'] == 'F') ? '_NO_YEAR' : '')]
                                );

                                break;

                            case 'DATE_REGISTER':
                                echo FormatDateEx(
                                    $value,
                                    false,
                                    $arParams['DATE_TIME_FORMAT']
                                );

                                break;

                            case 'UF_DEPARTMENT':
                                $bFirst = true;
                                if (is_array($value) && count($value) > 0) {
                                    foreach ($value as $dept_id => $dept_name) {
                                        if (!$bFirst && $dept_name) echo ', ';
                                        else $bFirst = false;

                                        if (CModule::IncludeModule('extranet') && CExtranet::IsExtranetSite())
                                            echo htmlspecialcharsbx($dept_name);
                                        else {
                                            if (trim($arParams["PATH_TO_CONPANY_DEPARTMENT"]) <> '')
                                                echo '<div class="otdel">', htmlspecialcharsbx($dept_name), '</div>';
                                            else
                                                echo '<a href="', $arParams['STRUCTURE_PAGE'] . '?set_filter_', $arParams['STRUCTURE_FILTER'], '=Y&', $arParams['STRUCTURE_FILTER'], '_UF_DEPARTMENT=', $dept_id, '">', htmlspecialcharsbx($dept_name), '</a>';
                                        }
                                    }
                                }
                                break;

                            default:
                                if (mb_substr($key, 0, 3) == 'UF_' && is_array($arResult['USER_PROP'][$key])) {
                                    $arResult['USER_PROP'][$key]['VALUE'] = $value;
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:system.field.view',
                                        $arResult['USER_PROP'][$key]['USER_TYPE_ID'],
                                        array(
                                            'arUserField' => $arResult['USER_PROP'][$key],
                                        )
                                    );
                                } else
                                    echo htmlspecialcharsbx($value);

                                break;
                        } ?>
                        <br />
                    <? } ?>
                </div>




            </div>


		<?

		endif;
		?>

		<?
		if (
			is_array($arParams['USER_PROPERTY'])
			&& in_array('PERSONAL_PHOTO', $arParams['USER_PROPERTY'])
		) {
		?>


		<?
		}
		?>





</div>











<?
if ($arParams['LIST_OBJECT']) {
?>
	<script>
		<? echo CUtil::JSEscape($arParams['LIST_OBJECT']) ?>[<? echo CUtil::JSEscape($arParams['LIST_OBJECT']) ?>.length] = {
			ID: <? echo $arUser['ID'] ?>,
			NAME: '<? echo CUtil::JSEscape($name) ?>',
			CURRENT: <? echo $arUser['IS_HEAD'] ? 'true' : 'false' ?>
		}
	</script>
<?
}
?>