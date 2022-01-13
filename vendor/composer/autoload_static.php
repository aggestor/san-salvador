<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5a4e80d1fbec8d9756b6afb1ea9144ff
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'React\\EventLoop\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'React\\EventLoop\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/event-loop/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5a4e80d1fbec8d9756b6afb1ea9144ff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5a4e80d1fbec8d9756b6afb1ea9144ff::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5a4e80d1fbec8d9756b6afb1ea9144ff::$classMap;

        }, null, ClassLoader::class);
    }
}