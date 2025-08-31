<?php
$host = 'localhost';
$dbname = 'user_system';
$username = 'root'; // Update based on your MySQL username
$password = ''; // Update based on your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($action === 'signup') {
        if (!empty($username) && !empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);

            try {
                $stmt->execute(['username' => $username,  'password' => $hashedPassword]);
                echo "Sign up successful. <a href='login_signup.html'>Go to login</a>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    } elseif ($action === 'login') {
        if (!empty($username) && !empty($password)) {
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Store user information in session
                $_SESSION['username'] = $user['username'];
                header("Location: index.html"); // Redirect to index2.php
                exit(); // Stop further script execution after redirect
            } else {
                echo "Invalid username or password.";
            }
        }
    }
}
?>
