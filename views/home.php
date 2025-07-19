
<style>
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>

<section class="relative bg-gradient-to-r from-green-50 to-green-100">
	<div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-6 py-16">
		<div class="md:w-1/2">
			<h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
				Discover Premium Properties with Ease
			</h1>
			<p class="mt-4 text-gray-600">
				Connect with verified dealers. Explore homes, plots, and commercial spaces across India.
			</p>
			<div class="mt-6">
				<a href="/ad" class="mt-10 bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-8 rounded">
					Post Your Property Today
				</a>
			</div>
		</div>
		<div class="md:w-1/2 mt-10 md:mt-0">
			<img src="/assets/undraw_destination_fkst.svg" alt="Premium Real Estate" class="w-full h-auto">
		</div>
	</div>
</section>

<section class="mt-20 max-w-6xl mx-auto text-center">
	<h2 class="text-3xl font-bold mb-6">Explore Popular Locations</h2>
	<p class="text-gray-500 mb-12">Find properties in the most sought-after cities and neighborhoods.</p>
	<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
		<div class="bg-white shadow rounded-lg p-4 hover:shadow-md">
			<img src="/assets/bangalore.jpg" alt="Location" class="rounded mb-3">
			<h4 class="font-medium">Bangalore</h4>
			<p class="text-sm text-gray-500">1200+ Listings</p>
		</div>
		<div class="bg-white shadow rounded-lg p-4 hover:shadow-md">
			<img src="/assets/gurugram.jpg" alt="Location" class="rounded mb-3">
			<h4 class="font-medium">Gurugram</h4>
			<p class="text-sm text-gray-500">800+ Listings</p>
		</div>
		<div class="bg-white shadow rounded-lg p-4 hover:shadow-md">
			<img src="/assets/mumbai.jpg" alt="Location" class="rounded mb-3">
			<h4 class="font-medium">Mumbai</h4>
			<p class="text-sm text-gray-500">1500+ Listings</p>
		</div>
		<div class="bg-white shadow rounded-lg p-4 hover:shadow-md">
			<img src="/assets/delhi.jpg" alt="Location" class="rounded mb-3">
			<h4 class="font-medium">Delhi</h4>
			<p class="text-sm text-gray-500">1100+ Listings</p>
		</div>
	</div>
</section>

<section class="relative py-20 border-t border-b border-gray-200">
	<div class="max-w-7xl mx-auto grid md:grid-cols-2 items-center gap-12 px-8">
		<!-- Left: Text & Search Form -->
		<!-- Right: Modern Illustration -->
		<div class="flex justify-center">
			<img src="/assets/undraw_buy-house_an72.svg"
				 alt="Search Properties Illustration"
				 class="w-full max-w-md float-animation">
		</div>
		<div>
			<h2 class="text-4xl font-bold text-gray-800 mb-6 leading-tight">
				Find Your Perfect Property <span class="text-green-500">Fast</span>
			</h2>
			<p class="text-gray-600 mb-10">Search residential, commercial, and investment properties in your desired location effortlessly.</p>

			<form action="/ads" method="GET" class="bg-gray-50 p-6 rounded-lg shadow-md space-y-4">
				<input type="text" name="q" placeholder="City, Locality, or Project Name"
					   class="w-full border border-gray-300 p-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400" />

				<div class="flex flex-col md:flex-row gap-4">
					<select name="transaction_type" class="w-full border border-gray-300 p-4 rounded-md">
						<option value="">Transaction Type</option>
						<option>Sell</option>
						<option>Rent/Lease</option>
						<option>PG</option>
					</select>

					<select name="property_type" class="w-full border border-gray-300 p-4 rounded-md">
						<option value="">Property Type</option>
						<option>Apartment</option>
						<option>Villa</option>
						<option>Plot</option>
						<option>Commercial</option>
					</select>
				</div>

				<button type="submit"
						class="w-full md:w-auto bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-md shadow-md">
					🔍 Search Properties
				</button>
			</form>
		</div>
	</div>
</section>

<section class="mt-20 text-center max-w-4xl mx-auto">
	<h2 class="text-gray-500 uppercase text-sm mb-2">How to Get Started</h2>
	<h4 class="text-3xl font-bold mb-8">List Your Property in 3 Easy Steps</h4>

	<div class="flex flex-col items-center gap-16 mt-16 relative">

		<!-- Steps Wrapper -->
		<div class="flex flex-col md:flex-row justify-center items-center gap-24 relative">

			<!-- Step 1 -->
			<div class="text-center max-w-xs">
				<img src="/assets/undraw_upload_cucu.svg" alt="Add Photos" class="mx-auto mb-6 w-60 h-60">
				<h3 class="text-green-600 font-bold text-xl mb-2">01.</h3>
				<h4 class="font-semibold text-lg mb-1">Add Photos & Videos</h4>
				<p class="text-gray-500 text-sm">Easily upload images and videos from your phone or computer to showcase your property.</p>
			</div>

			<!-- Arrow -->
			<div class="hidden md:block absolute left-[30%] top-[50%] -translate-y-1/2 w-24 h-24">
				<svg class="w-full h-full" viewBox="0 0 100 100" fill="none" stroke="#ccc" stroke-width="2">
					<path d="M 0 50 C 50 0, 50 100, 100 50" fill="none" />
				</svg>
			</div>

			<!-- Step 2 -->
			<div class="text-center max-w-xs">
				<img src="/assets/undraw_add-information_06qr.svg" alt="Property Info" class="mx-auto mb-6 w-60 h-60">
				<h3 class="text-green-600 font-bold text-xl mb-2">02.</h3>
				<h4 class="font-semibold text-lg mb-1">Provide Property Information</h4>
				<p class="text-gray-500 text-sm">Share key details like property type, location, size, and room count to get started.</p>
			</div>

			<!-- Arrow -->
			<div class="hidden md:block absolute left-[60%] top-[50%] -translate-y-1/2 w-24 h-24">
				<svg class="w-full h-full" viewBox="0 0 100 100" fill="none" stroke="#ccc" stroke-width="2">
					<path d="M 0 50 C 50 0, 50 100, 100 50" fill="none" />
				</svg>
			</div>

			<!-- Step 3 -->
			<div class="text-center max-w-xs">
				<img src="/assets/undraw_personal-finance_98p3.svg" alt="Set Price" class="mx-auto mb-6 w-60 h-60">
				<h3 class="text-green-600 font-bold text-xl mb-2">03.</h3>
				<h4 class="font-semibold text-lg mb-1">Set Price & Ownership</h4>
				<p class="text-gray-500 text-sm">Complete your listing with ownership details and expected price to publish your ad.</p>
			</div>

		</div>

		<a href="/ad" class="mt-10 bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-8 rounded">
			Post Your Property Today
		</a>

	</div>
</section>
