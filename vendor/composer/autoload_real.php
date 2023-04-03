<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit376dcc4c33fd08d2a98c9a66c6d1f79b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit376dcc4c33fd08d2a98c9a66c6d1f79b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit376dcc4c33fd08d2a98c9a66c6d1f79b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit376dcc4c33fd08d2a98c9a66c6d1f79b::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit376dcc4c33fd08d2a98c9a66c6d1f79b::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire376dcc4c33fd08d2a98c9a66c6d1f79b($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire376dcc4c33fd08d2a98c9a66c6d1f79b($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}