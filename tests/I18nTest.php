<?php

use PHPUnit\Framework\TestCase;

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once dirname(__DIR__) . '/includes/i18n.php';

class I18nTest extends TestCase
{
    protected function setUp(): void
    {
        global $i18n_cache;
        $i18n_cache = [];
        $_SESSION = [];
        $_GET = [];
        $_COOKIE = [];
    }

    public function testLoadTranslationsPrimaryLanguage()
    {
        $translations = load_translations('test_module', 'es');

        $this->assertArrayHasKey('common_key', $translations);
        $this->assertEquals('Común Español', $translations['common_key']);

        $this->assertArrayHasKey('module_key', $translations);
        $this->assertEquals('Módulo Español', $translations['module_key']);

        $this->assertArrayHasKey('override_key', $translations);
        $this->assertEquals('Anular Módulo Español', $translations['override_key']);
    }

    public function testLoadTranslationsFallbackToEnglish()
    {
        // fr doesn't exist, should fall back to en
        $translations = load_translations('test_module', 'fr');

        $this->assertArrayHasKey('common_key', $translations);
        $this->assertEquals('Common English', $translations['common_key']);

        $this->assertArrayHasKey('module_key', $translations);
        $this->assertEquals('Module English', $translations['module_key']);

        $this->assertArrayHasKey('override_key', $translations);
        $this->assertEquals('Module Override English', $translations['override_key']);
    }

    public function testLoadTranslationsCaching()
    {
        global $i18n_cache;

        $this->assertEmpty($i18n_cache);

        $translations1 = load_translations('test_module', 'es');
        $this->assertNotEmpty($i18n_cache);
        $this->assertArrayHasKey('test_module_es', $i18n_cache);
        $this->assertEquals('Módulo Español', $translations1['module_key']);

        // Modify cache directly to verify it's being used on subsequent calls
        $i18n_cache['test_module_es']['module_key'] = 'Cached Módulo Español';

        $translations2 = load_translations('test_module', 'es');
        $this->assertEquals('Cached Módulo Español', $translations2['module_key']);
    }
}
