<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd4957e04ba4dff37d0ecbf0a4b59e14a
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Endroid\\QrCode\\' => 15,
        ),
        'D' => 
        array (
            'DASPRiD\\Enum\\' => 13,
        ),
        'B' => 
        array (
            'BaconQrCode\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Endroid\\QrCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/endroid/qr-code/src',
        ),
        'DASPRiD\\Enum\\' => 
        array (
            0 => __DIR__ . '/..' . '/dasprid/enum/src',
        ),
        'BaconQrCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/bacon/bacon-qr-code/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'L' => 
        array (
            'Less' => 
            array (
                0 => __DIR__ . '/..' . '/wikimedia/less.php/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'lessc' => __DIR__ . '/..' . '/wikimedia/less.php/lessc.inc.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd4957e04ba4dff37d0ecbf0a4b59e14a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd4957e04ba4dff37d0ecbf0a4b59e14a::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd4957e04ba4dff37d0ecbf0a4b59e14a::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitd4957e04ba4dff37d0ecbf0a4b59e14a::$classMap;

        }, null, ClassLoader::class);
    }
}
