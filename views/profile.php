<div class="max-w-4xl mx-auto mt-10 space-y-10">
<?php if (!empty($_SESSION['error'])): ?>
	<div class="bg-red-100 text-red-700 p-3 rounded mb-4">
		<?= htmlspecialchars($_SESSION['error']) ?>
	</div>
	<?php unset($_SESSION['error']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['success'])): ?>
	<div class="bg-green-100 text-green-700 p-4 rounded mb-4">
		<?= htmlspecialchars($_SESSION['success']) ?>
	</div>
	<?php unset($_SESSION['success']); ?>
<?php endif; ?>
</div>
<div class="max-w-4xl mx-auto mt-10 space-y-10">
	<!-- Profile Overview Section -->
	<div class="flex flex-col md:flex-row bg-white shadow rounded-lg overflow-hidden">
		<div class="md:w-1/3 bg-[#6c63ff] flex items-center justify-center p-8">
			<img src="/assets/undraw_profile-image_2hi8.svg" alt="Profile Image" class="w-40 h-40">
		</div>
		<div class="md:w-2/3 p-8">
			<h2 class="text-2xl font-bold text-gray-800 mb-4">Details</h2>
			<p class="text-gray-600 mb-2"><strong>Name:</strong> <?= htmlspecialchars($dealer['name'] ?? '') ?></p>
			<p class="text-gray-600 mb-2"><strong>Email:</strong> <?= htmlspecialchars($dealer['email'] ?? '') ?></p>
			<a href="/profile/edit" class="mt-4 inline-block bg-[#6c63ff] text-white px-6 py-2 rounded hover:bg-[#5a55e5]">
				Edit Profile
			</a>
		</div>
	</div>

	<!-- Change Password Section -->
	<div class="flex flex-col md:flex-row bg-white shadow rounded-lg overflow-hidden">
		<div class="md:w-1/3 bg-[#6c63ff] flex items-center justify-center p-8">
			<img src="/assets/undraw_enter-password_1kl4.svg" alt="Change Password" class="w-40 h-40">
		</div>
		<div class="md:w-2/3 p-8">
			<h2 class="text-2xl font-bold text-gray-800 mb-4">Change Password</h2>
			<form method="POST" action="/profile/password" class="space-y-4">
				<input type="password" name="current_password" placeholder="Current Password" required class="w-full border rounded px-3 py-2">
				<input type="password" name="new_password" placeholder="New Password (Min 9, 1 letter, 1 number)" required
					   pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,}$"
					   title="Minimum 9 characters, with at least 1 letter, 1 number, and 1 special character."
					   class="w-full border rounded px-3 py-2" />
				<input type="password" name="confirm_password" placeholder="Confirm Password (Min 9, 1 letter, 1 number)" required
					   pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,}$"
					   title="Minimum 9 characters, with at least 1 letter, 1 number, and 1 special character."
					   class="w-full border rounded px-3 py-2" />
				<button type="submit" class="w-full bg-[#6c63ff] text-white py-2 rounded">Change Password</button>
			</form>
		</div>
	</div>

</div>
