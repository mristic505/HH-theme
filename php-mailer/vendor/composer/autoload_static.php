<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfca1e9afd51126d7167b69a69d16b3f6
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfca1e9afd51126d7167b69a69d16b3f6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfca1e9afd51126d7167b69a69d16b3f6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
