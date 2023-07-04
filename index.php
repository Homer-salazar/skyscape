<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css">
        <title>Document</title>
    </head>
    <body>
        <?php 
            require_once('./services/__api.php');
            $weatherAPI = new WeatherAPI();
            $countries = array("japan", "singapore", "France", "Germany");
        ?>
        <div class="container mx-auto">
            <div class="grid">
                <header>
                    <h1 class="py-4 text-3xl md:text-4xl lg:text-5xl text-center">Skyscape</h1>
                </header>
                <nav>
                    <form class="flex items-center px-5 py-5 lg:w-3/6 mx-auto">   
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
                        </div>
                        <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-[var(--primary-button)] rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>
                </nav>
                <?php if(isset($_GET['lat']) && isset($_GET['lon'])){ 
                    $lat = $_GET['lat'];
                    $lon = $_GET['lon'];
                    $weatherData = $weatherAPI->getWeatherData($lat, $lon);
            
                    ?>
                    <section>
                        <div class="flex items-center px-5 py-5 lg:w-3/6 mx-auto">   
                            <a href="./pages/current.php?city=<?php echo $cityName; ?>" class="mx-auto w-full p-6 bg-[var(--secondary-button)] border border-[var(--secondary-button)] rounded-lg shadow hover:bg-gray-100 dark:bg-[var(--secondary-button)] dark:border-[var(--primary-button)] dark:hover:bg-[var(--primary-button)]">
                                <div class="grid grid-cols-2">
                                    <div class="col-span-1 text-left">
                                        <img class="p-0" src="https://openweathermap.org/img/wn/<?=$weatherAPI->weatherIcon ?>@2x.png" alt="">
                                    </div>
                                    <div class="col-span-1">
                                        <div class="text-3xl max-sm:text-xl font-semibold">
                                            <span><?=$weatherAPI->cityName ?></span>, <span><?=$weatherAPI->countryName; ?></span>
                                        </div>
                                        <div class="font-bold text-3xl max-sm:text-lg mt-2">
                                            <?=$weatherAPI->temp; ?> °C
                                        </div>
                                    </div>
                                </div>
                            </a>                    
                        </div>
                    </section>
                    <?php } else { 
                        echo '<script>
                            setTimeout(function() {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    window.location.href = "index.php?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude;
                                }, function(error) {
                                    alert("Error getting location: " + error.message);
                                });
                            }, 50);
                        </script>';
                }  ?>
                <div class="flex items-center px-5 py-2 lg:w-3/6 mx-auto">   
                    <h1>Other Locations</h1>
                </div>
                <?php foreach ($countries as $country) {
                    $weatherData = $weatherAPI->getWeatherbyCountry($country); // Make API request for each country

                    if ($weatherData) {
                        $temp = round($weatherData['main']['temp'] - 273.15);
                        $weather = $weatherData['weather'][0]['main'];
                        $cityName = $weatherData['name'];
                        $countryName = $weatherData['sys']['country'];
                        $weatherIcon = $weatherData['weather'][0]['icon'];
                    } else {
                        echo "Error fetching weather data for $country.";
                        continue; // Skip to the next iteration if there's an error
                    }
                    ?>
                    <section>
                        <div class="flex items-center px-5 py-2 lg:w-3/6 mx-auto">   
                            <a href="./pages/current.php?city=<?php echo $country; ?>" class="mx-auto w-full p-6 bg-[var(--secondary-button)] border border-[var(--secondary-button)] rounded-lg shadow hover:bg-gray-100 dark:bg-[var(--secondary-button)] dark:border-[var(--primary-button)] dark:hover:bg-[var(--primary-button)]">
                                <div class="grid grid-cols-2">
                                    <div class="col-span-1 text-left">
                                        <div class="text-3xl max-sm:text-xl font-semibold">
                                                <span><?php echo $cityName; ?></span>, <span><?php echo $countryName; ?></span>
                                            </div>
                                            <div class="font-bold text-3xl max-sm:text-lg mt-2">
                                                <?php echo $temp ." °C" ?>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <img class="p-0" src="https://openweathermap.org/img/wn/<?php echo $weatherIcon; ?>@2x.png">
                                    </div>
                                </div>
                            </a>                    
                        </div>                    
                    </section>
                <?php } ?>
            </div>
        </div>
        <script src="https://cdn.tailwindcss.com"></script>
    </body>
</html>
