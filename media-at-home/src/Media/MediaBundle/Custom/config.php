<?php

/** Configuration for database, and other initial defines **/

defined('DB_SERVER') ? null : define('DB_SERVER', 'localhost');
defined('DB_USER')   ? null : define('DB_USER', 'media_storage');
defined('DB_PASS')   ? null : define('DB_PASS', 'qKzcRF3QLmBQKryX');
defined('DB_NAME')   ? null : define('DB_NAME', 'media_storage');


//define('DS', DIRECTORY_SEPARATOR);
define('ROOTFS', '/NAS/homes/jon/public_html');
define('RELROOT', '');
define('XMLDIR', ROOTFS.'/storage/xml');
define('XMLURL', 'http://www.thetvdb.com/data/series/');
define('PAGES_DIR', 'pages');
define('BANNERDIR', ROOTFS.'/storage/banners');
define('BANNERREL', RELROOT.'/storage/banners');
define('POSTERDIR', ROOTFS.'/storage/posters');
define('POSTERREL', RELROOT.'/storage/posters');
