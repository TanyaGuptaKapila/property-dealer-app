<div class='max-w-md mx-auto mt-10 p-6 bg-white rounded shadow'>
	<h1 class='text-xl mb-4 font-bold'>Register as Dealer</h1>

	<?php if( !empty( $_SESSION[ 'error' ] ) ): ?>
		<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
			<?php echo $_SESSION[ 'error' ];
			unset( $_SESSION[ 'error' ] ); ?>
		</div>
	<?php endif; ?>

	<?php if( !empty( $_SESSION[ 'success' ] ) ): ?>
		<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
			<?php echo $_SESSION[ 'success' ];
			unset( $_SESSION[ 'success' ] ); ?>
		</div>
	<?php endif; ?>

	<form method='post'>
		<input name='name' placeholder='Full Name' required class='w-full mb-2 p-2 border'/>
		<input name='email' type='email' placeholder='Email' required class='w-full mb-2 p-2 border'/>
		<input type="password" placeholder='Password' name="password"
			   pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}"
			   title="At least 8 characters, including uppercase, lowercase, number, and special character."
			   class='w-full mb-2 p-2 border' required/>
		<input type="text" name="phone" placeholder='Phone Number'
			   pattern="^\+\d{10,15}$"
			   title="Must include country code (e.g., +919876543210)"
			   class='w-full mb-2 p-2 border' required/>
		<input name='agency_name' placeholder='Agency Name' class='w-full mb-2 p-2 border'/>
		<input name='location' placeholder='City/Location' class='w-full mb-4 p-2 border'/>
		<button class='bg-green-500 text-white px-4 py-2 rounded'>Register</button>
	</form>
</div>