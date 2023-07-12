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

$SITE_TEMPLATE_PATH = "/local/templates/bitrix24";

//$APPLICATION->SetAdditionalCSS($SITE_TEMPLATE_PATH."/css/bootstrap.min.css");
//$APPLICATION->AddHeadScript($SITE_TEMPLATE_PATH.'/js/bootstrap.min.js');
$APPLICATION->AddHeadScript($SITE_TEMPLATE_PATH . '/js/trips.js');


function getBitrixUserManager($user_id = false)
{
    if (!$user_id)
        $user_id = $GLOBALS["USER"]->GetID();
    $__resArray = [];
    # Получаем список всех отделов, где работает сотрудник (он может быть привязан к нескольким отделам)
    $__deps = array_values(CIntranetUtils::GetUserDepartments($user_id));
    foreach ($__deps as $__depId) {
        # Получаем иерархический список отделов до каждого отдела пользователя, где он работает
        $dbRes = CIBlockSection::GetNavChain(0, $__depId);
        while ($arSection = $dbRes->Fetch()) {
            $__curDep[0] = $arSection['ID']; // Нужно передавать массив для следующей функции
            # Иерархически ищем ближайшего начальника для данного отдела и данного пользователя
            $__resArray = array_merge($__resArray, array_keys(CIntranetUtils::GetDepartmentManager($__curDep, $user_id, true)));
        }
    }
    # Возвращаем только уникальные записи начальников
    return array_unique($__resArray);
}


$arGroups = $USER->GetUserGroupArray(); // Получение массива групп текущего пользователя

$userBossFilterArray = array(); // Массив командировок, которые пользователь может удтвердить
$userFilterArray = array(); // Массив командировок, которые пользователь создал на согласование
$userArray = array(); // Массив всех командировок


$IBLOCK_ID = 61; // ИД инфоблока с которым работаем

$currentlyBoss = getBitrixUserManager($USER->GetID()); // Массив начальников текущего пользователя ASC->DESC

$rsUser = CUser::GetById(end($currentlyBoss));
$arUser = $rsUser->Fetch();

$dataUserBossUrlAva = CFile::GetPath($arUser['PERSONAL_PHOTO']);

