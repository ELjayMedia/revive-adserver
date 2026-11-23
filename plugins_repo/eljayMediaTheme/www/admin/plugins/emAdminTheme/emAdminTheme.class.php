<?php

/*
+---------------------------------------------------------------------------+
| EljayMedia Admin Theme for Revive Adserver                                |
|                                                                           |
| License: GPLv2 or later, see the LICENSE.txt file.                        |
+---------------------------------------------------------------------------+
*/

require_once LIB_PATH . '/Plugin/Component.php';
require_once MAX_PATH . '/lib/OX/Admin/UI/Hooks.php';

/**
 * Adds the EljayMedia stylesheet (and a tiny tidy-up script) to every admin page.
 *
 * Everything lives inside this plugin, so upgrading Revive (which replaces
 * core files) does not remove the theme as long as the plugins folders are
 * carried over, as the official upgrade guide instructs.
 */
class Plugins_Admin_EmAdminTheme_EmAdminTheme extends OX_Component
{
    public const VERSION = '1.1.0';

    public function registerUiListeners()
    {
        OX_Admin_UI_Hooks::registerBeforePageHeaderListener([$this, 'addStylesheet']);
    }

    public function addStylesheet($oEventContext = null)
    {
        if (empty($GLOBALS['_MAX']['ADMIN_UI']) || !is_callable([$GLOBALS['_MAX']['ADMIN_UI'], 'registerStylesheetFile'])) {
            return;
        }

        $oUI = $GLOBALS['_MAX']['ADMIN_UI'];
        $base = MAX::constructURL(MAX_URL_ADMIN, 'plugins/emAdminTheme/');
        $oUI->registerStylesheetFile($base . 'css/eljaymedia.css?v=' . self::VERSION);

        if (is_callable([$oUI, 'registerJSFile'])) {
            $oUI->registerJSFile($base . 'js/eljaymedia.js?v=' . self::VERSION);
        }
    }
}
