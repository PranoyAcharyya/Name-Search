<?php

require __DIR__ . '/layout/header.php';

$alphabets = generateAlphabets();

$searchedAlphabet = isset($_GET['char']) ? $_GET['char'] : "";

$query = strtoupper($searchedAlphabet);

$stmt = $pdo->prepare(
  'SELECT DISTINCT `name`
     FROM `names`
     WHERE `name` LIKE :expr
     ORDER BY `name` ASC'
);

$stmt->bindValue(':expr', $query . '%');
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($results);

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

    <!-- Search -->
    <div class="max-w-xl mx-auto flex gap-3 mb-14">

      <input
        type="text"
        placeholder="Search names..."
        class="w-full border border-gray-300 rounded-lg px-4 py-3 outline-none focus:border-blue-500" />

      <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-lg">
        Search
      </button>

    </div>

    <!-- Alphabet -->
    <div class="flex flex-wrap justify-center gap-3">

      <?php foreach ($alphabets as $alphabet):  ?>
        <a href="index.php?char=<?php echo e($alphabet); ?>" class="border px-4 py-2 rounded <?php echo $query === $alphabet ? 'bg-red-500 text-white' : ''; ?> hover:bg-blue-600 hover:text-white"><?php echo e($alphabet); ?></a>
      <?php endforeach; ?>


    </div>

    <div id="results"></div>

    <?php if (!empty($results)): ?>
      <div class="mt-10">
        <h3 class="text-2xl font-semibold mb-6">
          Names starting with "<?php echo e($query); ?>"
        </h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
          <?php foreach ($results as $result): ?>
            <a
              href="#"
              class="block p-3 bg-white border rounded-lg shadow-sm hover:shadow-md hover:bg-blue-50 transition">
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

<!-- Simple Info Section -->
<section class="bg-white border-y">
  <div class="max-w-5xl mx-auto px-6 py-20 grid md:grid-cols-3 gap-8 text-center">

    <div class="p-6 border rounded-xl">
      <h3 class="text-3xl font-bold text-blue-600 mb-2">5000+</h3>
      <p class="text-gray-600">Names Available</p>
    </div>

    <div class="p-6 border rounded-xl">
      <h3 class="text-3xl font-bold text-blue-600 mb-2">A - Z</h3>
      <p class="text-gray-600">Alphabet Search</p>
    </div>

    <div class="p-6 border rounded-xl">
      <h3 class="text-3xl font-bold text-blue-600 mb-2">PHP</h3>
      <p class="text-gray-600">Practice Project</p>
    </div>

  </div>
</section>
<?php

require __DIR__ . '/layout/footer.php';

?>