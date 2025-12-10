<?php

namespace App\Weather;

class FakeWeatherFetcher implements WeatherFetcherInterface {

    public function fetch(string $city): WeatherInfo {
        return new WeatherInfo($city, 270, 'cloudy');
    }
}