
<!-- Banner -->
<section class="bg-[#e7f8ef] flex justify-center items-center py-2">
	<div class="max-w-4xl flex flex-col md:flex-row items-center justify-between px-8">
		<div class="mb-4 md:mb-0 md:w-1/2">
			<h1 class="text-3xl font-bold text-gray-800 leading-tight mb-3">Post Your Property</h1>
		</div>
		<div class="md:w-1/2">
			<img src="/assets/undraw_best-place_dhzp.svg" alt="Property Posting" class="w-full max-w-xs mx-auto">
		</div>
	</div>
</section>


<form id="uploadForm" method="POST" action="/ad" enctype="multipart/form-data" class="max-w-7xl mx-auto bg-white p-10 rounded shadow mt-10 space-y-10">

	<!-- Section: Basic Property (properties table) -->
	<input type="hidden" name="property_id" value="<?= htmlspecialchars($property['id'] ?? '') ?>">

	<div class="space-y-6">
		<h2 class="text-2xl font-semibold text-gray-700">Property Basics</h2>
		<div class="grid md:grid-cols-2 gap-6">
			<select name="transaction_type" required class="border p-3 rounded w-full">
				<option value="">Transaction Type</option>
				<option <?= ($property['transaction_type'] ?? '') === 'Sell' ? 'selected' : '' ?>>Sell</option>
				<option <?= ($property['transaction_type'] ?? '') === 'Rent/Lease' ? 'selected' : '' ?>>Rent/Lease</option>
				<option <?= ($property['transaction_type'] ?? '') === 'PG' ? 'selected' : '' ?>>PG</option>
			</select>

			<input name="title" value="<?= htmlspecialchars($property['title'] ?? '') ?>" placeholder="Ad Title" required class="border p-3 rounded w-full">

			<input name="property_type" value="<?= htmlspecialchars($property['property_type'] ?? '') ?>" placeholder="Property Type (Villa, Apartment)" required class="border p-3 rounded w-full">

			<select name="ownership" required class="border p-3 rounded w-full">
				<option value="">Ownership</option>
				<option <?= ($property['ownership'] ?? '') === 'Freehold' ? 'selected' : '' ?>>Freehold</option>
				<option <?= ($property['ownership'] ?? '') === 'Leasehold' ? 'selected' : '' ?>>Leasehold</option>
				<option <?= ($property['ownership'] ?? '') === 'Co-operative society' ? 'selected' : '' ?>>Co-operative society</option>
				<option <?= ($property['ownership'] ?? '') === 'Power of Attorney' ? 'selected' : '' ?>>Power of Attorney</option>
			</select>

			<select name="transaction_status" class="border p-3 rounded w-full">
				<option <?= ($property['transaction_status'] ?? '') === 'Resale' ? 'selected' : '' ?>>Resale</option>
				<option <?= ($property['transaction_status'] ?? '') === 'New' ? 'selected' : '' ?>>New</option>
			</select>

			<select name="construction_status" class="border p-3 rounded">
				<option value="">Construction Status</option>
				<option <?= ($property['construction_status'] ?? '') === 'New Launch' ? 'selected' : '' ?>>New Launch</option>
				<option <?= ($property['construction_status'] ?? '') === 'Under Construction' ? 'selected' : '' ?>>Under Construction</option>
				<option <?= ($property['construction_status'] ?? '') === 'Ready to move' ? 'selected' : '' ?>>Ready to move</option>
			</select>

			<select name="property_category" class="border p-3 rounded">
				<option <?= ($property['property_category'] ?? '') === 'Residential Apartment' ? 'selected' : '' ?>>Residential Apartment</option>
				<option <?= ($property['property_category'] ?? '') === 'Independent/Builder Floor' ? 'selected' : '' ?>>Independent/Builder Floor</option>
				<option <?= ($property['property_category'] ?? '') === 'Independent House/Villa' ? 'selected' : '' ?>>Independent House/Villa</option>
				<option <?= ($property['property_category'] ?? '') === 'Residential Land' ? 'selected' : '' ?>>Residential Land</option>
				<option <?= ($property['property_category'] ?? '') === 'Farm House' ? 'selected' : '' ?>>Farm House</option>
				<option <?= ($property['property_category'] ?? '') === 'Serviced Apartments' ? 'selected' : '' ?>>Serviced Apartments</option>
			</select>

			<label>
				<input type="checkbox" name="rera_approved" value="1"
					<?= !empty($property['rera_approved']) ? 'checked' : '' ?>> This property is RERA approved
			</label>
		</div>

		<textarea name="description" placeholder="Describe your property..." required class="border p-3 rounded w-full h-40 resize-none"><?= htmlspecialchars($property['description'] ?? '') ?></textarea>
	</div>

	<!-- Section: Area Details (property_area_details) -->
	<h2 class="text-xl font-bold text-gray-700">Area Details</h2>
	<div class="grid md:grid-cols-4 gap-4">
		<input name="carpet_area" type="number" step="0.01" placeholder="Carpet Area" class="border p-3 rounded"
			   value="<?= htmlspecialchars($area['carpet_area'] ?? '') ?>">

		<input name="builtup_area" type="number" step="0.01" placeholder="Built-up Area" class="border p-3 rounded"
			   value="<?= htmlspecialchars($area['builtup_area'] ?? '') ?>">

		<input name="super_builtup_area" type="number" step="0.01" placeholder="Super Built-up Area" class="border p-3 rounded"
			   value="<?= htmlspecialchars($area['super_builtup_area'] ?? '') ?>">

		<select name="area_unit" class="border p-3 rounded">
			<option <?= ($area['area_unit'] ?? '') === 'sq.ft.' ? 'selected' : '' ?>>sq.ft.</option>
			<option <?= ($area['area_unit'] ?? '') === 'sq.m.' ? 'selected' : '' ?>>sq.m.</option>
		</select>
	</div>

	<h2 class="text-xl font-bold text-gray-700">Society</h2>
	<div class="grid md:grid-cols-2 gap-2">
		<?php
		$societyOptions = [
			"Unity Group The Amaryllis",
			"Marble Arch Apartment",
			"RWA New Rajender Nagar",
			"RWA Joshi Lane",
			"186",
			"3920",
			"Shiv Durga Apartment",
			"Gauri Sadan Apartments",
			"Multi Story Apartments",
			"Ansal Bhawan",
			"Upasna Apartment",
			"DDA R Block"
		];
		foreach ($societyOptions as $option):
			$checked = in_array($option, $societies ?? []) ? 'checked' : '';
			?>
			<label>
				<input type="checkbox" name="society[]" value="<?= htmlspecialchars($option) ?>" <?= $checked ?>> <?= $option ?>
			</label>
		<?php endforeach; ?>
	</div>

	<!-- Section: Room Details (property_room_details) -->
	<h2 class="text-xl font-bold text-gray-700">Room Details</h2>
	<div class="grid md:grid-cols-3 gap-4">
		<input name="bedrooms" type="number" placeholder="Bedrooms" class="border p-3 rounded"
			   value="<?= htmlspecialchars($room['bedrooms'] ?? '') ?>">

		<input name="bathrooms" type="number" placeholder="Bathrooms" class="border p-3 rounded"
			   value="<?= htmlspecialchars($room['bathrooms'] ?? '') ?>">

		<input name="balconies" type="number" placeholder="Balconies" class="border p-3 rounded"
			   value="<?= htmlspecialchars($room['balconies'] ?? '') ?>">

		<select name="furnishing" class="border p-3 rounded">
			<option <?= ($room['furnishing'] ?? '') === 'Fully Furnished' ? 'selected' : '' ?>>Fully Furnished</option>
			<option <?= ($room['furnishing'] ?? '') === 'Semi Furnished' ? 'selected' : '' ?>>Semi Furnished</option>
			<option <?= ($room['furnishing'] ?? '') === 'Unfurnished' ? 'selected' : '' ?>>Unfurnished</option>
		</select>

		<select name="parking" class="border p-3 rounded">
			<option <?= ($room['parking'] ?? '') === 'Covered' ? 'selected' : '' ?>>Covered</option>
			<option <?= ($room['parking'] ?? '') === 'Open' ? 'selected' : '' ?>>Open</option>
			<option <?= ($room['parking'] ?? '') === 'None' ? 'selected' : '' ?>>None</option>
		</select>

		<input name="facing" placeholder="Facing (e.g., North-East)" class="border p-3 rounded"
			   value="<?= htmlspecialchars($room['facing'] ?? '') ?>">

		<input name="open_sides" type="number" placeholder="Open Sides" class="border p-3 rounded"
			   value="<?= htmlspecialchars($room['open_sides'] ?? '') ?>">
	</div>

	<h2 class="text-xl font-bold text-gray-700">Floor Details</h2>
	<div class="grid md:grid-cols-2 gap-4">
		<input name="total_floors" type="number" placeholder="Total Floors" class="border p-3 rounded"
			   value="<?= htmlspecialchars($floor['total_floors'] ?? '') ?>">

		<input name="property_on_floor" type="number" placeholder="Property on Floor" class="border p-3 rounded"
			   value="<?= htmlspecialchars($floor['property_on_floor'] ?? '') ?>">
	</div>

	<h2 class="text-xl font-bold text-gray-700">Pricing Details (Rs)</h2>
	<div class="grid md:grid-cols-2 gap-4">
		<input name="expected_price" type="text" placeholder="Expected Price" class="border p-3 rounded"
			   value="<?= htmlspecialchars($pricing['expected_price'] ?? '') ?>">

		<input name="price_per_sqft" type="text" placeholder="Price per Sq.Ft" class="border p-3 rounded"
			   value="<?= htmlspecialchars($pricing['price_per_sqft'] ?? '') ?>">

		<input name="price_in_words" placeholder="Price in Words" class="border p-3 rounded"
			   value="<?= htmlspecialchars($pricing['price_in_words'] ?? '') ?>">

		<textarea name="additional_pricing" placeholder="Additional Pricing Like Maintenance, Security" class="border p-3 rounded"><?= htmlspecialchars($pricing['additional_pricing'] ?? '') ?></textarea>
	</div>

	<div class="mt-3 flex gap-6">
		<label><input type="checkbox" name="is_inclusive_price" value="1" <?= !empty($pricing['is_inclusive_price']) ? 'checked' : '' ?>> Tax Inclusive Price like taxes, maintenance, registration</label>
		<label><input type="checkbox" name="price_negotiable" value="1" <?= !empty($pricing['price_negotiable']) ? 'checked' : '' ?>> Negotiable</label>
	</div>

	<h2 class="text-xl font-bold text-gray-700">Amenities</h2>
	<div class="grid grid-cols-2 gap-4">
		<?php foreach (['Parking', 'Park', 'Power Backup', 'Vaastu Compliant', 'Gas Pipeline', 'Security Personnel', 'Lift', 'Club House', 'Gymnasium', 'Swimming Pool', 'Guarded Society'] as $amenity): ?>
			<label>
				<input type="checkbox" name="amenities[]" value="<?= $amenity ?>" <?= in_array($amenity, $features ?? []) ? 'checked' : '' ?>> <?= $amenity ?>
			</label>
		<?php endforeach; ?>
	</div>

	<h2 class="text-xl font-bold text-gray-700">Location Details</h2>
	<div class="grid md:grid-cols-2 gap-4">
		<input name="city" placeholder="City" class="border p-3 rounded" value="<?= htmlspecialchars($location['city'] ?? '') ?>">
		<input name="locality" placeholder="Locality" class="border p-3 rounded" value="<?= htmlspecialchars($location['locality'] ?? '') ?>">
		<input name="sub_locality" placeholder="Sub-locality" class="border p-3 rounded" value="<?= htmlspecialchars($location['sub_locality'] ?? '') ?>">
		<input name="apartment_society" placeholder="Apartment/Society" class="border p-3 rounded" value="<?= htmlspecialchars($location['apartment_society'] ?? '') ?>">
		<input name="house_no" placeholder="House No." class="border p-3 rounded" value="<?= htmlspecialchars($location['house_no'] ?? '') ?>">
	</div>

	<h2 class="text-xl font-bold text-gray-700">Photos & Videos (Max 20)</h2>
	<input type="file" id="mediaInput" name="media[]" accept="image/*,video/*" multiple class="border rounded p-3 w-full">
	<div id="previewContainer" class="flex flex-wrap gap-4 mt-4">
		<?php if (!empty($media)): ?>
			<div class="flex flex-wrap gap-4 mt-4">
				<?php foreach ($media as $m): ?>
					<?php if ($m['media_type'] === 'image'): ?>
						<img src="<?= htmlspecialchars($m['file_path']) ?>" class="w-32 h-32 object-cover rounded shadow">
					<?php elseif ($m['media_type'] === 'video'): ?>
						<video src="<?= htmlspecialchars($m['file_path']) ?>" controls class="w-32 h-32 object-cover rounded shadow"></video>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>

	<div class="text-center mt-6">
		<button type="submit" class="bg-[#6c63ff] hover:bg-[#5a55e5] text-white px-8 py-3 rounded shadow">Publish Property</button>
	</div>
