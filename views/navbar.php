<nav class="bg-white shadow p-4 flex justify-between items-center">
	<!-- Left side: Logo + Nav Links -->
	<div class="flex items-center space-x-6">
		<a href="/" class="text-xl font-bold text-green-600">Estate Link</a>
		<a href="/create-ad" class="text-gray-700 hover:text-green-600">Post Ad</a>
		<a href="/about" class="text-gray-700 hover:text-green-600">About</a>
	</div>
	<div class="space-x-4 flex items-center relative">
		<?php if (!empty($_SESSION['dealer'])): ?>
			<div class="relative">
				<button id="userDropdownButton" class="text-gray-700 hover:text-green-600 focus:outline-none">
					<?= htmlspecialchars($_SESSION['dealer']['name']) ?> ▼
				</button>
				<div id="userDropdownMenu" class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-10 hidden">
					<a href="/profile" class="block px-4 py-2 hover:bg-gray-100">My Profile</a>
					<a href="/logout" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
				</div>
			</div>
		<?php else: ?>
			<a href="/login" class="text-gray-700 hover:text-green-600">Login</a>
			<a href="/register" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Register</a>
		<?php endif; ?>
	</div>
</nav>

<script>
	// Toggle dropdown visibility
	document.addEventListener('DOMContentLoaded', () => {
		const button = document.getElementById('userDropdownButton');
		const menu = document.getElementById('userDropdownMenu');

		if (button && menu) {
			button.addEventListener('click', (e) => {
				e.stopPropagation(); // Prevent click from bubbling up
				menu.classList.toggle('hidden');
			});

			// Hide dropdown on click outside
			document.addEventListener('click', () => {
				menu.classList.add('hidden');
			});
		}
	});
</script>
