<?php
// Database connection using mysqli
$host = 'localhost';  // Your database host
$dbname = 'dynamic_selection';  // Your database name
$username = 'root';  // Your database username
$password = '';  // Your database password

$mysqli = new mysqli($host, $username, $password, $dbname);

// Check for connection error
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle AJAX requests for class and subject selection
if (isset($_POST['type'])) {
    $type = $_POST['type'];

    if ($type == 'class') {
        $level = $_POST['level'];
        $stmt = $mysqli->prepare("SELECT DISTINCT class FROM level_class_subject WHERE level = ?");
        $stmt->bind_param("s", $level);
        $stmt->execute();
        $result = $stmt->get_result();

        echo '<option value="">Select Class</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['class'].'">'.$row['class'].'</option>';
        }

        $stmt->close();
    }

    if ($type == 'subject') {
        $class = $_POST['class'];
        $stmt = $mysqli->prepare("SELECT subject FROM level_class_subject WHERE class = ?");
        $stmt->bind_param("s", $class);
        $stmt->execute();
        $result = $stmt->get_result();

        echo '<option value="">Select Subject</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['subject'].'">'.$row['subject'].'</option>';
        }

        $stmt->close();
    }

    exit;
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Levels, Classes, and Subjects (MySQLi)</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div>
        <!-- First Selection: Level (O-Level / A-Level) -->
        <div>
            <select id="level" name="level">
                <option value="">Select Level</option>
                <option value="O-Level">O-Level</option>
                <option value="A-Level">A-Level</option>
            </select>

        <!-- Second Selection: Class (dynamically updated based on level) -->
        <div>
            <select id="class" name="class">
                <option value="">Select Class</option>
            </select>
        </div>

        <!-- Third Selection: Subject (dynamically updated based on class) -->
        <div>
            <select id="subject" name="subject">
                <option value="">Select Subject</option>
            </select>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch classes based on selected level
            $('#level').change(function() {
                var level = $(this).val();
                if (level != '') {
                    $.ajax({
                        url: 'dynamic_levels_mysqli.php',
                        method: 'POST',
                        data: {type: 'class', level: level},
                        success: function(data) {
                            $('#class').html(data);
                            $('#subject').html('<option value="">Select Subject</option>'); // Reset subject
                        }
                    });
                } else {
                    $('#class').html('<option value="">Select Class</option>');
                    $('#subject').html('<option value="">Select Subject</option>'); // Reset subject
                }
            });

            // Fetch subjects based on selected class
            $('#class').change(function() {
                var classSelected = $(this).val();
                if (classSelected != '') {
                    $.ajax({
                        url: 'dynamic_levels_mysqli.php',
                        method: 'POST',
                        data: {type: 'subject', class: classSelected},
                        success: function(data) {
                            $('#subject').html(data);
                        }
                    });
                } else {
                    $('#subject').html('<option value="">Select Subject</option>');
                }
            });
        });
    </script>
</body>
</html>
