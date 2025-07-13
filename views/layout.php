<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Estate Link</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

<?php include __DIR__ . '/navbar.php'; ?>

<main class="flex-grow max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
	<?= $content ?>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
