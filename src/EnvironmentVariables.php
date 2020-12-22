<?php declare(strict_types=1);
/*
 * This file is part of lim-industries/environment-variables.
 *
 * (c) Andrew Lim <andrew@limindustries.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace LimIndustries\EnvironmentVariables;

class EnvironmentVariables
{
    // Hold the class instance.
    private static $instance = null;

    /**
     * Checks to see if the .env exists and parses it to set the 
     * evironment variables.
     * 
     * @param [type] $file
     * @return void
     */
    private function __construct($file = null) 
    {
        $this->importVariables($file);
    }

    /**
     * Undocumented function
     *
     * @param [type] $file
     * @return void
     */
    public static function getInstance($file = null)
    {
        if (self::$instance == null) {
            self::$instance = new EnvironmentVariables($file);
        }
        return self::$instance;
    }

    /**
     * Undocumented function
     *
     * @param [type] $file
     * @return void
     */
    public static function importVariables($file) {
        if ($file) {
            $contents = self::loadFile($file);
            self::assignVariables($contents);
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $file
     * @return void
     */
    public static function loadFile($file)
    {
        try {
            // run your code here
            return file_get_contents($file);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $contents
     * @return void
     */
    public static function assignVariables($contents)
    {
        $variables = explode(PHP_EOL, $contents);
        $variables = array_filter($variables);
        foreach ($variables as $variable) {
            $keyValue = explode('=', $variable);
            putenv($keyValue[0] . "=" . trim($keyValue[1]));
        }
    }

    // import vars
}

// EnvironmentVariables::getInstance(__DIR__ . DIRECTORY_SEPARATOR . '.env');
// echo getenv('APP_ENV');