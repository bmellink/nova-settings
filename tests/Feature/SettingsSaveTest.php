<?php

namespace bmellink\NovaSettings\Tests\Feature;

use Laravel\Nova\Fields\Text;
use bmellink\NovaSettings\NovaSettings;
use bmellink\NovaSettings\Models\Settings;
use bmellink\NovaSettings\Tests\IntegrationTestCase;

class SettingsSaveTest extends IntegrationTestCase
{
    public function test_settings_are_saved()
    {
        NovaSettings::addSettingsFields([
            Text::make('Test'),
            Text::make('TestOne'),
        ]);

        $request = $this->postJson(route('nova-settings.save'), ['test' => 'Test Value']);

        $request->assertStatus(204);
        $this->assertEquals('Test Value', Settings::getValueForKey('test'));
    }

    public function test_settings_are_saved_with_path()
    {
        NovaSettings::addSettingsFields([
            Text::make('TestTwo'),
            Text::make('TestThree'),
            Text::make('TestFour'),
        ], [], 'Other');

        $request = $this->postJson(route('nova-settings.save'), ['path' => 'other', 'testthree' => 'Test Value']);

        $request->assertStatus(204);
        $this->assertEquals('Test Value', Settings::getValueForKey('testthree'));
    }
}