foreach ($arResult['ITEMS'] as $arItem) {   // Функция для фильтрации элементов из инфоблока для отбора данных по текущему пользователю
    $dataEmp = CUser::GetByID($arItem['PROPERTIES']['USER']['VALUE'])->Fetch();
    $dataEmpUrlAva = CFile::GetPath($dataEmp['PERSONAL_PHOTO']);
    if (!$dataEmpUrlAva) {
        $dataEmpUrlAva = '/bitrix/js/ui/icons/b24/images/ui-user.svg';
    }
    $dataBoss = CUser::GetByID($arItem['PROPERTIES']['BOSS']['VALUE'])->Fetch();
    $dataBossUrlAva = CFile::GetPath($dataBoss['PERSONAL_PHOTO']);

    if (!$dataBossUrlAva) {
        $dataBossUrlAva = '/bitrix/js/ui/icons/b24/images/ui-user.svg';
    }

    array_push($userArray, [
        'USER' => $dataEmp['NAME'] . " " . $dataEmp['LAST_NAME'] . " " . $dataEmp['SECOND_NAME'],
        'USER_ID' => $arItem['PROPERTIES']['USER']['VALUE'],
        'USER_URL_AVA' => $dataEmpUrlAva,
        'BOSS' => $dataBoss['NAME'] . " " . $dataBoss['LAST_NAME'] . " " . $dataBoss['SECOND_NAME'],
        'BOSS_ID' => $arItem['PROPERTIES']['BOSS']['VALUE'],
        'BOSS_URL_AVA' => $dataBossUrlAva,
        'TIME_OUT' => $arItem['PROPERTIES']['TIME_OUT']['VALUE'],
        'TIME_IN' => $arItem['PROPERTIES']['TIME_IN']['VALUE'],
        'ORG_NAME' => $arItem['PROPERTIES']['ORG_NAME']['VALUE'],
        'ORG_NUMBER' => $arItem['PROPERTIES']['ORG_NUMBER']['VALUE'],
        'SUCCESS' => $arItem['PROPERTIES']['SUCCESS']['VALUE'],
    ]);

    if ($arItem['PROPERTIES']['BOSS']['VALUE'] == $USER->GetID()) { // Добавление в таблицу БОССА
        array_push($userBossFilterArray, [
            'USER' => $dataEmp['NAME'] . " " . $dataEmp['LAST_NAME'] . " " . $dataEmp['SECOND_NAME'],
            'USER_URL_AVA' => $dataEmpUrlAva,
            'USER_ID' => $arItem['PROPERTIES']['USER']['VALUE'],
            'TIME_OUT' => $arItem['PROPERTIES']['TIME_OUT']['VALUE'],
            'TIME_IN' => $arItem['PROPERTIES']['TIME_IN']['VALUE'],
            'ORG_NAME' => $arItem['PROPERTIES']['ORG_NAME']['VALUE'],
            'ORG_NUMBER' => $arItem['PROPERTIES']['ORG_NUMBER']['VALUE'],
            'SUCCESS' => $arItem['PROPERTIES']['SUCCESS']['VALUE'],
        ]);

    }

    if ($arItem['PROPERTIES']['USER']['VALUE'] == $USER->GetID()) { // Добавление в таблицу ПОДЧИНЕННОГО
        array_push($userFilterArray, [
            'BOSS' => $dataBoss['NAME'] . " " . $dataBoss['LAST_NAME'] . " " . $dataBoss['SECOND_NAME'],
            'BOSS_URL_AVA' => $dataBossUrlAva,
            'BOSS_ID' => $arItem['PROPERTIES']['BOSS']['VALUE'],
            'TIME_OUT' => $arItem['PROPERTIES']['TIME_OUT']['VALUE'],
            'TIME_IN' => $arItem['PROPERTIES']['TIME_IN']['VALUE'],
            'ORG_NAME' => $arItem['PROPERTIES']['ORG_NAME']['VALUE'],
            'ORG_NUMBER' => $arItem['PROPERTIES']['ORG_NUMBER']['VALUE'],
            'SUCCESS' => $arItem['PROPERTIES']['SUCCESS']['VALUE'],
        ]);

    }
}

?>

<!--<pre>--><?php //= print_r($USER)?><!--</pre>-->
<!--<pre>|||--><?php //= print_r(getBitrixUserManager($USER->GetID()))?><!--|||</pre>-->
<section>


    <? if ($USER->IsAuthorized()) : ?>
        <div class="root">
            <a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
            <!--        <pre>--><?php //= print_r($userBossFilterArray) ?><!--</pre>-->

            <!--        Подключаем модуль инфоблоков-->
            <? CModule::IncludeModule('iblock'); ?>


            <!--        Ниже идет форма добавления нового элемента в инфоблок       -->


            <h1 class="heading">Отправить заявку на согласование</h1>
            <form name="add_trip" action="/trips/add_form_result.php" method="POST" enctype="multipart/form-data"
                  class="form">
                <div class="form-grid">
                <div class="form-column"><div class="form-string">
                    <img src="/local/templates/bitrix24/components/bitrix/news/trips/corporate_fare_FILL0_wght600_GRAD0_opsz48.svg
