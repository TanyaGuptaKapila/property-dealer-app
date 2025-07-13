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

// Login (GET)
$app->get('/login', function (ServerRequestInterface $request, ResponseInterface $response) {
	return render($response, 'login');
});

// Login (POST)
$app->post('/login', function ($request, $response) {
	session_start();
	$params = (array)$request->getParsedBody();

	$email = $params['email'] ?? '';
	$password = $params['password'] ?? '';

	$pdo = $this->get('pdo');

	$stmt = $pdo->prepare("SELECT * FROM dealers WHERE email = ?");
	$stmt->execute([$email]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($user && password_verify($password, $user['password'])) {
		$_SESSION['dealer'] = $user;
		return $response->withHeader('Location', '/ads')->withStatus(302);
	} else {
		$_SESSION['error'] = 'Invalid email or password';
		return $response->withHeader('Location', '/login')->withStatus(302);
	}
});

// Register (GET)
$app->get('/register', function (ServerRequestInterface $request, ResponseInterface $response) {
	return render($response, 'register');
});

// Register (POST)
$app->post('/register', function (ServerRequestInterface $request, ResponseInterface $response) {
	session_start();
	$params = (array)$request->getParsedBody();

	$name        = $params['name'];
	$email       = $params['email'];
	$password    = password_hash($params['password'], PASSWORD_DEFAULT);
	$phone       = $params['phone'];
	$agency_name = $params['agency_name'];
	$location    = $params['location'];
	$created_at  = date('Y-m-d H:i:s');

	$pdo = $this->get('pdo');

	// Validate phone
	if (!preg_match('/^\+\d{10,15}$/', $phone)) {
		$_SESSION['error'] = 'Phone must include country code, e.g., +919876543210';
		return $response->withHeader('Location', '/register')->withStatus(302);
	}

	// Validate password
	if (
		strlen($params['password']) < 8 ||
		!preg_match('/[A-Z]/', $params['password']) ||
		!preg_match('/[a-z]/', $params['password']) ||
		!preg_match('/[0-9]/', $params['password']) ||
		!preg_match('/[\W]/', $params['password'])
	) {
		$_SESSION['error'] = 'Password must be at least 8 characters and include uppercase, lowercase, number, and special character.';
		return $response->withHeader('Location', '/register')->withStatus(302);
	}

	// Check if email exists
	$stmt = $pdo->prepare("SELECT id FROM dealers WHERE email = ?");
	$stmt->execute([$email]);
	if ($stmt->fetch()) {
		$_SESSION['error'] = 'Email already registered';
		return $response->withHeader('Location', '/register')->withStatus(302);
	}

	$stmt = $pdo->prepare("INSERT INTO dealers (name, email, password, phone, agency_name, location, created_at)
		VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->execute([$name, $email, $password, $phone, $agency_name, $location, $created_at]);

	$_SESSION['dealer'] = ['name' => $name, 'email' => $email];

	return $response->withHeader('Location', '/ads')->withStatus(302);
});

// Logout
$app->get('/logout', function (ServerRequestInterface $request, ResponseInterface $response) {
	session_destroy();
	return $response->withHeader('Location', '/')->withStatus(302);
});

// Ads (listings)
$app->get('/ads', function (ServerRequestInterface $request, ResponseInterface $response) {
	if (!isset($_SESSION['dealer'])) {
		return $response->withHeader('Location', '/login')->withStatus(302);
	}
	$pdo = $this->get('pdo');
	$stmt = $pdo->query("SELECT * FROM ads ORDER BY created_at DESC");
	$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return render($response, 'ads', ['ads' => $ads]);
});

// Create Ad (GET)
$app->get('/create-ad', function ($request, $response) {
	if (!isset($_SESSION['dealer'])) {
		return $response->withHeader('Location', '/login')->withStatus(302);
	}
	return render($response, 'create_ad');
});

// Create Ad (POST)
$app->post('/create-ad', function ($request, $response) {
	if (!isset($_SESSION['dealer'])) {
		return $response->withHeader('Location', '/login')->withStatus(302);
	}

	$params = (array)$request->getParsedBody();
	$title = trim($params['title']);
	$description = trim($params['description']);
	$price = (float)$params['price'];
	$location = trim($params['location']);

	// Validation
	if (empty($title) || empty($description) || empty($location) || $price <= 0) {
		$_SESSION['error'] = 'All fields are required and price must be positive.';
		return $response->withHeader('Location', '/create-ad')->withStatus(302);
	}

	$dealerId = $_SESSION['dealer']['id'];
	$pdo = $this->get('pdo');

	$stmt = $pdo->prepare("INSERT INTO ads (dealer_id, title, description, price, location, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
	$stmt->execute([$dealerId, $title, $description, $price, $location]);

	return $response->withHeader('Location', '/ads')->withStatus(302);
});


$app->get('/profile', function (ServerRequestInterface $request, ResponseInterface $response) {
	if (!isset($_SESSION['dealer'])) {
		return $response->withHeader('Location', '/login')->withStatus(302);
	}
	return render($response, 'profile', ['dealer' => $_SESSION['dealer']]);
});

$app->post('/profile/update', function (ServerRequestInterface $request, ResponseInterface $response) {
	session_start();
	if (!isset($_SESSION['dealer'])) {
		return $response->withHeader('Location', '/login')->withStatus(302);
	}

	$params = (array)$request->getParsedBody();
	$pdo    = $this->get('pdo');
	$dealer = $_SESSION['dealer'];

	if (!preg_match('/^\+\d{10,15}$/', $params['phone'])) {
		$_SESSION['error'] = 'Phone must include country code (e.g., +919876543210)';
		return $response->withHeader('Location', '/profile')->withStatus(302);
	}

	$stmt = $pdo->prepare("UPDATE dealers SET name = ?, phone = ?, agency_name = ?, location = ? WHERE id = ?");
	$stmt->execute([
		$params['name'],
		$params['phone'],
		$params['agency_name'],
		$params['location'],
		$dealer['id']
	]);

	// Refresh session
	$stmt = $pdo->prepare("SELECT * FROM dealers WHERE id = ?");
	$stmt->execute([$dealer['id']]);
	$_SESSION['dealer'] = $stmt->fetch(PDO::FETCH_ASSOC);

	$_SESSION['success'] = 'Profile updated successfully';
	return $response->withHeader('Location', '/profile')->withStatus(302);
});

$app->post('/profile/password', function (ServerRequestInterface $request, ResponseInterface $response) {
	session_start();
	if (!isset($_SESSION['dealer'])) {
		return $response->withHeader('Location', '/login')->withStatus(302);
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

	if ($params['new_password'] !== $params['confirm_password']) {
		$_SESSION['error'] = 'New passwords do not match';
		return $response->withHeader('Location', '/profile')->withStatus(302);
	}

	$newHash = password_hash($params['new_password'], PASSWORD_DEFAULT);
	$pdo->prepare("UPDATE dealers SET password = ? WHERE id = ?")->execute([$newHash, $dealer['id']]);

	$_SESSION['success'] = 'Password changed successfully';
	return $response->withHeader('Location', '/profile')->withStatus(302);
});

