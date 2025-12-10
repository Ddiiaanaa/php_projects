<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/normalize.css" />
    <link rel="stylesheet" type="text/css" href="./styles/styles.css" />
    <title>Document</title>
</head>
<body>
    <?php /* var_dump($info); */ ?>
    <?php
        $backgrounds = [
            'stormy' => 'images/stormy/bg.svg',
            'cloudy' => 'images/cloudy/bg.svg',
            'snowy' => 'images/snowy/bg.svg',
            'sunny' => 'images/sunny/bg.svg'
        ];
        $bgImage = null;
        if (isset($backgrounds[$info->weatherType])) {
            $bgImage = $backgrounds[$info->weatherType];
        }
    ?>
    <div class="app-container"
        <?php if (!empty($bgImage)): ?>
         style="background-image: url('<?php echo e($bgImage); ?>'); "
        <?php endif; ?>
        >
        <div class="top-bar">
            <div class="top-bar__location">
                <svg class="icon" viewBox="0 0 52.7624 72.774">
                    <path d="m45.0353,7.7268h0c-10.3024-10.3024-27.0058-10.3024-37.3081,0h0C-1.2832,16.7371-2.5652,30.9001,4.6807,41.3819l21.7006,31.392,21.7006-31.392c7.2459-10.4818,5.9638-24.6448-3.0465-33.6551Zm-18.6541,32.3037c-7.5383,0-13.6492-6.111-13.6492-13.6492s6.111-13.6493,13.6492-13.6493,13.6492,6.111,13.6492,13.6493-6.111,13.6492-13.6492,13.6492Z" style="fill: currentColor;"/>
                </svg>
                <?php echo e($info->city); ?>
            </div>
            <div class="top-bar__date">
                <?php echo e(date('l')); ?>, <?php echo e(date('d')); ?><sup>th</sup>
            </div>
        </div>
        <div class="weather-info">
            <?php
                $images = [
                    'stormy' => 'images/stormy/large.svg',
                    'cloudy' => 'images/cloudy/large.svg',
                    'snowy' => 'images/snowy/large.svg',
                    'sunny' => 'images/sunny/large.svg'
                ];
                $largeImage = null;
                if (isset($images[$info->weatherType])) {
                    $largeImage = $images[$info->weatherType];
                }
            ?>
            <?php if (!empty($largeImage)): ?>
                <img class="weather-info__image" src="<?php echo e($largeImage); ?>" alt="<?php echo e($info->weatherType); ?>" />
            <?php endif; ?>
            <?php /* <h1 class="weather-info__temperature"><?php echo e($info->temperatureK); ?>K</h1> */ ?>
            <h1 class="weather-info__temperature">
                <?php echo e($info->getFahrenheit()); ?>° / <?php echo e($info->getCelsius()); ?>°
            </h1>
            <?php if ($info->weatherType === 'stormy'): ?>
                <p class="weather-info__desc">
                    <svg class="icon" viewBox="0 0 64.835 62.9863">
                        <g>
                            <path d="m38.7952,39.7744h12.9254c6.4144,0,11.6143-5.1999,11.6143-11.6143,0-3.9883-2.011-7.506-5.0735-9.5972-1.6542-5.8803-7.0526-10.1928-13.4618-10.1928-1.572,0-3.0816.2632-4.492.7414-2.5321-4.5396-7.3796-7.6115-12.9467-7.6115-8.1835,0-14.8174,6.634-14.8174,14.8174,0,.0814.0049.1616.0062.2427-6.1521.2946-11.0497,5.375-11.0497,11.6,0,6.4144,5.1999,11.6143,11.6142,11.6143h5.9995" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <polygon points="31.496 32.023 37.4737 15.8957 27.2263 15.8957 19.1137 39.7765 30.0016 39.7765 24.5577 61.4863 43.8782 32.023 31.496 32.023" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                        </g>
                    </svg>
                    Stormy
                </p>
            <?php elseif ($info->weatherType === 'sunny'): ?>
                <p class="weather-info__desc">
                    <svg class="icon" viewBox="0 0 68.4066 68.4066">
                        <g>
                            <circle cx="34.2033" cy="34.6223" r="13.0078" style="fill: none; stroke: currentColor; stroke-miterlimit: 10; stroke-width: 3px;"/>
                            <line x1="34.2033" y1="68.4066" x2="34.2033" y2="55.263" style="fill: none; stroke: currentColor; stroke-miterlimit: 10; stroke-width: 3px;"/>
                            <line x1="34.2033" y1="13.9815" x2="34.2033" style="fill: none; stroke: currentColor; stroke-miterlimit: 10; stroke-width: 3px;"/>
                            <line x1="68.4066" y1="34.2033" x2="55.263" y2="34.2033" style="fill: none; stroke: currentColor; stroke-miterlimit: 10; stroke-width: 3px;"/>
                            <line x1="13.9815" y1="34.2033" y2="34.2033" style="fill: none; stroke: currentColor; stroke-miterlimit: 10; stroke-width: 3px;"/>
                            <line x1="58.3886" y1="58.3886" x2="49.0947" y2="49.0947" style="fill: none; stroke: currentColor; stroke-miterlimit: 10; stroke-width: 3px;"/>
                            <line x1="19.9043" y1="19.9043" x2="10.0179" y2="10.0179" style="fill: none; stroke: currentColor; stroke-miterlimit: 10; stroke-width: 3px;"/>
                            <line x1="58.3886" y1="10.0179" x2="49.0947" y2="19.3118" style="fill: none; stroke: currentColor; stroke-miterlimit: 10; stroke-width: 3px;"/>
                            <line x1="19.9043" y1="48.5022" x2="10.0179" y2="58.3886" style="fill: none; stroke: currentColor; stroke-miterlimit: 10; stroke-width: 3px;"/>
                        </g>
                    </svg>
                    Sunny
                </p>
            <?php elseif ($info->weatherType === 'snowy'): ?>
                <p class="weather-info__desc">
                    <svg class="icon" viewBox="0 0 57.5357 50.1371">
                        <g>
                            <path d="m34.3927,35.2563h11.3997c5.6572,0,10.2433-4.5861,10.2433-10.2433,0-3.5175-1.7736-6.6199-4.4746-8.4643-1.4589-5.1862-6.2201-8.9896-11.8727-8.9896-1.3864,0-2.7178.2321-3.9617.6539-2.2332-4.0037-6.5085-6.713-11.4184-6.713-7.2174,0-13.0683,5.8509-13.0683,13.0683,0,.0718.0043.1425.0054.214-5.4259.2598-9.7453,4.7405-9.7453,10.2307,0,5.6572,4.586,10.2433,10.2432,10.2433h22.6495" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="12.9166" y1="40.6856" x2="12.9166" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="8.7363" y1="43.7228" x2="12.9166" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="10.333" y1="48.6371" x2="12.9166" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="15.5002" y1="48.6371" x2="12.9166" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="17.097" y1="43.7228" x2="12.9166" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="28.7678" y1="40.6856" x2="28.7678" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="24.5874" y1="43.7228" x2="28.7678" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="26.1842" y1="48.6371" x2="28.7678" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="31.3514" y1="48.6371" x2="28.7678" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="32.9482" y1="43.7228" x2="28.7678" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="44.619" y1="40.6856" x2="44.619" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="40.4386" y1="43.7228" x2="44.619" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="42.0354" y1="48.6371" x2="44.619" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="47.2026" y1="48.6371" x2="44.619" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                            <line x1="48.7994" y1="43.7228" x2="44.619" y2="45.0811" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                        </g>
                    </svg>
                    Snowy
                </p>
            <?php elseif ($info->weatherType === 'cloudy'): ?>
                <p class="weather-info__desc">
                    <svg class="icon" viewBox="0 0 77.2362 48.9505">
                        <path d="m46.275,47.4505h15.5177c7.7009,0,13.9436-6.2427,13.9436-13.9436,0-4.7881-2.4143-9.0113-6.091-11.522-1.986-7.0597-8.467-12.237-16.1616-12.237-1.8872,0-3.6996.316-5.3929.8901-3.04-5.45-8.8596-9.138-15.5433-9.138-9.8247,0-17.7891,7.9645-17.7891,17.7891,0,.0977.0059.194.0074.2913-7.3859.3536-13.2657,6.453-13.2657,13.9265,0,7.7008,6.2427,13.9436,13.9435,13.9436h30.8314" style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                    </svg>
                    Cloudy
                </p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>