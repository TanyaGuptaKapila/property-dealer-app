<form method="POST" action="/create-ad" enctype="multipart/form-data" class="max-w-4xl mx-auto bg-white p-10 rounded shadow mt-10 space-y-10">

	<!-- Step 1: Basic Property -->
	<div class="step">
		<h2 class="text-lg font-bold mb-4">Property Basic Information</h2>
		<select name="transaction_type" required class="w-full border p-2 mb-3">
			<option value="">Transaction Type</option>
			<option>Sell</option>
			<option>Rent/Lease</option>
			<option>PG</option>
		</select>
		<input name="property_type" placeholder="Property Type (e.g., Villa, Apartment)" required class="w-full border p-2 mb-3">
		<select name="availability" required class="w-full border p-2 mb-3">
			<option value="">Availability</option>
			<option>Ready to move</option>
			<option>Under construction</option>
		</select>
		<select name="ownership" required class="w-full border p-2 mb-3">
			<option value="">Ownership</option>
			<option>Freehold</option>
			<option>Leasehold</option>
			<option>Co-operative society</option>
			<option>Power of Attorney</option>
		</select>
		<select name="transaction_status" class="w-full border p-2 mb-3">
			<option>Resale</option>
			<option>New</option>
		</select>
		<input name="title" placeholder="Ad Title" required class="w-full border p-2 mb-3">
		<textarea name="description" placeholder="Describe the property..." required class="w-full border p-2"></textarea>
	</div>

	<!-- Step 2: Location -->
	<div class="step hidden">
		<h2 class="text-lg font-bold mb-4">Location Details</h2>
		<input name="city" placeholder="City" required class="w-full border p-2 mb-3">
		<input name="locality" placeholder="Locality" class="w-full border p-2 mb-3">
		<input name="sub_locality" placeholder="Sub-locality" class="w-full border p-2 mb-3">
		<input name="apartment_society" placeholder="Apartment/Society" class="w-full border p-2 mb-3">
		<input name="house_no" placeholder="House No." class="w-full border p-2 mb-3">
		<input name="latitude" type="number" step="0.0000001" placeholder="Latitude" class="w-full border p-2 mb-3">
		<input name="longitude" type="number" step="0.0000001" placeholder="Longitude" class="w-full border p-2 mb-3">
	</div>

	<!-- Step 3: Area -->
	<div class="step hidden">
		<h2 class="text-lg font-bold mb-4">Area Details</h2>
		<input name="carpet_area" type="number" step="0.01" placeholder="Carpet Area" class="w-full border p-2 mb-3">
		<input name="builtup_area" type="number" step="0.01" placeholder="Built-up Area" class="w-full border p-2 mb-3">
		<input name="super_builtup_area" type="number" step="0.01" placeholder="Super Built-up Area" class="w-full border p-2 mb-3">
		<select name="area_unit" class="w-full border p-2">
			<option>sq.ft.</option>
			<option>sq.m.</option>
		</select>
	</div>

	<!-- Step 4: Rooms -->
	<div class="step hidden">
		<h2 class="text-lg font-bold mb-4">Room Details</h2>
		<input name="bedrooms" type="number" min="0" placeholder="Bedrooms" class="w-full border p-2 mb-3">
		<input name="bathrooms" type="number" min="0" placeholder="Bathrooms" class="w-full border p-2 mb-3">
		<input name="balconies" type="number" min="0" placeholder="Balconies" class="w-full border p-2 mb-3">
		<select name="furnishing" class="w-full border p-2 mb-3">
			<option>Fully Furnished</option>
			<option>Semi Furnished</option>
			<option>Unfurnished</option>
		</select>
		<select name="parking" class="w-full border p-2 mb-3">
			<option>Covered</option>
			<option>Open</option>
			<option>None</option>
		</select>
		<input name="facing" placeholder="Facing (e.g., North-East)" class="w-full border p-2 mb-3">
		<input name="open_sides" type="number" min="0" placeholder="No. of Open Sides" class="w-full border p-2">
	</div>

	<!-- Step 5: Floors -->
	<div class="step hidden">
		<h2 class="text-lg font-bold mb-4">Floor Details</h2>
		<input name="total_floors" type="number" min="0" placeholder="Total Floors" class="w-full border p-2 mb-3">
		<input name="property_on_floor" type="number" min="0" placeholder="Property on Floor" class="w-full border p-2">
	</div>

	<!-- Step 6: Pricing -->
	<div class="step hidden">
		<h2 class="text-lg font-bold mb-4">Pricing Details</h2>
		<input name="expected_price" type="number" placeholder="Expected Price" class="w-full border p-2 mb-3">
		<input name="price_per_sqft" type="number" placeholder="Price per Sq.Ft" class="w-full border p-2 mb-3">
		<input name="price_in_words" placeholder="Price in Words" class="w-full border p-2 mb-3">
		<label><input type="checkbox" name="is_inclusive_price" value="1"> Inclusive Price</label>
		<label><input type="checkbox" name="tax_excluded" value="1"> Exclude Tax</label>
		<label><input type="checkbox" name="price_negotiable" value="1" checked> Negotiable</label>
		<textarea name="additional_pricing" placeholder="Additional Pricing (JSON optional)" class="w-full border p-2 mt-3"></textarea>
	</div>

	<!-- Step 7: Features & Media -->
	<div class="step hidden">
		<h2 class="text-lg font-bold mb-4">Features & Media</h2>
		<input name="feature" placeholder="Feature (e.g., Park Facing)" class="w-full border p-2 mb-3">
		<select name="authority_approved" class="w-full border p-2 mb-3">
			<option>Yes</option>
			<option>No</option>
		</select>
		<input name="possession" placeholder="Possession Date or Status" class="w-full border p-2 mb-3">
		<input type="file" name="media[]" accept="image/*,video/*" multiple class="w-full border p-2">
	</div>

	<!-- Navigation -->
	<div class="flex justify-between mt-6">
		<button type="button" id="prevBtn" class="bg-gray-300 px-4 py-2 rounded">Previous</button>
		<button type="button" id="nextBtn" class="bg-purple-600 text-white px-4 py-2 rounded">Next</button>
	</div>

	<div class="text-center mt-6 hidden" id="submitSection">
		<button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded">Publish Property</button>
	</div>
</form>

<script>
	const steps = document.querySelectorAll('.step');
	let currentStep = 0;

	function showStep(index) {
		steps.forEach((step, idx) => {
			step.classList.toggle('hidden', idx !== index);
		});
		document.getElementById('prevBtn').style.display = index === 0 ? 'none' : 'inline-block';
		document.getElementById('nextBtn').style.display = index === steps.length - 1 ? 'none' : 'inline-block';
		document.getElementById('submitSection').classList.toggle('hidden', index !== steps.length - 1);
	}

	function validateCurrentStep() {
		const requiredFields = steps[currentStep].querySelectorAll('[required]');
		for (let field of requiredFields) {
			if (!field.value.trim()) {
				field.focus();
				return false;
			}
		}
		return true;
	}

	document.getElementById('nextBtn').addEventListener('click', () => {
		if (!validateCurrentStep()) return;
		currentStep++;
		showStep(currentStep);
	});

	document.getElementById('prevBtn').addEventListener('click', () => {
		currentStep--;
		showStep(currentStep);
	});

	showStep(currentStep);
</script>
