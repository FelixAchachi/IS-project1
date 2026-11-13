<?php
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT password FROM users WHERE username = ?"
    );

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit();
        }
    }

    $message = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
</head>
<body>
    <h2>Student Login</h2>

    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p><?php echo htmlspecialchars($message); ?></p>

    <a href="signup.php">Create an account</a>
</body>
</html>
