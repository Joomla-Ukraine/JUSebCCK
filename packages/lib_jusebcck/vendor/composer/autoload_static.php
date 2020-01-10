<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8afeae53c85de1b91834fe6860e1856a
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'OpenCage\\Geocoder\\' => 18,
        ),
        'J' => 
        array (
            'JUSebCCK\\' => 9,
        ),
        'E' => 
        array (
            'Emuravjev\\Mdash\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'OpenCage\\Geocoder\\' => 
        array (
            0 => __DIR__ . '/..' . '/opencage/geocode/src',
        ),
        'JUSebCCK\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Emuravjev\\Mdash\\' => 
        array (
            0 => __DIR__ . '/..' . '/emuravjev/mdash/src',
        ),
    );

    public static $classMap = array (
        'Emuravjev\\Mdash\\Lib' => __DIR__ . '/..' . '/emuravjev/mdash/src/Lib.php',
        'Emuravjev\\Mdash\\Tret\\Abbr' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Abbr.php',
        'Emuravjev\\Mdash\\Tret\\Base' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Base.php',
        'Emuravjev\\Mdash\\Tret\\Dash' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Dash.php',
        'Emuravjev\\Mdash\\Tret\\Date' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Date.php',
        'Emuravjev\\Mdash\\Tret\\Etc' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Etc.php',
        'Emuravjev\\Mdash\\Tret\\Nobr' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Nobr.php',
        'Emuravjev\\Mdash\\Tret\\Number' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Number.php',
        'Emuravjev\\Mdash\\Tret\\OptAlign' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/OptAlign.php',
        'Emuravjev\\Mdash\\Tret\\Punctmark' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Punctmark.php',
        'Emuravjev\\Mdash\\Tret\\Quote' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Quote.php',
        'Emuravjev\\Mdash\\Tret\\Space' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Space.php',
        'Emuravjev\\Mdash\\Tret\\Symbol' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Symbol.php',
        'Emuravjev\\Mdash\\Tret\\Text' => __DIR__ . '/..' . '/emuravjev/mdash/src/Tret/Text.php',
        'Emuravjev\\Mdash\\Typograph' => __DIR__ . '/..' . '/emuravjev/mdash/src/Typograph.php',
        'Emuravjev\\Mdash\\TypographBase' => __DIR__ . '/..' . '/emuravjev/mdash/src/TypographBase.php',
        'HTMLCleaner' => __DIR__ . '/../..' . '/src/Classes/HTMLCleaner.php',
        'JUSebCCK\\API\\Geocode' => __DIR__ . '/../..' . '/src/API/Geocode.php',
        'JUSebCCK\\API\\Location' => __DIR__ . '/../..' . '/src/API/Location.php',
        'JUSebCCK\\Events\\AfterStore' => __DIR__ . '/../..' . '/src/Events/AfterStore.php',
        'JUSebCCK\\Events\\BeforeStore' => __DIR__ . '/../..' . '/src/Events/BeforeStore.php',
        'JUSebCCK\\Joomla\\Article' => __DIR__ . '/../..' . '/src/Joomla/Article.php',
        'JUSebCCK\\Joomla\\Cache' => __DIR__ . '/../..' . '/src/Joomla/Cache.php',
        'JUSebCCK\\Joomla\\Menu' => __DIR__ . '/../..' . '/src/Joomla/Menu.php',
        'JUSebCCK\\Joomla\\User' => __DIR__ . '/../..' . '/src/Joomla/User.php',
        'JUSebCCK\\Tmpl\\Module' => __DIR__ . '/../..' . '/src/Tmpl/Module.php',
        'JUSebCCK\\Tmpl\\Tabs' => __DIR__ . '/../..' . '/src/Tmpl/Tabs.php',
        'JUSebCCK\\Utils\\API' => __DIR__ . '/../..' . '/src/Utils/API.php',
        'JUSebCCK\\Utils\\Data' => __DIR__ . '/../..' . '/src/Utils/Data.php',
        'JUSebCCK\\Utils\\Folder' => __DIR__ . '/../..' . '/src/Utils/Folder.php',
        'JUSebCCK\\Utils\\HTML' => __DIR__ . '/../..' . '/src/Utils/HTML.php',
        'JUSebCCK\\Utils\\HTTP' => __DIR__ . '/../..' . '/src/Utils/HTTP.php',
        'JUSebCCK\\Utils\\Image' => __DIR__ . '/../..' . '/src/Utils/Image.php',
        'JUSebCCK\\Utils\\Video' => __DIR__ . '/../..' . '/src/Utils/Video.php',
        'OpenCage\\Geocoder\\AbstractGeocoder' => __DIR__ . '/..' . '/opencage/geocode/src/AbstractGeocoder.php',
        'OpenCage\\Geocoder\\Geocoder' => __DIR__ . '/..' . '/opencage/geocode/src/Geocoder.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8afeae53c85de1b91834fe6860e1856a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8afeae53c85de1b91834fe6860e1856a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8afeae53c85de1b91834fe6860e1856a::$classMap;

        }, null, ClassLoader::class);
    }
}
