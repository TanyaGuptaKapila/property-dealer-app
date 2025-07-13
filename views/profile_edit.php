<div class="max-w-3xl mx-auto mt-10 bg-white shadow rounded-lg p-8">
	<h2 class="text-2xl font-bold mb-6 text-[#6c63ff]">Edit Profile</h2>

	<form method="POST" action="/profile/update" enctype="multipart/form-data" class="space-y-4">

		<!-- Profile Picture Upload -->
		<div class="flex items-center space-x-4">
			<div class="w-20 h-20 rounded-full bg-gray-200 overflow-hidden">
				<img id="profilePreview"
					 src="<?= htmlspecialchars($dealer['profile_picture'] ?? '/assets/default-profile.png') ?>"
					 alt="Profile Picture"
					 class="w-20 h-20 object-cover">
			</div>
			<input type="file" name="profile_picture" id="profilePictureInput" accept="image/*" class="text-sm">
		</div>
		<script>
			document.getElementById('profilePictureInput').addEventListener('change', function(event) {
				const file = event.target.files[0];
				if (file) {
					const preview = document.getElementById('profilePreview');
					preview.src = URL.createObjectURL(file);
				}
			});
		</script>

		<input type="text" name="name" value="<?= htmlspecialchars($dealer['name'] ?? '') ?>" placeholder="Full Name" class="w-full border rounded px-3 py-2">

		<input type="text" name="phone" value="<?= htmlspecialchars($dealer['phone'] ?? '') ?>" placeholder="Phone (with country code)" class="w-full border rounded px-3 py-2">

		<input type="text" name="agency_name" value="<?= htmlspecialchars($dealer['agency_name'] ?? '') ?>" placeholder="Agency Name" class="w-full border rounded px-3 py-2">

		<input type="text" name="location" value="<?= htmlspecialchars($dealer['location'] ?? '') ?>" placeholder="Location / City" class="w-full border rounded px-3 py-2">

		<input type="text" name="state" value="<?= htmlspecialchars($dealer['state'] ?? '') ?>" placeholder="State" class="w-full border rounded px-3 py-2">

		<input type="text" name="country" value="<?= htmlspecialchars($dealer['country'] ?? '') ?>" placeholder="Country" class="w-full border rounded px-3 py-2">

		<input type="text" name="office_address" value="<?= htmlspecialchars($dealer['office_address'] ?? '') ?>" placeholder="Office Address (Street, etc.)" class="w-full border rounded px-3 py-2">

		<input type="url" name="instagram_link" value="<?= htmlspecialchars($dealer['instagram_link'] ?? '') ?>" placeholder="Instagram Profile URL" class="w-full border rounded px-3 py-2">

		<input type="url" name="facebook_link" value="<?= htmlspecialchars($dealer['facebook_link'] ?? '') ?>" placeholder="Facebook Profile URL" class="w-full border rounded px-3 py-2">

		<input type="url" name="youtube_link" value="<?= htmlspecialchars($dealer['youtube_link'] ?? '') ?>" placeholder="YouTube Channel URL" class="w-full border rounded px-3 py-2">

		<input type="text" name="whatsapp_number" value="<?= htmlspecialchars($dealer['whatsapp_number'] ?? '') ?>" placeholder="WhatsApp Number (with country code)" class="w-full border rounded px-3 py-2">

		<button type="submit" class="w-full bg-[#6c63ff] text-white py-2 rounded hover:bg-[#554dd3]">Save Changes</button>
	</form>
</div>