</form>

<script>
	const mediaInput = document.getElementById('mediaInput');
	const previewContainer = document.getElementById('previewContainer');
	const uploadForm = document.getElementById('uploadForm');

	let allFiles = [];

	mediaInput.addEventListener('change', (event) => {
		Array.from(event.target.files).forEach(file => {
			const reader = new FileReader();
			reader.onload = function (e) {
				let previewElement;
				if (file.type.startsWith('image/')) {
					previewElement = document.createElement('img');
					previewElement.src = e.target.result;
					previewElement.classList.add('w-32', 'h-32', 'object-cover', 'rounded', 'shadow');
				} else if (file.type.startsWith('video/')) {
					previewElement = document.createElement('video');
					previewElement.src = e.target.result;
					previewElement.controls = true;
					previewElement.classList.add('w-32', 'h-32', 'object-cover', 'rounded', 'shadow');
				}
				previewContainer.appendChild(previewElement);
			};
			reader.readAsDataURL(file);
		});
	});


	uploadForm.addEventListener('submit', function (e) {
		e.preventDefault();
		const formData = new FormData(uploadForm);

		fetch(uploadForm.action, {
			method: 'POST',
			body: formData
		})
		.then(response => {
			if (response.ok) {
				location.href = '/ads';
			}
		})
		.catch(err => console.error(err));
	});

</script>