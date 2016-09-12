<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit604bd5f7f4d283ac0f25cd85c8ed28bb
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '3b5531f8bb4716e1b6014ad7e734f545' => __DIR__ . '/..' . '/illuminate/support/Illuminate/Support/helpers.php',
        'e498698fb6f1e841bf7ec2b12ccada5f' => __DIR__ . '/../..' . '/config/database.php',
        'ae6b95daacff80b36a794990eea93120' => __DIR__ . '/../..' . '/config/Helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\Translation\\' => 30,
        ),
        'C' => 
        array (
            'Carbon\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Carbon\\' => 
        array (
            0 => __DIR__ . '/..' . '/nesbot/carbon/src/Carbon',
        ),
    );

    public static $prefixesPsr0 = array (
        'V' => 
        array (
            'Valitron' => 
            array (
                0 => __DIR__ . '/..' . '/vlucas/valitron/src',
            ),
        ),
        'I' => 
        array (
            'Illuminate\\Support' => 
            array (
                0 => __DIR__ . '/..' . '/illuminate/support',
            ),
            'Illuminate\\Events' => 
            array (
                0 => __DIR__ . '/..' . '/illuminate/events',
            ),
            'Illuminate\\Database' => 
            array (
                0 => __DIR__ . '/..' . '/illuminate/database',
            ),
            'Illuminate\\Container' => 
            array (
                0 => __DIR__ . '/..' . '/illuminate/container',
            ),
        ),
    );

    public static $classMap = array (
        'Products' => __DIR__ . '/../..' . '/models/Products.php',
        'Users' => __DIR__ . '/../..' . '/models/Users.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit604bd5f7f4d283ac0f25cd85c8ed28bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit604bd5f7f4d283ac0f25cd85c8ed28bb::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit604bd5f7f4d283ac0f25cd85c8ed28bb::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit604bd5f7f4d283ac0f25cd85c8ed28bb::$classMap;

        }, null, ClassLoader::class);
    }
}