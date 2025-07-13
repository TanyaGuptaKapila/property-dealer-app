<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Estate Link</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

<?php include __DIR__ . '/navbar.php'; ?>

<main>
	<?= $content ?>
</main>

<!-- 🔔 AUTH MODAL -->
<div id="authModal" class="fixed inset-0 bg-[#6c63ff]/90 flex items-center justify-center hidden z-50">
	<div class="flex w-[1000px] h-[450px] bg-white rounded-lg shadow-lg overflow-hidden">
		<!-- Left Side -->
		<div class="w-1/2 bg-[#6c63ff] flex flex-col items-center justify-center text-white p-6 relative">
			<h2 class="text-2xl font-bold mb-2">Welcome Back!</h2>
			<p class="text-sm text-center mb-6">To keep connected with us, please login with your personal info.</p>
			<button id="showLoginBtn" class="border border-white px-6 py-2 rounded hover:bg-white hover:text-[#6c63ff]">Sign In</button>
			<img src="/assets/undraw_sign-up_z2ku.svg" alt="Welcome Back" class="w-64 h-64 mb-4">
		</div>

		<!-- Right Side: Registration -->
		<div class="w-1/2 bg-white p-10 flex flex-col justify-center">
			<h2 class="text-2xl font-bold mb-6 text-[#6c63ff]">Create Account</h2>
			<form id="registerForm" method="POST" action="/register" class="space-y-4">
				<input type="text" name="name" placeholder="Full Name" required minlength="3"
					   class="w-full border rounded px-3 py-2" />

				<input type="email" name="email" placeholder="Email Address" required
					   class="w-full border rounded px-3 py-2" />

				<input type="password" name="password" placeholder="Password (Min 9, 1 letter, 1 number)" required
					   pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,}$"
					   title="Minimum 9 characters, with at least 1 letter, 1 number, and 1 special character."
					   class="w-full border rounded px-3 py-2" />

				<input type="text" name="phone" placeholder="Phone (e.g., +91XXXXXXXXXX)" required
					   pattern="^\+\d{1,3}\d{6,14}$"
					   title="Start with country code, e.g., +91XXXXXXXXXX"
					   class="w-full border rounded px-3 py-2" />

				<button type="submit" class="w-full bg-[#6c63ff] text-white py-2 rounded">Create Account</button>
			</form>
		</div>
	</div>
	<button id="closeAuthModal" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
</div>


<!-- 🔔 LOGIN MODAL -->
<div id="loginModal" class="fixed inset-0 bg-[#6c63ff]/90 flex items-center justify-center hidden z-50">
	<div class="flex w-[1000px] h-[450px] bg-white rounded-lg shadow-lg overflow-hidden">
		<div class="w-1/2 bg-[#6c63ff] flex flex-col items-center justify-center text-white p-6 relative">
			<h2 class="text-2xl font-bold mb-2">Welcome Back!</h2>
			<p class="text-sm text-center mb-6">Login with your registered account to continue.</p>
			<button id="showRegisterBtn" class="border border-white px-6 py-2 rounded hover:bg-white hover:text-[#6c63ff]">Create Account</button>
			<img src="/assets/undraw_secure-login_m11a.svg" alt="Sign In" class="w-64 h-64 mb-4">
		</div>
		<div class="w-1/2 bg-white p-10 flex flex-col justify-center">
			<h2 class="text-2xl font-bold mb-6 text-[#6c63ff]">Login</h2>
			<form method="POST" action="/login">
				<input type="email" name="email" placeholder="Email Address" required class="w-full border rounded px-3 py-2 mb-4">
				<input type="password" name="password" placeholder="Password" required class="w-full border rounded px-3 py-2 mb-4">
				<button type="submit" class="w-full bg-[#6c63ff] text-white py-2 rounded">Login</button>
			</form>
		</div>
	</div>
	<button id="closeLoginModal" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
</div>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		const authModal = document.getElementById('authModal');
		const loginModal = document.getElementById('loginModal');
		const loginRegisterBtn = document.getElementById('loginRegisterBtn');
		const closeAuth = document.getElementById('closeAuthModal');
		const closeLogin = document.getElementById('closeLoginModal');
		const showLoginBtn = document.getElementById('showLoginBtn');
		const showRegisterBtn = document.getElementById('showRegisterBtn');

		loginRegisterBtn?.addEventListener('click', () => {
			loginModal.classList.remove('hidden');
		});
		closeAuth?.addEventListener('click', () => authModal.classList.add('hidden'));
		closeLogin?.addEventListener('click', () => loginModal.classList.add('hidden'));

		showLoginBtn?.addEventListener('click', () => {
			authModal.classList.add('hidden');
			loginModal.classList.remove('hidden');
		});
		showRegisterBtn?.addEventListener('click', () => {
			loginModal.classList.add('hidden');
			authModal.classList.remove('hidden');
		});

		<?php if (!empty($_SESSION['show_modal']) && $_SESSION['show_modal'] === 'register'): ?>
		authModal?.classList.remove('hidden');
		<?php unset($_SESSION['show_modal']); ?>
		<?php elseif (!empty($_SESSION['show_modal']) && $_SESSION['show_modal'] === 'login'): ?>
		loginModal?.classList.remove('hidden');
		<?php unset($_SESSION['show_modal']); ?>
		<?php endif; ?>
	});
</script>


<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
