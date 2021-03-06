<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6fac978289a89fd4cf8dc66cd70330ec
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MJ\\SidebarLogin\\' => 16,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MJ\\SidebarLogin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6fac978289a89fd4cf8dc66cd70330ec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6fac978289a89fd4cf8dc66cd70330ec::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
