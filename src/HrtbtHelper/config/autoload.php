<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package HrtbtHelper
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Hrtbt',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Hrtbt\Helper\Url' => 'system/modules/HrtbtHelper/classes/Url.php',
));
