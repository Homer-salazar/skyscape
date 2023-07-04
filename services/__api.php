<?php
    class WeatherAPI {
        private $apiKey = 'fe388f01884018c8d11a93602b6f2f9b';
        private $apiUrl = 'http://api.openweathermap.org/data/2.5/weather';
        public $cityName;
        public $countryName;
        public $weatherIcon;
        public $weatherCon;
        public $temp;
        public $pressure;
        public $wind;
        public $visibility;
        public $humidity;
        public $maxTemp;
        public $minTemp;

        public function getWeatherData($lat, $lon) {
            $url = $this->apiUrl . "?lat=$lat&lon=$lon&appid=$this->apiKey";
            $response = file_get_contents($url);
            $weatherData = json_decode($response, true);
            $this->temp = round($weatherData['main']['temp'] - 273.15);
            $this->cityName = $weatherData['name'];
            $this->weatherIcon = $weatherData['weather'][0]['icon'];
            $this->countryName = $weatherData['sys']['country'];
            return $weatherData;
        }    

        public function getWeatherbyCountry($country) {
            $url = $this->apiUrl . "?q=$country&appid=$this->apiKey";
            $response = file_get_contents($url);
            $weatherData = json_decode($response, true);

            $this->cityName = $weatherData['name'];
            $this->countryName = $weatherData['sys']['country'];
            $this->weatherIcon = $weatherData['weather'][0]['icon'];
            $this->weatherCon = $weatherData['weather'][0]['description'];
            $this->temp = round($weatherData['main']['temp'] - 273.15);
            $this->pressure = round($weatherData['main']['pressure'] / 10);
            $this->wind = round(($weatherData['wind']['speed'] * 18) / 5);
            $this->visibility = $weatherData['visibility'] / 1000;
            $this->humidity = $weatherData['main']['humidity'];
            $this->maxTemp = $weatherData['main']['temp_max'] - 273.15;
            $this->minTemp = $weatherData['main']['temp_min'] - 273.15;

            return $weatherData;
        }
        
    }
?>