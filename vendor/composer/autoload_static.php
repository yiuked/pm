<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

<<<<<<< HEAD
class ComposerStaticInitcaea7251c911c94ce234d55d14e84227
=======
class ComposerStaticInit11338bbaa3802931589671a902a86970
>>>>>>> 52ff6e239bbf6ad5f154203f8c891c801abff9b2
{
    public static $files = array (
        '9c9a81795c809f4710dd20bec1e349df' => __DIR__ . '/..' . '/joshcam/mysqli-database-class/MysqliDb.php',
        '94df122b6b32ca0be78d482c26e5ce00' => __DIR__ . '/..' . '/joshcam/mysqli-database-class/dbObject.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Respect\\' => 8,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Respect\\' => 
        array (
            0 => __DIR__ . '/..' . '/respect/rest/library/Respect',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
            1 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
<<<<<<< HEAD
            $loader->prefixLengthsPsr4 = ComposerStaticInitcaea7251c911c94ce234d55d14e84227::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcaea7251c911c94ce234d55d14e84227::$prefixDirsPsr4;
=======
            $loader->prefixLengthsPsr4 = ComposerStaticInit11338bbaa3802931589671a902a86970::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit11338bbaa3802931589671a902a86970::$prefixDirsPsr4;
>>>>>>> 52ff6e239bbf6ad5f154203f8c891c801abff9b2

        }, null, ClassLoader::class);
    }
}
