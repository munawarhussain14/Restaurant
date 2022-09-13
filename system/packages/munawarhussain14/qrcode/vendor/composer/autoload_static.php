<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3eecd09fc9b1b74976835baa27504824
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Munawarhussain14\\Qrcode\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Munawarhussain14\\Qrcode\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit3eecd09fc9b1b74976835baa27504824::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3eecd09fc9b1b74976835baa27504824::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3eecd09fc9b1b74976835baa27504824::$classMap;

        }, null, ClassLoader::class);
    }
}
