<?php
use Illuminate\Http\Request;
use App\Models\GeneralSetting;

define('LARAVEL_START', microtime(true));
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$setting = GeneralSetting::first();
if (!$setting) {
    $setting = new GeneralSetting();
}

$setting->logo = 'logo.jpg';
$setting->site_title = 'Slope Medisolve';
$setting->phone = '+880 1717589756';
$setting->email = 'slopemedicalsolution@gmail.com';
$setting->address = '59/D-A Darussalam Tower, Shop No-31(Ground Floor), Darussalam, Dhaka';
$setting->save();

echo "Settings initialized with logo: " . $setting->logo . "\n";
