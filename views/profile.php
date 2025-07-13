<br class='max-w-md mx-auto mt-10 p-6 bg-white rounded shadow'>
	<h2 class="text-xl font-bold mb-4">Edit Profile</h2>
	<!-- Update Info Form -->
	<form action="/profile/update" method="POST" class="space-y-4">
		<div>
			<label>Name</label>
			<input type="text" name="name" value="<?= htmlspecialchars($dealer['name'] ?? '', ENT_QUOTES) ?>" class="w-full border px-3 py-2 rounded">
		</div>

		<div>
			<label>Email (read-only)</label>
			<input type="email" value="<?= htmlspecialchars($dealer['email'] ?? '', ENT_QUOTES) ?>" readonly class="w-full border px-3 py-2 bg-gray-100 rounded">
		</div>

		<div>
			<label>Phone</label>
			<input type="text" name="phone" value="<?= htmlspecialchars($dealer['phone'] ?? '', ENT_QUOTES) ?>"
				   pattern="^\+\d{10,15}$"
				   title="Must start with country code, e.g., +919876543210"
				   class="w-full border px-3 py-2 rounded" required>
		</div>

		<div>
			<label>Agency</label>
			<input type="text" name="agency_name" value="<?= htmlspecialchars($dealer['agency_name'] ?? '', ENT_QUOTES) ?>" class="w-full border px-3 py-2 rounded">
		</div>

		<div>
			<label>Location</label>
			<input type="text" name="location" value="<?= htmlspecialchars($dealer['location'] ?? '', ENT_QUOTES) ?>" class="w-full border px-3 py-2 rounded">
		</div>

		<button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Changes</button>
	</form>

	<!-- Change Password Form -->
	<hr class="my-6">

	<h2 class="text-lg font-semibold">Change Password</h2>
	</br>
	<form action="/profile/password" method="POST" class="space-y-4">
		<div>
			<label>Current Password</label>
			<input type="password" name="current_password" class="w-full border px-3 py-2 rounded">
		</div>

		<div>
			<label>New Password</label>
			<input type="password" name="new_password"
				   pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}"
				   title="At least 8 characters, including uppercase, lowercase, number, and special character."
				   class="w-full border px-3 py-2 rounded" required>
		</div>

		<div>
			<label>Confirm New Password</label>
			<input type="password" name="confirm_password" class="w-full border px-3 py-2 rounded">
		</div>

		<button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Change Password</button>
	</form>

	<a href='/logout' class='inline-block mt-6 text-red-600'>Logout</a>
</div>
