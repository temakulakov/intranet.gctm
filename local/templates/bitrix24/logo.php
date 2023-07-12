    <?

    use Bitrix\Intranet;
    use Bitrix\Main\ModuleManager;

    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
        die();
    }

    //These settings are set in intranet.configs
    $siteLogo = Intranet\Util::getClientLogo();
    $siteTitle = trim(COption::GetOptionString("bitrix24", "site_title", ""));
    if ($siteTitle == '') {
        $siteTitle =
            ModuleManager::isModuleInstalled("bitrix24")
                ? GetMessage('BITRIX24_SITE_TITLE_DEFAULT')
                : COption::GetOptionString("main", "site_name", "");
    }

    $siteTitle = htmlspecialcharsbx($siteTitle);
    $siteUrl = htmlspecialcharsbx(SITE_DIR);
    $logo24 = Intranet\Util::getLogo24()
    ?>
    <div class="menu-switcher">
        <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" height="27" viewBox="0 -990 960 960" width="27" id="menu-icon" class="switcher">
                <path d="M153.333-232.507q-16 0-26.938-10.972-10.939-10.972-10.939-27.022 0-16.049 10.939-26.904 10.938-10.855 26.938-10.855h653.334q16 0 26.938 10.971 10.939 10.973 10.939 27.022 0 16.05-10.939 26.905-10.938 10.855-26.938 10.855H153.333Zm0-209.616q-16 0-26.938-10.972-10.939-10.972-10.939-27.022 0-16.05 10.939-26.905 10.938-10.855 26.938-10.855h653.334q16 0 26.938 10.972 10.939 10.972 10.939 27.022 0 16.05-10.939 26.905-10.938 10.855-26.938 10.855H153.333Zm0-209.617q-16 0-26.938-10.972-10.939-10.972-10.939-27.021 0-16.05 10.939-26.985 10.938-10.934 26.938-10.934h653.334q16 0 26.938 11.051 10.939 11.052 10.939 27.102 0 16.049-10.939 26.904-10.938 10.855-26.938 10.855H153.333Z"/>
            </svg>
        </div>
    </div>
    <a href="<?= $siteUrl ?>" title="<?= GetMessage("BITRIX24_LOGO_TOOLTIP") ?>" class="logo">
        <?
        if ($siteLogo["logo"]) :
            ?>
            <span class="logo-image-container">
                <img src="<?= SITE_TEMPLATE_PATH . '/images/logo-pink.svg'; ?>" class="logo-pink" style="display:none" />
                <img src="<?= SITE_TEMPLATE_PATH . '/images/logo-white.svg'; ?>" class="logo-white" />
            </span>
        <?
        else :
            ?>
            <span class="logo-text-container">
                <span class="logo-text"><?= $siteTitle ?></span>
                <?
                if ($logo24) :
                    ?>
                    <span class="logo-color"><?= $logo24 ?></span>
                <?
                endif
                ?>
            </span>
        <?
        endif;

        if (IsModuleInstalled("bitrix24")) :
            $APPLICATION->IncludeComponent(
                'bitrix:bitrix24.holding',
                '.default',
                [],
                false,
                ['HIDE_ICONS' => 'Y']
            );
        endif;
        ?>
    </a>
    <script type="text/javascript">
        $(window).on("scroll", function() {
            if ($(window).scrollTop() > 30) {
                $(document).find('.logo-white').hide();
                $(document).find('.logo-pink').show();
                $(document).find('.switcher').css({ fill: '#561632', stroke: '#561632', opacity: 1 });
            } else {
                $(document).find('.logo-white').show();
                $(document).find('.logo-pink').hide();
                $(document).find('.switcher').css({ fill: 'white', stroke: 'white', opacity: 1 });
            }
        });
    </script>