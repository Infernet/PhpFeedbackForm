<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfc610277732fd94c5ff11c4aa5719e39
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Infernet\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Infernet\\' => 
        array (
            0 => __DIR__ . '/../..' . '/infernet',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfc610277732fd94c5ff11c4aa5719e39::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfc610277732fd94c5ff11c4aa5719e39::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
