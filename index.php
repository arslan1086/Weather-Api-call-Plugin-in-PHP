<?php
$status = "";
$msg = "";
$city = "";
if (isset($_POST['submit'])) {
    $city = $_POST['city'];
    $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=49c0bad2c7458f1c76bec9654081a661";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);
    if ($result['cod'] == 200) {
        $status = "yes";
    } else {
        $msg = $result['message'];
    }
}
?>

<html lang="en" class=" -webkit-">

<head>
    <meta charset="UTF-8">
    <title>Weather Card</title>
    <style>

    </style>
</head>

<body>
    <div class="form">
        <form class="textfield" style="width:100%;" method="post" style="position: absolute; top: 42%; left: 50%; display: flex; height: 300px; width: 600px; transform: translate(-50%, -50%);">
            <input type="text" class="text" placeholder="Enter city name" name="city" value="<?php echo $city ?>" />
            <input type="submit" value="Submit" class="submit" name="submit" />
            <?php echo $msg ?>
        </form>
    </div>

    <?php if ($status == "yes") { ?>
        <article class="widget" style="position: absolute; margin-top:50px; top: 50%; left: 50%; display: flex; height: 300px; width: 600px; transform: translate(-50%, -50%); flex-wrap: wrap; cursor: pointer; border-radius: 20px; box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);">
            <div class="weatherIcon" style="flex: 1 100%; height: 60%; border-top-left-radius: 20px; border-top-right-radius: 20px; background: #FAFAFA; font-family: weathericons; display: flex; align-items: center; justify-content: space-around; font-size: 100px;">
                <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon'] ?>@4x.png" />
            </div>
            <div class="weatherInfo" style="flex: 0 0 70%; height: 40%; background: darkslategray; border-bottom-left-radius: 20px; display: flex; align-items: center; color: white;">
                <div class="temperature" style="flex: 0 0 40%; width: 100%; font-size: 65px; display: flex; justify-content: space-around;">
                    <span><?php echo round($result['main']['temp'] - 273.15) ?>°</span>
                </div>
                <div class="description mr45" style="flex: 0 60%; display: flex; flex-direction: column; width: 100%; height: 100%; justify-content: center; margin-left:-15px;">
                    <div class="weatherCondition" style="text-transform: uppercase; font-size: 35px; font-weight: 100;"><?php echo $result['weather'][0]['main'] ?></div>
                    <div class="place" style="font-size: 15px;">ID: <?php echo $result['id'] ?></div>
                    <div class="place" style="font-size: 15px;">City: <?php echo $result['name'] ?></div>
                    <div class="place" style="font-size: 15px;">Timezone: <?php echo $result['timezone'] ?></div>
                    <div class="place" style="font-size: 15px;">base: <?php echo $result['base'] ?></div>
                </div>

                <div class="description">
                    <div class="weatherCondition" style="text-transform: uppercase; font-size: 35px; font-weight: 100;">Wind</div>
                    <div class="place" style="font-size: 15px;"><?php echo $result['wind']['speed'] ?> M/H</div>
                    <div class="place" style="font-size: 15px;">Longitude: <?php echo $result['coord']['lon'] ?></div>
                    <div class="place" style="font-size: 15px;">Latitude: <?php echo $result['coord']['lat'] ?></div>
                </div>
            </div>
            <div class="date" style="flex: 0 0 30%; height: 40%; background: #70C1B3; border-bottom-right-radius: 20px; display: flex; justify-content: space-around; align-items: center; color: white; font-size: 30px; font-weight: 800;">
                <?php echo date('d M', $result['dt']) ?>
            </div>
        </article>
    <?php } ?>
</body>

</html>