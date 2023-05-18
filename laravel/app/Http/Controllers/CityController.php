<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function fetchWeatherData(Request $request)
    {
        $searchData = $request->input('searchData');
        $latLon = explode(" ", $searchData);

        $lat = $latLon[0];
        $lon = $latLon[1];
        
        $weatherApiUrl = env('WEATHER_API_URL');
        $weatherApiKey = env('WEATHER_API_KEY');

        $currentWeatherUrl = "{$weatherApiUrl}/weather?lat={$lat}&lon={$lon}&appid={$weatherApiKey}&units=metric";
        $forecastUrl = "{$weatherApiUrl}/forecast?lat={$lat}&lon={$lon}&appid={$weatherApiKey}&units=metric";

        $currentWeatherResponse = file_get_contents($currentWeatherUrl);
        $forecastResponse = file_get_contents($forecastUrl);

        $currentWeather = json_decode($currentWeatherResponse, true);
        $forecast = json_decode($forecastResponse, true);

        $data = [
            'city' => $searchData,
            'currentWeather' => $currentWeather,
            'forecast' => $forecast
        ];

        return response()->json($data);
    }
}