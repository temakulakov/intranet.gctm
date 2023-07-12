<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<div class="news-list">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?><br />
    <?endif;?>
    <?if (count($arResult["ITEMS"]) > 0):?>
        <div class="root">
            <ul>
                <li>Наименование организации</li>
                <li>Момент подачи заявки</li>
                <li>Сотрудник</li>
                <li>Адрес организации</li>
                <li>Номер организации</li>
                <li>Начало</li>
                <li>Окончание</li>
                <li>Процесс подтверждения</li>
            </ul>
        <?foreach($arResult["ITEMS"] as $arItem):?>

            <? if($arItem['PROPERTIES']['BOSS']['VALUE'] == $USER->GetID()):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                    <ul>
                        <li> <?= $arItem['NAME']?></li>
                        <li><?= $arItem['DATE_CREATE']?></li>
                        <li><a href="https://intranet.gctm.ru/company/personal/user/<?= $arItem['PROPERTIES']['BOSS']['VALUE']?>/">
                                <?
                                $rsUser = CUser::GetByID($arItem['CREATED_BY']);
                                $arUser = $rsUser->Fetch();
                                echo $arUser['LAST_NAME'] . " " . $arUser['NAME'] . " " . $arUser['SECOND_NAME'];
                                ?>
                            </a></li>
                        <li><?= $arItem['PROPERTIES']['ORG_ADDRESS']['VALUE']?></li>
                        <li><?= $arItem['PROPERTIES']['ORG_NUMBER']['VALUE']?></li>
                        <li><?= $arItem['PROPERTIES']['TIME_OUT']['VALUE']?></li>
                        <li><?= $arItem['PROPERTIES']['TIME_IN']['VALUE']?></li>
                        <li><?= $arItem['PROPERTIES']['SUCCESS']['VALUE']?></li>
                    </ul>

            <?endif;?>
        <?endforeach;?>
        </div>
    <?endif;?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <br /><?=$arResult["NAV_STRING"]?>
    <?endif;?>
</div>
