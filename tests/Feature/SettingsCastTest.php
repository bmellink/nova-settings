<?php

namespace bmellink\NovaSettings\Tests\Feature;

use Laravel\Nova\Fields\Number;
use bmellink\NovaSettings\NovaSettings;
use bmellink\NovaSettings\Models\Settings;
use bmellink\NovaSettings\Tests\IntegrationTestCase;

class SettingsCastTest extends IntegrationTestCase
{
    public function test_integer_casting_works()
    {
        NovaSettings::addSettingsFields([
            Number::make('Test'),
        ], ['test' => 'int']);

        Settings::create(['key' => 'test', 'value' => '555']);

        $settingValue = nova_get_setting('test');
        $this->assertIsInt($settingValue);
        $this->assertEquals(555, $settingValue);
    }

    public function test_array_casting_works()
    {
        NovaSettings::addSettingsFields([
            Number::make('Test'),
        ], ['test' => 'array']);

        $testValue = ['et' => 'Eesti', 'ru' => 'Russia'];
        Settings::create(['key' => 'test', 'value' => $testValue]);

        $settingValue = nova_get_setting('test');
        $this->assertIsArray($settingValue);
        $this->assertEquals($testValue, $settingValue);
    }

    public function test_boolean_casting_works()
    {
        NovaSettings::addSettingsFields([
            Number::make('Test'),
        ], ['test' => 'boolean']);

        Settings::create(['key' => 'test', 'value' => 1]);

        $settingValue = nova_get_setting('test');
        $this->assertIsBool($settingValue);
        $this->assertTrue($settingValue);
    }
}
