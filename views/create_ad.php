<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
	<h2 class="text-xl font-bold mb-4">Post New Property</h2>

	<form method="post">
		<div class="mb-4">
			<label class="block font-medium">Title</label>
			<input name="title" required class="w-full border p-2 rounded" placeholder="e.g., 3 BHK Apartment in Gurgaon" />
		</div>

		<div class="mb-4">
			<label class="block font-medium">Description</label>
			<textarea name="description" required class="w-full border p-2 rounded" rows="4" placeholder="Describe your property..."></textarea>
		</div>

		<div class="mb-4">
			<label class="block font-medium">Location / City</label>
			<input name="location" required class="w-full border p-2 rounded" placeholder="e.g., Sector 10, Greater Noida West" />
		</div>

		<div class="mb-4">
			<label class="block font-medium">Price (INR)</label>
			<input name="price" type="number" required min="0" class="w-full border p-2 rounded" placeholder="e.g., 1,16,00,000" />
		</div>

		<div class="flex justify-between">
			<button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Post A Property</button>
			<a href="/ads" class="text-gray-600 hover:underline mt-2">Cancel</a>
		</div>
	</form>
</div>
