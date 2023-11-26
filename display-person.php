<?php
session_start();
require './templates/header.php';
require './templates/database.php';

if (!isset($_SESSION['user_id'])) {
    header('location: signin.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT role FROM tutor_admin WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && $user['role'] === 'admin') {
    // Fetch tutors' information
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sql = "SELECT * FROM `tutor_info` WHERE fname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM `tutor_info`";
    }

    $result = $conn->query($sql);

    if (!$result) {
        die('Error: ' . $conn->errorInfo()[2]);
    }

    echo '<h1 class="tutor-info-title">TUTOR INFORMATION</h1>';

    $num = $result->rowCount();
    echo '<p class="tutorNumber">Total of tutors: ' . $num . '</p>';
    // Display the search form
    echo '<div class="logout-box">';
    echo '<div class="search-box">';
    echo '<form method="GET" action="display-person.php">';
    echo '<input type="text" name="search" placeholder="Search tutors">';
    echo '<button type="submit">search <i class="fa fa-search"></i></button>';
    echo '<button type="submit">clear</i></button>';
    echo '</form>';
    echo '</div>';
    echo '<div class="button-box">';
    echo '<button class="add-button" type="submit"><a href="create.php">Add info <i class="fa fa-plus"></i></a></button>';
    echo '<a class="logout-button" href="logout.php">Logout</a>';
    echo '</div>';
    echo '</div>';
    echo '<div class="grid-container">';

    if ($num > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="grid-item">';
            if (!empty($row['image'])) {
                echo '<img src="' . $row['image'] . '" alt="Tutor Image" style="width: 200px;">';
            }
        
            echo '<p><strong>First Name:</strong> ' . $row['fname'] . '</p>';
            echo '<p><strong>Last Name:</strong> ' . $row['lname'] . '</p>';
            echo '<p><strong>Email:</strong> ' . $row['email'] . '</p>';
            echo '<p><strong>Phone Number:</strong> ' . $row['phone'] . '</p>';
            echo '<p><strong>Subjects:</strong> ' . $row['subjects'] . '</p>';
            echo '<p><strong>Experience (year):</strong> ' . $row['experience'] . '</p>';
            echo '<p><strong>Rate ($):</strong> ' . $row['rate'] . '</p>';
            echo '<p><strong>Availability:</strong> ' . $row['availability'] . '</p>';

            echo '<a class="edit-button" href="edit.php?id=' . $row['id'] . '">Edit</a>';
            echo '<a class="delete-button" href="delete.php?id=' . $row['id'] . '">Delete</a>';
            echo '</div>';
        }
    } else {
        echo '<p>Record not found. Please try again.</p>';
    }

    echo '</div>';
    echo '</section>';
} else {
    echo '<section class="form-container">';
    echo '<div class="info-box">';
    echo '<div class="signin-wrapper">';
    echo '<p class="save-admin-text">Only admin allowed.</p>';
    echo '<div class="button-index">';
    echo '<button class="button" ><a href="signup.php">Join Us</a></button>';
    echo '<button class="button" ><a href="signin.php">Sign In</a></button>';
    echo '</div>';
    echo '</div>';
    echo '<div class="form-right">';
    echo '<img class="security-right" src="./images/security.png" alt="a man" width="800" height="auto">';
    echo '</div>';
    echo '</div>';
    echo '</section>';
}

// Disconnect
$conn = null;

?>
  <div class="tutor-info-image-box">
    <img class="tutor-info-image" src="./images/research.png" alt="a student prepared for study">
  </div>



<?php require ('./templates/footer.php'); ?>