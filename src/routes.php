<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

function render(ResponseInterface $response, string $viewName, array $params = []): ResponseInterface {
	$layoutPath = __DIR__ . '/../views/layout.php';
	$viewPath   = __DIR__ . '/../views/' . $viewName . '.php';

	// Extract variables to be used inside views
	extract($params);

	// Start output buffering
	ob_start();
	include $viewPath;
	$content = ob_get_clean();

	ob_start();
	include $layoutPath;
	$finalOutput = ob_get_clean();

	$response->getBody()->write($finalOutput);
	return $response;
}

// Home
$app->get('/', function ($request, $response) {
	return render($response, 'home');
});

// About Us
$app->get('/about', function (ServerRequestInterface $request, ResponseInterface $response) {
	return render($response, 'about');
});

// Login (POST)
$app->post('/login', function ($request, $response) {
	session_start();
	$params = (array)$request->getParsedBody();

	$email = $params['email'] ?? '';
	$password = $params['password'] ?? '';

	$_SESSION['form_data'] = $params;

	$pdo = $this->get('pdo');
	$stmt = $pdo->prepare("SELECT * FROM dealers WHERE email = ?");
	$stmt->execute([$email]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($user && password_verify($password, $user['password'])) {
		unset($_SESSION['form_data']);
		$_SESSION['dealer'] = $user;
		return $response->withHeader('Location', '/')->withStatus(302);
	} else {
		$_SESSION['error'] = 'Invalid email or password';
		$_SESSION['show_modal'] = 'login';
		return $response->withHeader('Location', '/')->withStatus(302);
	}
});

// Register (POST)
$app->post('/register', function (ServerRequestInterface $request, ResponseInterface $response) {
	session_start();
	$params = (array)$request->getParsedBody();

	$name        = $params['name'] ?? '';
	$email       = $params['email'] ?? '';
	$passwordRaw = $params['password'] ?? '';
	$phone       = $params['phone'] ?? '';
	$agency_name = $params['agency_name'] ?? '';
	$location    = $params['location'] ?? '';
	$created_at  = date('Y-m-d H:i:s');

	$pdo = $this->get('pdo');

	// Validate phone
	if (!preg_match('/^\+\d{10,15}$/', $phone)) {
		$_SESSION['error'] = 'Phone must include country code, e.g., +919876543210';
		$_SESSION['show_modal'] = 'register';
		return $response->withHeader('Location', '/')->withStatus(302);
	}

	// Validate password
	if (
		strlen($passwordRaw) < 8 ||
		!preg_match('/[A-Z]/', $passwordRaw) ||
		!preg_match('/[a-z]/', $passwordRaw) ||
		!preg_match('/[0-9]/', $passwordRaw) ||
		!preg_match('/[\W]/', $passwordRaw)
	) {
		$_SESSION['error'] = 'Password must be at least 8 characters and include uppercase, lowercase, number, and special character.';
		$_SESSION['show_modal'] = 'register';
		return $response->withHeader('Location', '/')->withStatus(302);
	}

	// Check if email exists
	$stmt = $pdo->prepare("SELECT id FROM dealers WHERE email = ?");
	$stmt->execute([$email]);
	if ($stmt->fetch()) {
		$_SESSION['error'] = 'Email already registered';
		$_SESSION['show_modal'] = 'register';
		return $response->withHeader('Location', '/')->withStatus(302);
	}

	$password = password_hash($passwordRaw, PASSWORD_DEFAULT);
	$stmt = $pdo->prepare("INSERT INTO dealers (name, email, password, phone, agency_name, location, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->execute([$name, $email, $password, $phone, $agency_name, $location, $created_at]);

	$_SESSION['dealer'] = ['name' => $name, 'email' => $email];
	unset($_SESSION['show_modal']);

	return $response->withHeader('Location', '/')->withStatus(302);
});

// Logout
$app->get('/logout', function (ServerRequestInterface $request, ResponseInterface $response) {
	session_destroy();
	return $response->withHeader('Location', '/')->withStatus(302);
});

// Ads (listings)
$app->get('/ads', function (ServerRequestInterface $request, ResponseInterface $response) {
	if (!isset($_SESSION['dealer'])) {
		$_SESSION['show_modal'] = 'login';
		return $response->withHeader('Location', '/')->withStatus(302);
	}
	$pdo = $this->get('pdo');
	$stmt = $pdo->query("SELECT * FROM ads ORDER BY created_at DESC");
	$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return render($response, 'ads', ['ads' => $ads]);
});

$app->get('/profile', function (ServerRequestInterface $request, ResponseInterface $response) {
	if (!isset($_SESSION['dealer'])) {
		$_SESSION['show_modal'] = 'login';
		return $response->withHeader('Location', '/')->withStatus(302);
	}
	return render($response, 'profile', ['dealer' => $_SESSION['dealer']]);
});

$app->post('/profile/password', function (ServerRequestInterface $request, ResponseInterface $response) {
	session_start();
	if (!isset($_SESSION['dealer'])) {
		$_SESSION['show_modal'] = 'login';
		return $response->withHeader('Location', '/')->withStatus(302);
	}

	$params = (array)$request->getParsedBody();
	$pdo    = $this->get('pdo');
	$dealer = $_SESSION['dealer'];

	if (empty($params['current_password']) || empty($params['new_password']) || empty($params['confirm_password'])) {
		$_SESSION['error'] = 'Please fill all password fields';
		return $response->withHeader('Location', '/profile')->withStatus(302);
	}

	if (strlen($params['new_password']) < 8 ||
		!preg_match('/[A-Z]/', $params['new_password']) ||
		!preg_match('/[a-z]/', $params['new_password']) ||
		!preg_match('/[0-9]/', $params['new_password']) ||
		!preg_match('/[\W]/', $params['new_password'])) {

		$_SESSION['error'] = 'Password must be at least 8 characters long and include uppercase, lowercase, digit, and special character.';
		return $response->withHeader('Location', '/profile')->withStatus(302);
	}

	if (!password_verify($params['current_password'], $dealer['password'])) {
		$_SESSION['error'] = 'Current password is incorrect';
		return $response->withHeader('Location', '/profile')->withStatus(302);
	}

	if (password_verify($params['new_password'], $dealer['password'])) {
		$_SESSION['error'] = 'New password cannot be the same as the current password';
		return $response->withHeader('Location', '/profile')->withStatus(302);
	}

	if ($params['new_password'] !== $params['confirm_password']) {
		$_SESSION['error'] = 'New passwords do not match';
		return $response->withHeader('Location', '/profile')->withStatus(302);
	}

	$newHash = password_hash($params['new_password'], PASSWORD_DEFAULT);
	$pdo->prepare("UPDATE dealers SET password = ? WHERE id = ?")->execute([$newHash, $dealer['id']]);

	$_SESSION['success'] = 'Password changed successfully';
	return $response->withHeader('Location', '/profile')->withStatus(302);
});

$app->get('/profile/edit', function ($request, $response) {
	if (!isset($_SESSION['dealer'])) {
		return $response->withHeader('Location', '/login')->withStatus(302);
	}
	return render($response, 'profile_edit', ['dealer' => $_SESSION['dealer']]);
});

$app->post('/profile/update', function ($request, $response) {
	session_start();
	if (!isset($_SESSION['dealer'])) {
		$_SESSION['show_modal'] = 'login';
		return $response->withHeader('Location', '/')->withStatus(302);
	}

	$params = $request->getParsedBody();
	$files = $request->getUploadedFiles();
	$dealer = $_SESSION['dealer'];

	$pdo = $this->get('pdo');

	// Handle profile picture upload if provided
	$profilePicturePath = $dealer['profile_picture'] ?? null;
	if (!empty($files['profile_picture']) && $files['profile_picture']->getError() === UPLOAD_ERR_OK) {
		$uploadedFile = $files['profile_picture'];
		$filename = uniqid() . '_' . $uploadedFile->getClientFilename();
		$uploadPath = __DIR__ . '/../public/uploads/' . $filename;
		$uploadedFile->moveTo($uploadPath);
		$profilePicturePath = '/uploads/' . $filename;
	}

	$stmt = $pdo->prepare("
        UPDATE dealers SET 
            name = ?, 
            phone = ?, 
            agency_name = ?, 
            location = ?, 
            state = ?, 
            country = ?, 
            office_address = ?, 
            instagram_link = ?, 
            facebook_link = ?, 
            youtube_link = ?, 
            whatsapp_number = ?, 
            profile_picture = ?
        WHERE id = ?
    ");
	$stmt->execute([
		$params['name'] ?? '',
		$params['phone'] ?? '',
		$params['agency_name'] ?? '',
		$params['location'] ?? '',
		$params['state'] ?? '',
		$params['country'] ?? '',
		$params['office_address'] ?? '',
		$params['instagram_link'] ?? '',
		$params['facebook_link'] ?? '',
		$params['youtube_link'] ?? '',
		$params['whatsapp_number'] ?? '',
		$profilePicturePath,
		$dealer['id']
	]);

	// Refresh session with updated dealer data
	$stmt = $pdo->prepare("SELECT * FROM dealers WHERE id = ?");
	$stmt->execute([$dealer['id']]);
	$_SESSION['dealer'] = $stmt->fetch(PDO::FETCH_ASSOC);

	$_SESSION['success'] = 'Profile updated successfully';
	return $response->withHeader('Location', '/profile')->withStatus(302);
});

// Create Ad (GET)
$app->get('/create-ad', function ($request, $response) {
	if (!isset($_SESSION['dealer'])) {
		$_SESSION['show_modal'] = 'login';
		return $response->withHeader('Location', '/')->withStatus(302);
	}
	return render($response, 'create_ad');
});

// Create Ad (POST)
$app->post('/create-ad', function ($request, $response) {
	session_start();
	if (!isset($_SESSION['dealer'])) {
		$_SESSION['show_modal'] = 'login';
		return $response->withHeader('Location', '/')->withStatus(302);
	}

	$params = $request->getParsedBody();
	$files = $request->getUploadedFiles();
	$dealerId = $_SESSION['dealer']['id'];

	$pdo = $this->get('pdo');
	$pdo->beginTransaction();
	try {
		// Properties
		$stmt = $pdo->prepare("INSERT INTO properties (dealer_id, transaction_type, property_type, availability, ownership, transaction_status, title, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->execute([
			$dealerId,
			$params['transaction_type'],
			$params['property_type'],
			$params['availability'],
			$params['ownership'],
			$params['transaction_status'] ?? 'Resale',
			$params['title'],
			$params['description']
		]);
		$propertyId = $pdo->lastInsertId();

		// Location
		$stmt = $pdo->prepare("INSERT INTO property_location (property_id, city, locality, sub_locality, apartment_society, house_no) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->execute([
			$propertyId,
			$params['city'],
			$params['locality'],
			$params['sub_locality'],
			$params['apartment_society'],
			$params['house_no']
		]);

		// Area
		$stmt = $pdo->prepare("INSERT INTO property_area_details (property_id, carpet_area, builtup_area, super_builtup_area, area_unit) VALUES (?, ?, ?, ?, ?)");
		$stmt->execute([
			$propertyId,
			$params['carpet_area'],
			$params['builtup_area'],
			$params['super_builtup_area'],
			$params['area_unit']
		]);

		// Rooms
		$stmt = $pdo->prepare("INSERT INTO property_room_details (property_id, bedrooms, bathrooms, balconies, furnishing, parking, facing, open_sides) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->execute([
			$propertyId,
			$params['bedrooms'],
			$params['bathrooms'],
			$params['balconies'],
			$params['furnishing'],
			$params['parking'],
			$params['facing'],
			$params['open_sides']
		]);

		// Floors
		$stmt = $pdo->prepare("INSERT INTO property_floor_details (property_id, total_floors, property_on_floor) VALUES (?, ?, ?)");
		$stmt->execute([
			$propertyId,
			$params['total_floors'],
			$params['property_on_floor']
		]);

		// Pricing
		$stmt = $pdo->prepare("INSERT INTO property_pricing_details (property_id, expected_price, price_per_sqft, price_in_words, is_inclusive_price, tax_excluded, price_negotiable, additional_pricing) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->execute([
			$propertyId,
			$params['expected_price'],
			$params['price_per_sqft'],
			$params['price_in_words'],
			isset($params['is_inclusive_price']) ? 1 : 0,
			isset($params['tax_excluded']) ? 1 : 0,
			isset($params['price_negotiable']) ? 1 : 0,
			json_encode([
				'maintenance' => $params['maintenance'] ?? null,
				'expected_rental' => $params['expected_rental'] ?? null,
				'booking_amount' => $params['booking_amount'] ?? null
			])
		]);

		// Features
		$stmt = $pdo->prepare("INSERT INTO property_features (property_id, feature, authority_approved, possession) VALUES (?, ?, ?, ?)");
		$stmt->execute([
			$propertyId,
			$params['feature'],
			$params['authority_approved'],
			$params['possession']
		]);

		// Media
		if (!empty($files['media']) && is_array($files['media'])) {
			foreach ($files['media'] as $uploadedFile) {
				if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
					$filename = uniqid() . '_' . $uploadedFile->getClientFilename();
					$uploadedFile->moveTo(__DIR__ . '/../public/uploads/' . $filename);
					$pdo->prepare("INSERT INTO property_media (property_id, media_type, file_path) VALUES (?, ?, ?)")
						->execute([$propertyId, explode('/', $uploadedFile->getClientMediaType())[0], '/uploads/' . $filename]);
				}
			}
		}

		$pdo->commit();
		$_SESSION['success'] = 'Property added successfully';
		return $response->withHeader('Location', '/ads')->withStatus(302);
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = 'Failed to create property.';
        return $response->withHeader('Location', '/create-ad')->withStatus(302);
    }
});
