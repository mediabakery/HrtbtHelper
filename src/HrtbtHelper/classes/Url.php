<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   HrtbtHelper
 * @author    Sebastian Tilch
 * @date      09.07.13
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @copyright heartbeat medical solutions 2013
 */

namespace Hrtbt\Helper;


class Url
{
    private static $arrFragments;

    /**
     * Return route fragments
     *
     * @return array route fragments
     */
    public static function getRouteFragments()
    {
        if (is_null(self::$arrFragments))
        {
            global $objPage;
            $arrFragments = array_values(
                array_filter(
                    explode('/', substr(\Environment::get('requestUri'),strpos(\Environment::get('requestUri'),$objPage->alias) + strlen($objPage->alias))
                        )
                    )
                );

            if ($arrFragments[count($arrFragments)-1] == $GLOBALS['TL_CONFIG']['urlSuffix'])
            {
                unset($arrFragments[count($arrFragments)-1]);
            }

            // Cut off url suffix
            $intPosLastElement = count($arrFragments) - 1;
            if ($intPosLastElement > -1)
            {
                $arrFragments[$intPosLastElement] = substr($arrFragments[$intPosLastElement], 0, strpos($arrFragments[$intPosLastElement], $GLOBALS['TL_CONFIG']['urlSuffix']));
                // clean route fragments
                for ($i = 0; $i <= $intPosLastElement; $i++)
                {
                    $arrFragments[$i] = \Input::cleanKey($arrFragments[$i]);
                }

                // mark all $_GETs as used to fix https://github.com/contao/core/blob/master/system/modules/core/classes/FrontendTemplate.php#L168
                foreach(array_keys($_GET) as $strKey)
                {
                    \Input::get($strKey);
                }
            }
            self::$arrFragments = $arrFragments;
        }

        return self::$arrFragments;
    }

    /**
     * Return the route as one alias
     * @return string Route alias
     */
    public static function getRouteAlias() {
        return implode('/', self::getRouteFragments());
    }

}
