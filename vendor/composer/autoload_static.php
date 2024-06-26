<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3e7fccdd173a5ff9a7b78081434e9cb7
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'Admin\\Admin\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Admin\\Admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3e7fccdd173a5ff9a7b78081434e9cb7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3e7fccdd173a5ff9a7b78081434e9cb7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3e7fccdd173a5ff9a7b78081434e9cb7::$classMap;

        }, null, ClassLoader::class);
    }
}
