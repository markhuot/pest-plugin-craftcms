<?php

namespace Pest\CraftCms;

class TestCase extends \PHPUnit\Framework\TestCase {

    /** @var \Craft */
    protected $craft;
    static $craftConfig;

    protected function setUp(): void {
        $this->craft = $this->createApplication();
    }

    protected function createApplication() {
        if ($this->needsRequireStatements()) {
            $this->requireCraft();
        }

        return \Craft::createObject(self::$craftConfig);
    }

    protected function needsRequireStatements() {
        return !defined('CRAFT_BASE_PATH');
    }

    protected function requireCraft() {
        // Define path constants
        define('CRAFT_BASE_PATH', getcwd());
        define('CRAFT_VENDOR_PATH', CRAFT_BASE_PATH . '/vendor');

        // Load Composer's autoloader
        // require_once CRAFT_VENDOR_PATH . '/autoload.php';

        // Load dotenv?
        if (class_exists('Dotenv\Dotenv') && file_exists(CRAFT_BASE_PATH . '/.env')) {
            \Dotenv\Dotenv::create(CRAFT_BASE_PATH)->load();
        }

        // Define additional PHP constants
        // (see https://craftcms.com/docs/3.x/config/#php-constants)
        define('CRAFT_ENVIRONMENT', getenv('ENVIRONMENT') ?: 'production');

        // Load and run Craft
        /** @var craft\web\Application $app */
        require CRAFT_VENDOR_PATH . '/craftcms/cms/bootstrap/web.php';
        self::$craftConfig = $config;

        self::$craftConfig['components']['request'] = function() {
            $config = \craft\helpers\App::webRequestConfig();
            $config['class'] = 'markhuot\\craftpest\\web\\Request';
            /** @var \craft\web\Request $request */
            $request = \Craft::createObject($config);
            $request->csrfCookie = \Craft::cookieConfig([], $request);
            return $request;
        };
    }

}
