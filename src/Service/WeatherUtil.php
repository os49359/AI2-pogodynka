<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Location;
use App\Entity\Forecast;
use App\Repository\LocationRepository;
use App\Repository\ForecastRepository;

class WeatherUtil
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly ForecastRepository $forecastRepository,
    )
    {
    }

    public function getWeatherForLocation(Location $location): array
    {
        $measurements = $this->forecastRepository->findByLocation($location);
        return $measurements;
    }

    public function getWeatherForCountryAndCity(string $countryCode, string $city): array
    {
        $location = $this->locationRepository->findOneBy([
            'country' => $countryCode,
            'city' => $city,
        ]);

        $measurements = $this->getWeatherForLocation($location);

        return $measurements;
    }
}