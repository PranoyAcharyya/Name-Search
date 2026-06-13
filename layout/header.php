<?php

require __DIR__.'/../utility/all.inc.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Name Explorer</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

  <!-- Header -->
  <header class="border-b bg-white">
    <div class="max-w-5xl mx-auto px-6 py-5 flex items-center justify-between">

      <h1 class="text-3xl font-bold text-blue-700">
        Name Explorer
      </h1>

      <nav class="flex items-center gap-6 text-sm">
        <a href="#" class="hover:text-blue-600">Home</a>
        <a href="#" class="hover:text-blue-600">About</a>
        <a href="#" class="hover:text-blue-600">Names</a>
      </nav>

    </div>
  </header>