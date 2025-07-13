<h1 class="text-xl font-bold mb-4">Login</h1>

<?php if (!empty($_SESSION['error'])): ?>
	<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
		<?= $_SESSION['error']; unset($_SESSION['error']); ?>
	</div>
<?php endif; ?>

<form method="post">
	<input name="email" type="email" placeholder="Email" required class="w-full mb-2 p-2 border" />
	<input name="password" type="password" placeholder="Password" required class="w-full mb-4 p-2 border" />
	<button class="bg-green-500 text-white px-4 py-2 rounded w-full">Login</button>
</form>
