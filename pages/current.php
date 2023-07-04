<?php 
    require_once('../layouts/header.php');
    require_once('../services/__api.php');
    $currentCity = $_GET['city'];
    $weatherAPI = new WeatherAPI();
    $weatherData = $weatherAPI->getWeatherbyCountry($currentCity);    

?>
    <div class="container-fluid">
        <div class="grid">
            <div class="px-4 py-4">
                <a href="../index.php" class="fa-solid fa-arrow-left fa-2xl max-sm:text-lg" style="color: #ffffff;"> </a>
                <span class="text-2xl px-2 max-sm:text-lg"><?=$weatherAPI->cityName ?>, <?=$weatherAPI->countryName ?></span>
            </div>
        </div>
        <section>
            <div class="grid justify-center items-center text-center">
                <div class="">
                    <img class="text-center" src="https://openweathermap.org/img/wn/<?=$weatherAPI->weatherIcon ?>@4x.png" alt="">
                </div>
                <div class="capitalize font-semibold text-2xl max-sm:text-lg">
                    <?=$weatherAPI->weatherCon; ?>
                </div>
                <div class="py-2 text-4xl font-bold max-sm:text-xl">
                    <?=$weatherAPI->temp; ?> °C
                </div>
            </div>
        </section>
        <section>
            <div class="flex items-center px-5 py-5 lg:w-3/6 mx-auto">   
                <div class="grid grid-cols-3 grid-rows-2 text-center mx-auto w-full glossy rounded-lg shadow">
                    <div class="p-3">
                        <i class="fa-solid fa-xl fa-compress-arrows-alt"></i>                        
                        <p class="py-1"><?=$weatherAPI->pressure; ?> hpa</p>
                        <p class="text-gray-300">Pressure</p>
                    </div>
                    <div class="p-3">
                        <i class="fa-solid fa-xl fa-wind"></i>
                        <p class="py-1"><?=$weatherAPI->wind; ?> km/h</p>
                        <p class="text-gray-300">Wind</p>
                    </div>
                    <div class="p-3">
                        <i class="fa-solid fa-xl fa-eye"></i>
                        <p class="py-1"><?=$weatherAPI->visibility; ?> km</p>
                        <p class="text-gray-300">Visibility</p>
                    </div>
                    <div class="p-3">
                        <i class="fa-solid fa-xl fa-droplet"></i>
                        <p class="py-1"><?=$weatherAPI->humidity; ?> %</p>
                        <p class="text-gray-300">Humidity</p>
                    </div>
                    <div class="p-3">
                        <i class="fa-solid fa-xl fa-temperature-quarter"></i>
                        <p class="py-1"><?=$weatherAPI->minTemp; ?> %</p>
                        <p class="text-gray-300">Min Temp</p>
                    </div>
                    <div class="p-3">
                        <i class="fa-solid fa-xl fa-temperature-quarter"></i>
                        <p class="py-1"><?=$weatherAPI->maxTemp; ?> %</p>
                        <p class="text-gray-300">Max Temp</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php 
    require_once('../layouts/footer.php');
?>