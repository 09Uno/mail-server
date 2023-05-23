<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdd4a10bdcb32fe8d1efe094d83756aac
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdd4a10bdcb32fe8d1efe094d83756aac::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdd4a10bdcb32fe8d1efe094d83756aac::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdd4a10bdcb32fe8d1efe094d83756aac::$classMap;

        }, null, ClassLoader::class);
    }
}