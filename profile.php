<?php
session_start();
require './templates/header.php';
require './templates/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location:signin.php");
    exit(); // Ensure script execution stops after redirection
}

$user_id = $_SESSION['user_id'];

try {
    $sql = "SELECT * FROM tutor_info WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Display the fetched record
        echo '<h1 class="tutor-info-title">YOUR INFORMATION</h1>';
        echo '<div class="logout-box-profile-page">';
        echo '<a class="logout-button" href="logout.php">Logout</a>';
        echo '</div>';
    
        echo '<div class="info-box">';
        echo '<div class="profile-info-box">';
        
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
        echo '<div>';
        echo '<a class="submit-button" href="edit-profile.php?id=' . $row['id'] . '">Edit</a>';
        echo '<a class="cancel-button" href="delete.php?id=' . $row['id'] . '">Delete</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</section>';
    } else {
        echo "Record not found.";
        echo '<button class="add-button" type="submit"><a href="profile-create.php">Add info <i class="fa fa-plus"></i></a></button>';
        echo'<div class="tutor-info-image-box"><img class="tutor-info-image" src="./images/research.png" alt=""></div>';

    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Disconnect
$conn = null;
?>

<?php require './templates/footer.php'; ?>
