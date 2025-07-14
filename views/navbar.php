<nav class="bg-white shadow p-4 flex justify-between items-center">
	<div class="flex items-center space-x-6">
		<a href="/" class="text-xl font-bold text-[#6c63ff]">Estate Link</a>
		<a href="/create-ad" class="text-gray-700 hover:text-green-600">Post Property</a>
	</div>

	<div class="flex items-center space-x-6 relative">
		<?php if (!empty($_SESSION['dealer'])): ?>
			<!-- Contact Icon -->
			<div class="relative">
				<button id="contactDropdownButton" class="focus:outline-none">
					<i class="fas fa-headset text-2xl text-[#6c63ff]"></i>
				</button>
				<div id="contactDropdownMenu" class="absolute right-0 mt-2 w-56 bg-white border rounded shadow-lg z-10 hidden">
					<div class="p-4 text-gray-700 text-sm">
						<strong>Contact Us</strong><br>
						Mon–Sat: 9am–6pm<br>
						Toll-Free: 1800-123-4567<br>
						Intl: +91-98765-43210
					</div>
				</div>
			</div>

			<!-- User Icon with dropdown -->
			<div class="relative">
				<button id="userDropdownButton" class="focus:outline-none flex items-center space-x-1">
					<i class="fas fa-user-circle text-2xl text-[#6c63ff]"></i>
				</button>
				<div id="userDropdownMenu" class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-10 hidden">
					<a href="/profile" class="block px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
						<i class="fas fa-user text-gray-500"></i>
						<span>My Profile</span>
					</a>
					<a href="/logout" class="block px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
						<i class="fas fa-sign-out-alt text-gray-500"></i>
						<span>Logout</span>
					</a>
				</div>
			</div>
		<?php else: ?>
			<button id="loginRegisterBtn" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
				Login / Register
			</button>
		<?php endif; ?>
	</div>
</nav>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		const userBtn = document.getElementById('userDropdownButton');
		const userMenu = document.getElementById('userDropdownMenu');
		const contactBtn = document.getElementById('contactDropdownButton');
		const contactMenu = document.getElementById('contactDropdownMenu');

		if (userBtn && userMenu) {
			userBtn.addEventListener('click', (e) => {
				e.stopPropagation();
				userMenu.classList.toggle('hidden');
				contactMenu.classList.add('hidden');
			});
		}
		if (contactBtn && contactMenu) {
			contactBtn.addEventListener('click', (e) => {
				e.stopPropagation();
				contactMenu.classList.toggle('hidden');
				userMenu.classList.add('hidden');
			});
		}
		document.addEventListener('click', () => {
			userMenu.classList.add('hidden');
			contactMenu.classList.add('hidden');
		});
	});
</script>
