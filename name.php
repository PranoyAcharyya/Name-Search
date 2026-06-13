<?php

require __DIR__ . '/layout/header.php';

require __DIR__.'/utility/namedetails.inc.php';

$queryName = $_GET['name'];

$result = getNameDetails($pdo,$queryName);

?>



<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-4">
        <a href="index.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
    </div>
    

    <?php if(empty($result)): ?>

    <div class="bg-white rounded-2xl shadow-lg p-10 text-center mt-8">
        <h2 class="text-2xl font-bold text-gray-700">
            No data found
        </h2>

        <p class="text-gray-500 mt-2">
            No statistics are available for
            "<?php echo htmlspecialchars($queryName); ?>"
        </p>

        <a href="index.php"
           class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Back to Search
        </a>
    </div>

<?php else: ?>

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-2xl shadow-lg p-8 mb-8">
        <h1 class="text-4xl font-bold">
            Statistics for "<?php echo htmlspecialchars($queryName); ?>"
        </h1>

        <p class="mt-2 text-blue-100">
            Historical popularity data by year
        </p>

        <div class="mt-6 flex gap-8">
            <div>
                <p class="text-blue-100 text-sm">Records</p>
                <p class="text-2xl font-bold">
                    <?php echo count($result); ?>
                </p>
            </div>

            <div>
                <p class="text-blue-100 text-sm">First Year</p>
                <p class="text-2xl font-bold">
                    <?php echo $result[0]['year']; ?>
                </p>
            </div>

            <div>
                <p class="text-blue-100 text-sm">Last Year</p>
                <p class="text-2xl font-bold">
                    <?php echo end($result)['year']; ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">
        Popularity Trend
    </h2>

    <canvas id="nameChart"></canvas>




</div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <div class="px-6 py-4 border-b bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800">
                Year-wise Popularity
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">

                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="px-6 py-4 text-left">ID</th>
                        <th class="px-6 py-4 text-left">Name</th>
                        <th class="px-6 py-4 text-left">Year</th>
                        <th class="px-6 py-4 text-left">Birth Count</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach($result as $row): ?>

                    <tr class="border-b hover:bg-blue-50 transition duration-200">

                        <td class="px-6 py-4">
                            <?php echo $row['id']; ?>
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-800">
                            <?php echo htmlspecialchars($row['name']); ?>
                        </td>

                        <td class="px-6 py-4">
                            <?php echo $row['year']; ?>
                        </td>

                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                <?php echo number_format($row['count']); ?>
                            </span>
                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>
    </div>



</div>

<?php endif; ?>

<?php
$years = [];
$counts = [];

foreach($result as $row){
    $years[] = $row['year'];
    $counts[] = $row['count'];
}
?>

<script>

const years = <?php echo json_encode($years); ?>;
const counts = <?php echo json_encode($counts); ?>;

const ctx = document.getElementById('nameChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: years,
        datasets: [{
            label: 'Birth Count',
            data: counts,
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        },
        scales: {
            y: {
                beginAtZero: false
            }
        }
    }
});

</script>

<?php

require __DIR__ . '/layout/footer.php';

?>