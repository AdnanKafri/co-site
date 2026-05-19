<?php

namespace App\Services\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsManager
{
    public function all(): array
    {
        return Cache::rememberForever('settings.all', function (): array {
            return Setting::query()
                ->get()
                ->mapWithKeys(fn (Setting $setting) => [$setting->key => $this->unwrap($setting->value)])
                ->all();
        });
    }

    public function group(string $group): array
    {
        $prefix = $group.'.';

        return collect($this->all())
            ->filter(fn (mixed $value, string $key) => str_starts_with($key, $prefix))
            ->mapWithKeys(fn (mixed $value, string $key) => [str($key)->after($prefix)->value() => $value])
            ->all();
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->all()[$key] ?? $default;
    }

    public function set(string $key, mixed $value): void
    {
        Setting::query()->updateOrCreate(
            ['key' => $key],
            [
                'group' => str($key)->before('.')->value(),
                'value' => $this->wrap($value),
            ]
        );

        Cache::forget('settings.all');
    }

    protected function wrap(mixed $value): array
    {
        return ['value' => $value];
    }

    protected function unwrap(mixed $value): mixed
    {
        return is_array($value) && array_key_exists('value', $value)
            ? $value['value']
            : $value;
    }
}
