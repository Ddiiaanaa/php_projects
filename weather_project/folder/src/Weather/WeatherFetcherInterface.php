<?php

namespace App\Weather;

interface WeatherFetcherInterface {

    public function fetch(string $city): ?WeatherInfo;
}