"><label>Наименование организации</label>
                    </div>
                    <div class="form-string">
                    <img src="/local/templates/bitrix24/components/bitrix/news/trips/call_FILL0_wght600_GRAD0_opsz48.svg">
                    <label>Номер телефона организации</label>
                    </div>
                    <div class="form-string">
                    <img src="/local/templates/bitrix24/components/bitrix/news/trips/calendar_month_FILL0_wght600_GRAD0_opsz48.svg"> <label>Время убытия</label>
                    </div>
                    <div class="form-string"><img src="/local/templates/bitrix24/components/bitrix/news/trips/account_circle_FILL0_wght600_GRAD0_opsz48.svg"><label>Время прибытия</label></div>
                    <div class="form-string"> <img src="/local/templates/bitrix24/components/bitrix/news/trips/verified_FILL0_wght600_GRAD0_opsz48.svg"><label>Лицо, рассматривающее заявку</label></div>


                </div>
                <div class="form-column" style="margin-left: 10px;">
                <div class="form-string">
                    <input type="text" name="name" maxlength="255" value=""
                                                                  class="form-input single">
                </div>
                <div class="form-string">
                    <input type="text" name="name" maxlength="255" value=""
                                                                    class="form-input single">
                </div>
                <div class="form-string">
                    <input type="data" name="name" maxlength="255" value=""
                                                      class="form-input"><input type="time" name="name" maxlength="255"
                                                                                value="" class="form-input">
                </div>
                <div class="form-string">
                    <input type="data" name="name" maxlength="255" value=""
                                                        class="form-input"><input type="time" name="name"
                                                                                  maxlength="255" value=""
                                                                                  class="form-input">
                </div>
                <div class="form-string">
                    <a class="user-tag" href=<?= "https://intranet.gctm.ru/company/personal/user/" . $currentlyBoss['USER_ID'] . "/" ?>>
                        <div class="avatar">
                            <img class="avatar" src='<?= $dataUserBossUrlAva ?>'>
                        </div>
                        <p class="card-subtitle mb-2 text-muted"><?= $dataBoss['USER'] ?></p>
                    </a>
                </div>
                </div>
                </div>
                <input type="submit" value="Отправить" class="send-form-btn" class="form-input">
                </select>
            </form>


            <? if (count($userBossFilterArray) > 0) : ?>
                <h1 class="heading">Согласуйте заявки на командировку подчиненных:
                    <div class="counter"><?= count($userBossFilterArray) ?></div>
                </h1>
                <? foreach ($userBossFilterArray as $userBossFilter) : ?>

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <a class="user-tag"
                               href=<?= "https://intranet.gctm.ru/company/personal/user/" . $userBossFilter['USER_ID'] . "/" ?>>
                                <div class="avatar">
                                    <img class="avatar" src='<?= $userBossFilter['USER_URL_AVA'] ?>'>
                                </div>
                                <p class="card-subtitle mb-2 text-muted"><?= $userBossFilter['USER'] ?></p>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">От <?= $userBossFilter['TIME_OUT'] ?></h6>
                            <h6 class="card-subtitle mb-2 text-muted">До <?= $userBossFilter['TIME_IN'] ?></h6>
                            <p class="card-text"><?= $userBossFilter['ORG_NAME'] ?></p>
                            <p class="card-text"><?= $userBossFilter['SUCCESS'] ?></p>
                        </div>
                    </div>
                <? endforeach; ?>
            <? endif; ?>
            <? if (count($userFilterArray) > 0): ?>
                <h1 class="heading">Ваши заявки на командировку:
                    <div class="counter"><?= count($userFilterArray) ?></div>
                </h1>
                <? foreach ($userFilterArray as $userBossFilter) : ?>
                    <? ?>
                    <div class="card">
                        <a class="user-tag"
                           href=<?= "https://intranet.gctm.ru/company/personal/user/" . $userBossFilter['BOSS_ID'] . "/" ?>>
                            <div class="avatar">
                                <img class="avatar" src='<?= $userBossFilter['BOSS_URL_AVA'] ?>'>
                            </div>
                            <p><?= $userBossFilter['BOSS'] ?></p>
                        </a>
                        <p><?= $userBossFilter['TIME_OUT'] ?></p>
                        <p><?= $userBossFilter['TIME_IN'] ?></p>
                        <p><?= $userBossFilter['ORG_NAME'] ?></p>
                        <p><?= $userBossFilter['ORG_NUMBER'] ?></p>
                        <p><?= $userBossFilter['SUCCESS'] ?></p>
                    </div>
                <? endforeach; ?>
            <? endif; ?>


            <? if (in_array(18, $arGroups) || (in_array(1, $arGroups))) : ?>

                <h1 class="heading">Таблица для управления всеми командировками:
                    <div class="counter"><?= count($userArray) ?></div>
                </h1>

                <? foreach ($userArray as $userItem) : ?>
                    <div class="card">
                        <a class="user-tag"
                           href=<?= "https://intranet.gctm.ru/company/personal/user/" . $userItem['USER_ID'] . "/" ?>>
                            <div class="avatar">
                                <img class="avatar" src='<?= $userItem['USER_URL_AVA'] ?>'>
                            </div>
                            <p><?= $userItem['USER'] ?></p>
                        </a>
                        <a class="user-tag"
                           href=<?= "https://intranet.gctm.ru/company/personal/user/" . $userItem['BOSS_ID'] . "/" ?>>
                            <div class="avatar">
                                <img class="avatar" src='<?= $userItem['BOSS_URL_AVA'] ?>'>
                            </div>
                            <p><?= $userItem['BOSS'] ?></p>
                        </a>
                        <p><?= $userItem['TIME_OUT'] ?></p>
                        <p><?= $userItem['TIME_IN'] ?></p>
                        <p><?= $userItem['ORG_NAME'] ?></p>
                        <p><?= $userItem['ORG_NUMBER'] ?></p>
                        <p><?= $userItem['SUCCESS'] ?></p>
                    </div>
                <? endforeach; ?>
            <? endif; ?>
        </div>


        <!--<form style="background-color: #82d3ff; color: white" name="add_trip_seen" action="/add_form_result.php" method="POST" enctype="multipart/form-data">-->
        <!--    Название <input type="text" name="name" maxlength="255" value="">-->
        <!--    Картинка анонса <input type="file" size="30" name="image" value="">-->
        <!--    Свойство Строка <input type="text" name="line" maxlength="255" value="">-->
        <!--    Выпадающий список не множественный-->
        <!--    <select name="selector">-->
        <!--        <option value="#">Выберите из списка</option>-->
        <!--        <option value="60">1</option>-->
        <!--        <option value="61">2</option>-->
        <!--    </select>-->
        <!--    Текст анонса <textarea name="description" placeholder="Заполните поле"></textarea>-->
        <!--    Выбор раздела- множественный-->
        <!--    <select name="section_id[]" multiple="">-->
        <!--        <option value="#">Выберите из списка или начните вводить название</option>-->
        <!--        Код PHP-->
        <!--        <option value="<span id=" title="Код PHP: &lt;?= $arSection['ID']; ?&gt;" class="bxhtmled-surrogate">Код PHP"&gt;Код PHP</option>-->
        <!--        Код PHP-->
        <!--    </select>-->
        <!--    Чекбокс <label><input type="checkbox" name="chek_box" value="47"> Рассрочка </label>-->
        <!--    Произвольный файл <input type="file" size="30" name="file_pol" value="">-->
        <!--    Привязка к подразделам конкретного раздела другого мнфоблока чекбоксы-->
        <!--    --><? //
//    $rsParentSection = CIBlockSection::GetByID(5741);
//    if ($arParentSection = $rsParentSection->GetNext()) {
//        $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'], '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'], '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'], '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']);
//        $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);
//        while ($arSect = $rsSect->GetNext()) {
//            ?><!-- <label><input name="service_dop[]" type="checkbox" value="--><?php //= $arSect['ID']; ?><!--"> --><?php //= $arSect['NAME']; ?><!--</label>-->
        <!--        --><? //}}?><!-- <input type="submit" value="Отправить">-->
        <!--</form>-->
    <? endif; ?>
    <script>
        console.log("EFSFESFE")
    </script>
</section>
