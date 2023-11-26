<?php
// Initializes a session to persist data across multiple requests.
session_start();
require './templates/header.php';
require './templates/database.php';

//Retrieves form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password = hash('sha512', $_POST['password']);
$role = $_POST['role'];

// Perform basic validation to ensure required fields are not empty
if (empty($first_name) || empty($last_name) || empty($username) || empty($password)) {
    echo "All fields are required.";
    exit();
}

// Prepare the SQL statement to insert data into the tutor_admin table
$sql = "INSERT INTO tutor_admin (first_name, last_name, username, password, role) VALUES (:first_name, :last_name, :username, :password, :role)";
//Sets up an SQL query using prepared statements to prevent SQL injection.

$stmt = $conn->prepare($sql);

//Binds the form data to the SQL query placeholders and executes the query
$stmt->bindParam(':first_name', $first_name);
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':role', $role);

// Execute the statement and check for success
$result = $stmt->execute();

if (!$result) {
    echo "Error inserting data: " . $stmt->errorInfo()[2];
    exit();
}

$user_id = $conn->lastInsertId();

$_SESSION['user_id'] = $user_id;

// Redirect logic
if ($role === 'admin') {
    echo '<section class="form-container">';
    echo '<div class="info-box">';
    echo '<div class="signin-wrapper">';
    echo '<p class="save-admin-text">All set up!</p>';
    echo "<p>Your user ID is: $user_id</p>";
    echo'<br>';
    echo '<a href="display-person.php" class="submit-button">Review</a>';
    echo '</div>';
    echo '<div class="form-right">';
    echo '<img class="security-right" src="./images/research.png" alt="a man" width="400"
 height="auto">';
 echo '</div>';
 echo '</div>';
 echo '</section>';
 
} elseif ($role === 'user') {
    echo '<section class="form-container">';
    echo '<div class="info-box">';
    echo '<div class="signin-wrapper">';
    echo '<p class="save-admin-text">User set up!</p>';
    echo "<p>Your user ID is: $user_id</p>";
    echo'<br>';
    echo '<a href="profile-create.php" class="submit-button">Create your info</a>';
    echo '</div>';
    echo '<div class="form-right">';
    echo '<img class="security-right" src="./images/teacher.png" alt="a man" width="400"
 height="auto">';
 echo '</div>';
 echo '</div>';
 echo '</section>';
 

    exit();

    $conn->exec($sql);
 
		//disconnect
		$conn = null;
}
require './templates/footer.php';
?>



