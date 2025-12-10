<?php

declare(strict_types=1);

namespace App\Weather;

class RandomWeatherFetcher implements WeatherFetcherInterface {

    public function fetch(string $city): WeatherInfo {
        $weatherTypes = [
            'sunny',
            'stormy',
            'cloudy',
            'snowy'
        ];
        return new WeatherInfo($city, rand(270, 330), $weatherTypes[array_rand($weatherTypes)]);
    }
}