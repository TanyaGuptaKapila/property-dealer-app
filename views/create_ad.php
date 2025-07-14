
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


<form method="POST" action="/create-ad" enctype="multipart/form-data" class="max-w-7xl mx-auto bg-white p-10 rounded shadow mt-10 space-y-10">

	<!-- Section: Basic Property (properties table) -->
	<div class="space-y-6">
		<h2 class="text-2xl font-semibold text-gray-700">Property Basics</h2>
		<div class="grid md:grid-cols-2 gap-6">
			<select name="transaction_type" required class="border p-3 rounded w-full">
				<option value="">Transaction Type</option>
				<option>Sell</option>
				<option>Rent/Lease</option>
				<option>PG</option>
			</select>
			<input name="title" placeholder="Ad Title" required class="border p-3 rounded w-full">
			<input name="property_type" placeholder="Property Type (Villa, Apartment)" required class="border p-3 rounded w-full">

			<select name="availability" required class="border p-3 rounded w-full">
				<option value="">Availability</option>
				<option>Ready to move</option>
				<option>Under construction</option>
			</select>

			<select name="ownership" required class="border p-3 rounded w-full">
				<option value="">Ownership</option>
				<option>Freehold</option>
				<option>Leasehold</option>
				<option>Co-operative society</option>
				<option>Power of Attorney</option>
			</select>

			<select name="transaction_status" class="border p-3 rounded w-full">
				<option>Resale</option>
				<option>New</option>
			</select>

			<select name="construction_status" class="border p-3 rounded">
				<option value="">Construction Status</option>
				<option>New Launch</option>
				<option>Under Construction</option>
				<option>Ready to move</option>
			</select>

			<select name="property_category" class="border p-3 rounded">
				<option>Residential Apartment</option>
				<option>Independent/Builder Floor</option>
				<option>Independent House/Villa</option>
				<option>Residential Land</option>
				<option>Farm House</option>
				<option>Serviced Apartments</option>
			</select>

			<label><input type="checkbox" name="rera_approved" value="1"> This property is RERA approved</label>
		</div>

		<textarea name="description" placeholder="Describe your property..." required class="border p-3 rounded w-full h-40 resize-none"></textarea>
	</div>
	<!-- Section: Area Details (property_area_details) -->
	<h2 class="text-xl font-bold text-gray-700">Area Details</h2>
	<div class="grid md:grid-cols-4 gap-4">
		<input name="carpet_area" type="number" step="0.01" placeholder="Carpet Area" class="border p-3 rounded">
		<input name="builtup_area" type="number" step="0.01" placeholder="Built-up Area" class="border p-3 rounded">
		<input name="super_builtup_area" type="number" step="0.01" placeholder="Super Built-up Area" class="border p-3 rounded">
		<select name="area_unit" class="border p-3 rounded">
			<option>sq.ft.</option>
			<option>sq.m.</option>
		</select>
	</div>

	<h2 class="text-xl font-bold text-gray-700">Society</h2>
	<div class="grid md:grid-cols-2 gap-2">
		<label><input type="checkbox" name="society[]" value="Unity Group The Amaryllis"> Unity Group The Amaryllis</label>
		<label><input type="checkbox" name="society[]" value="Marble Arch Apartment"> Marble Arch Apartment</label>
		<label><input type="checkbox" name="society[]" value="RWA New Rajender Nagar"> RWA New Rajender Nagar</label>
		<label><input type="checkbox" name="society[]" value="RWA Joshi Lane"> RWA Joshi Lane</label>
		<label><input type="checkbox" name="society[]" value="186"> 186</label>
		<label><input type="checkbox" name="society[]" value="3920"> 3920</label>
		<label><input type="checkbox" name="society[]" value="Shiv Durga Apartment"> Shiv Durga Apartment</label>
		<label><input type="checkbox" name="society[]" value="Gauri Sadan Apartments"> Gauri Sadan Apartments</label>
		<label><input type="checkbox" name="society[]" value="Multi Story Apartments"> Multi Story Apartments</label>
		<label><input type="checkbox" name="society[]" value="Ansal Bhawan"> Ansal Bhawan</label>
		<label><input type="checkbox" name="society[]" value="Upasna Apartment"> Upasna Apartment</label>
		<label><input type="checkbox" name="society[]" value="DDA R Block"> DDA R Block</label>
	</div>


	<!-- Section: Room Details (property_room_details) -->
	<h2 class="text-xl font-bold text-gray-700">Room Details</h2>
	<div class="grid md:grid-cols-3 gap-4">
		<input name="bedrooms" type="number" placeholder="Bedrooms" class="border p-3 rounded">
		<input name="bathrooms" type="number" placeholder="Bathrooms" class="border p-3 rounded">
		<input name="balconies" type="number" placeholder="Balconies" class="border p-3 rounded">
		<select name="furnishing" class="border p-3 rounded">
			<option>Fully Furnished</option>
			<option>Semi Furnished</option>
			<option>Unfurnished</option>
		</select>
		<select name="parking" class="border p-3 rounded">
			<option>Covered</option>
			<option>Open</option>
			<option>None</option>
		</select>
		<input name="facing" placeholder="Facing (e.g., North-East)" class="border p-3 rounded">
		<input name="open_sides" type="number" placeholder="Open Sides" class="border p-3 rounded">
	</div>

	<!-- Section: Floor Details (property_floor_details) -->
	<h2 class="text-xl font-bold text-gray-700">Floor Details</h2>
	<div class="grid md:grid-cols-2 gap-4">
		<input name="total_floors" type="number" placeholder="Total Floors" class="border p-3 rounded">
		<input name="property_on_floor" type="number" placeholder="Property on Floor" class="border p-3 rounded">
	</div>

	<!-- Section: Pricing Details (property_pricing_details) -->
	<h2 class="text-xl font-bold text-gray-700">Pricing Details (Rs)</h2>
	<div class="grid md:grid-cols-2 gap-4">
		<input name="expected_price" type="number" placeholder="Expected Price" class="border p-3 rounded">
		<input name="price_per_sqft" type="number" placeholder="Price per Sq.Ft" class="border p-3 rounded">
		<input name="price_in_words" placeholder="Price in Words" class="border p-3 rounded">
		<textarea name="additional_pricing" placeholder="Additional Pricing (JSON optional)" class="border p-3 rounded"></textarea>
	</div>
	<div class="mt-3 flex gap-6">
		<label><input type="checkbox" name="is_inclusive_price" value="1"> Inclusive Price</label>
		<label><input type="checkbox" name="tax_excluded" value="1"> Exclude Tax</label>
		<label><input type="checkbox" name="price_negotiable" value="1" checked> Negotiable</label>
	</div>

	<!-- Section: Features (property_features) -->
	<h2 class="text-xl font-bold text-gray-700">Amenities</h2>
	<div class="grid grid-cols-2 gap-4">
		<label><input type="checkbox" name="amenities[]" value="Parking"> Parking</label>
		<label><input type="checkbox" name="amenities[]" value="Park"> Park</label>
		<label><input type="checkbox" name="amenities[]" value="Power Backup"> Power Backup</label>
		<label><input type="checkbox" name="amenities[]" value="Vaastu Compliant"> Vaastu Compliant</label>
		<label><input type="checkbox" name="amenities[]" value="Gas Pipeline"> Gas Pipeline</label>
		<label><input type="checkbox" name="amenities[]" value="Security Personnel"> Security Personnel</label>
		<label><input type="checkbox" name="amenities[]" value="Lift"> Lift</label>
		<label><input type="checkbox" name="amenities[]" value="Club House"> Club House</label>
		<label><input type="checkbox" name="amenities[]" value="Gymnasium"> Gymnasium</label>
		<label><input type="checkbox" name="amenities[]" value="Swimming Pool"> Swimming Pool</label>
		<label><input type="checkbox" name="amenities[]" value="Guarded Society"> Guarded Society</label>
	</div>

	<!-- Section: Location (property_location) -->
	<h2 class="text-xl font-bold text-gray-700">Location Details</h2>
	<div class="grid md:grid-cols-2 gap-4">
		<input name="city" placeholder="City" class="border p-3 rounded">
		<input name="locality" placeholder="Locality" class="border p-3 rounded">
		<input name="sub_locality" placeholder="Sub-locality" class="border p-3 rounded">
		<input name="apartment_society" placeholder="Apartment/Society" class="border p-3 rounded">
		<input name="house_no" placeholder="House No." class="border p-3 rounded">
	</div>

	<!-- Section: Media (property_media) -->
	<h2 class="text-xl font-bold text-gray-700">Photos & Videos (Max 20)</h2>
	<input type="file" id="mediaInput" name="media[]" accept="image/*,video/*" multiple class="border rounded p-3 w-full">
	<div id="previewContainer" class="flex flex-wrap gap-4 mt-4"></div>

	<script>
		document.getElementById('mediaInput').addEventListener('change', function(event) {
			const previewContainer = document.getElementById('previewContainer');
			previewContainer.innerHTML = ''; // Clear previous thumbnails

			Array.from(event.target.files).forEach(file => {
				const reader = new FileReader();
				reader.onload = function(e) {
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
	</script>


	<div class="text-center mt-6">
		<button type="submit" class="bg-[#6c63ff] hover:bg-[#5a55e5] text-white px-8 py-3 rounded shadow">Publish Property</button>
	</div>
</form>

