<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
	<h2 class="text-2xl font-bold mb-4">Create New Ad</h2>

	<form method="POST" action="/create-ad" class="space-y-4">
		<div>
			<label class="block mb-1 font-medium">Title</label>
			<input type="text" name="title" class="w-full border px-3 py-2 rounded" required>
		</div>

		<div>
			<label class="block mb-1 font-medium">Description</label>
			<textarea name="description" class="w-full border px-3 py-2 rounded" rows="4" required></textarea>
		</div>

		<div>
			<label class="block mb-1 font-medium">Price (INR)</label>
			<input type="number" name="price" step="0.01" class="w-full border px-3 py-2 rounded" required>
		</div>

		<div>
			<label class="block mb-1 font-medium">Location</label>
			<input type="text" name="location" class="w-full border px-3 py-2 rounded" required>
		</div>

		<div class="pt-2">
			<button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Publish</button>
		</div>
	</form>
</div>
