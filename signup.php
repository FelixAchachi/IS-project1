<?php
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $fullname = trim($_POST["fullname"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (username, fullname, password) VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sss", $username, $fullname, $password);

    if ($stmt->execute()) {
        $message = "Registration successful!";
    } else {
        $message = "Registration failed: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Signup</title>
</head>
<body>
    <h2>Student Registration</h2>

    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Full Name:</label><br>
        <input type="text" name="fullname" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Sign Up</button>
    </form>

    <p><?php echo htmlspecialchars($message); ?></p>

    <a href="login.php">Already registered? Login</a>
</body>
</html>
