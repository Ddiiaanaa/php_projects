<?php
require __DIR__ . '/inc/functions.inc.php'; 

$city = null;
if (!empty($_GET['city'])) {
    $city = $_GET['city'];
}

$filename = null;
$cityInformation = [];
if (!empty($city)) {
    $cities = json_decode(
        file_get_contents(__DIR__ . '/../data/index.json'),
        true
    );
    foreach ($cities AS $currentCity) {
        if ($currentCity['city'] === $city) {
            $filename = $currentCity['filename'];
            $cityInformation = $currentCity;
            break;
        }
    }
}

if (!empty($filename)) {
    $results = json_decode(
        file_get_contents('compress.bzip2://' . __DIR__ . '/../data/' . $filename),
        true
    )['results'];

    $units = [
        'pm25' => null,
        'pm10' => null
    ];
    foreach ($results AS $result) {
        if (!empty($units['pm25']) && !empty($units['pm10'])) break;
        if ($result['parameter'] === 'pm25') {
            $units['pm25'] = $result['unit'];
        }
        if ($result['parameter'] === 'pm10') {
            $units['pm10'] = $result['unit'];
        }
    }

    $stats = [];
    foreach ($results AS $result) {
        if ($result['parameter'] !== 'pm25' && $result['parameter'] !== 'pm10') continue;
        if ($result['value'] < 0) continue;

        $month = substr($result['date']['local'], 0, 7);
        if (!isset($stats[$month])) {
            $stats[$month] = [
                'pm25' => [],
                'pm10' => []
            ];
        }

        $stats[$month][$result['parameter']][] = $result['value'];
        // var_dump($stats);
        // var_dump($month);
        // break;
    }
    // var_dump($stats);
}

?>

<?php require __DIR__ . '/views/header.inc.php'; ?>
<?php if (empty($city)): ?>
    <p>The city could not be loaded.</p>
<?php else: ?>
    <h1><?php echo e($cityInformation['city']); ?> <?php echo e($cityInformation['flag']); ?></h1>
    <?php if (!empty($stats)): ?>
        <?php /* <pre><?php var_dump(array_keys($stats)); ?></pre> */ ?>
        <canvas id="aqi-chart" style="width: 300px; height: 200px;"></canvas>
        <script src="scripts/chart.umd.js"></script>
        <?php
            $labels = array_keys($stats);
            sort($labels);

            $pm25 = [];
            $pm10 = [];
            foreach ($labels AS $label) {
                $measurements = $stats[$label];
                if (count($measurements['pm25']) !== 0) {
                    $pm25[] = array_sum($measurements['pm25']) / count($measurements['pm25']);
                }
                else {
                    $pm25[] = 0;
                }
                if (count($measurements['pm10']) !== 0) {
                    $pm10[] = array_sum($measurements['pm10']) / count($measurements['pm10']);
                }
                else {
                    $pm10[] = 0;
                }
            }
            // var_dump($pm25);
            $datasets = [];
            if (array_sum($pm25) > 0) {
                $datasets[] = [
                    'label' => "AQI, PM2.5 in {$units['pm25']}",
                    'data' => $pm25,
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1
                ];
            }
            if (array_sum($pm10) > 0) {
                $datasets[] = [
                    'label' => "AQI, PM10 in {$units['pm10']}",
                    'data' => $pm10,
                    'fill' => false,
                    'borderColor' => 'rgb(255, 75, 192)',
                    'tension' => 0.1
                ];
            }
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('aqi-chart');
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: <?php echo json_encode($datasets); ?>
                    }
                });
            });
        </script>

 

 

        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>PM 2.5 concentration</th>
                    <th>PM 10 concentration</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($stats AS $month => $measurements): ?>
                    <tr>
                        <th><?php echo e($month); ?></th>
                        <td>
                            <?php if (count($measurements['pm25']) !== 0): ?>
                                <?php echo e(round(array_sum($measurements['pm25']) / count($measurements['pm25']), 2)); ?>
                                <?php echo e($units['pm25']); ?>
                            <?php else: ?>
                                <i>No data available</i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (count($measurements['pm10']) !== 0): ?>
                                <?php echo e(round(array_sum($measurements['pm10']) / count($measurements['pm10']), 2)); ?>
                                <?php echo e($units['pm10']); ?>
                            <?php else: ?>
                                <i>No data available</i>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>

<?php require __DIR__ . '/views/footer.inc.php'; ?>
