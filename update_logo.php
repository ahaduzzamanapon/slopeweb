<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

use App\Models\GeneralSetting;

$setting = GeneralSetting::first();
if ($setting) {
    $setting->logo = 'logo.jpg';
    $setting->save();
    echo "Logo updated to: " . $setting->logo . "\n";
} else {
    echo "No settings record found.\n";
}
