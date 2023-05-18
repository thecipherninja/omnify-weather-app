<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


require '../vendor/autoload.php';
use Dotenv\Dotenv;

// $dotenvPath = realpath('/path/to/your/directory');
// D:\Projects\websites\omnify-weather-app\laravel
// // Require Composer's autoloader file
// require $dotenvPath . '/vendor/autoload.php';

// // Looing for .env at the root directory
$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

// // Retrive env variable
// $rapidApiKey = $_ENV['RAPID_API_KEY'];
global $weatherApiKey;
$weatherApiKey = $_ENV['WEATHER_API_KEY'];

class PostController extends Controller
{
    public function getWeatherData() {
        global $weatherApiKey;
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=47&lon=46.9994&appid=".$weatherApiKey;
        $response = Http::get($url);
        if ($response->ok()) {
            // $data = json_decode($response, true);
            $data = $response->json();
            $relevantData = [
                'location' => $data['name'],
                'temperature' => $data['main']['temp'],
                'humidity' => $data['main']['humidity'],
                'description' => $data['weather'][0]['description'],
            ];
            return response()->json($relevantData);
        }

        return response()->json(['error' => 'Failed to fetch data'], 500);
    }
}

