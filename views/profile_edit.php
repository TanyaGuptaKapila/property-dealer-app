<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">
	<h2 class="text-2xl font-bold text-[#6c63ff] mb-6">Edit Profile</h2>

	<form method="POST" action="/profile/update" enctype="multipart/form-data" class="space-y-6">
		<div class="flex items-center space-x-6">
			<div class="shrink-0">
				<img id="profileImagePreview" class="h-24 w-24 object-cover rounded-full border"
					 src="<?= htmlspecialchars($dealer['profile_picture'] ?? '/assets/undraw_profile-image_2hi8.svg') ?>" alt="Profile Picture" />
			</div>
			<label class="block">
				<span class="sr-only">Choose profile photo</span>
				<input type="file" name="profile_picture" id="profilePictureInput" accept="image/*"
					   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0
                              file:text-sm file:font-semibold file:bg-[#6c63ff] file:text-white hover:file:bg-[#5a55e5]" />
			</label>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			<div>
				<label class="block text-sm mb-1">Name</label>
				<input type="text" name="name" required class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['name'] ?? '') ?>" />
			</div>
			<div>
				<label class="block text-sm mb-1">Email (read-only)</label>
				<input type="email" readonly disabled class="w-full bg-gray-100 border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['email'] ?? '') ?>" />
			</div>
			<div>
				<label class="block text-sm mb-1">Phone</label>
				<input type="text" name="phone" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['phone'] ?? '') ?>" placeholder="+491234567890" />
			</div>
			<div>
				<label class="block text-sm mb-1">Agency Name</label>
				<input type="text" name="agency_name" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['agency_name'] ?? '') ?>" />
			</div>
			<div>
				<label class="block text-sm mb-1">Location (City)</label>
				<input type="text" name="location" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['location'] ?? '') ?>" />
			</div>
			<div>
				<label class="block text-sm mb-1">State</label>
				<input type="text" name="state" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['state'] ?? '') ?>" />
			</div>
			<div>
				<label class="block text-sm mb-1">Country</label>
				<input type="text" name="country" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['country'] ?? '') ?>" />
			</div>
			<div>
				<label class="block text-sm mb-1">Office Address</label>
				<input type="text" name="office_address" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['office_address'] ?? '') ?>" />
			</div>
		</div>

		<h3 class="text-lg font-semibold text-gray-700 mt-6">Social Links</h3>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			<div>
				<label class="block text-sm mb-1">Instagram</label>
				<input type="text" name="instagram_link" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['instagram_link'] ?? '') ?>" />
			</div>
			<div>
				<label class="block text-sm mb-1">Facebook</label>
				<input type="text" name="facebook_link" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['facebook_link'] ?? '') ?>" />
			</div>
			<div>
				<label class="block text-sm mb-1">YouTube</label>
				<input type="text" name="youtube_link" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['youtube_link'] ?? '') ?>" />
			</div>
			<div>
				<label class="block text-sm mb-1">WhatsApp Number</label>
				<input type="text" name="whatsapp_number" class="w-full border rounded px-3 py-2"
					   value="<?= htmlspecialchars($dealer['whatsapp_number'] ?? '') ?>" placeholder="+491234567890" />
			</div>
		</div>

		<button type="submit" class="w-full bg-[#6c63ff] text-white py-2 rounded hover:bg-[#5a55e5]">Save Changes</button>
	</form>
</div>

<script>
	const input = document.getElementById('profilePictureInput');
	const preview = document.getElementById('profileImagePreview');
	input.addEventListener('change', (e) => {
		const file = e.target.files[0];
		if (file) {
			preview.src = URL.createObjectURL(file);
		}
	});
</script>
