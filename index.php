<?php

require __DIR__ . '/layout/header.php';

$alphabets = generateAlphabets();

$searchedAlphabet = $_GET['char'] ?? '';
$query = strtoupper($searchedAlphabet);

/**
 * Fetch names by starting alphabet
 */
function getNamesByAlphabet(PDO $pdo, string $query): array
{

  if ($query === '') {
    $stmt = $pdo->query(
      'SELECT DISTINCT `name`
             FROM `names`
             ORDER BY `name` ASC'
    );
  } else {

    $stmt = $pdo->prepare(
      'SELECT DISTINCT `name`
         FROM `names`
         WHERE `name` LIKE :expr
         ORDER BY `name` ASC'
    );

    $stmt->execute([
      ':expr' => $query . '%'
    ]);
  }

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Call the function
$results = [];

if (!empty($query)) {
  $results = getNamesByAlphabet($pdo, $query);
}

?>

<!-- Hero -->
<section class="py-24">
  <div class="max-w-5xl mx-auto px-6 text-center">

    <h2 class="text-5xl font-bold mb-6">
      Explore and Find Names
    </h2>

    <p class="text-gray-600 text-lg mb-10 max-w-2xl mx-auto">
      A simple project to search names alphabetically,
      discover common names, and practice PHP basics.
    </p>

    <!-- Alphabet -->
    <div class="flex flex-wrap justify-center gap-3">

      <?php foreach ($alphabets as $alphabet): ?>
        <a
          href="index.php?char=<?php echo e($alphabet); ?>"
          class="border px-4 py-2 rounded <?php echo $query === $alphabet ? 'bg-red-500 text-white' : ''; ?>">
          <?php echo e($alphabet); ?>
        </a>
      <?php endforeach; ?>

    </div>

    <?php if (!empty($results)): ?>

      <div class="mt-10">
        <h3 class="text-2xl font-semibold mb-6">
          Names starting with "<?php echo e($query); ?>"
        </h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

          <?php foreach ($results as $result): ?>
            <a
              href="#"
              class="block p-3 bg-white border rounded-lg shadow-sm hover:shadow-md">
              <?php echo e($result['name']); ?>
            </a>
          <?php endforeach; ?>

        </div>
      </div>

    <?php elseif ($searchedAlphabet): ?>

      <div class="mt-10">
        <p class="text-gray-500">
          No names found starting with "<?php echo e($query); ?>"
        </p>
      </div>

    <?php endif; ?>

  </div>
</section>

<?php require __DIR__ . '/layout/footer.php'; ?>