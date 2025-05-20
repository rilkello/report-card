<?php
//include 'config.php'; // Include your database connection file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regg";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ac_year";
$res = mysqli_query($conn,$sql);
    if($res->num_rows == '0'){
        echo "<center><div id='modal' style='height:100px;width:250px;background-color:blue;position:fixed;left:50%;dispaly:flex;z-index: 999;transform-origin: top; top: calc(13px + 8px);margin-left:-10%;border-radius:10px;padding:10px;'>
                <p>TO PROCEED ADD NEW ACADEMIC YEAR</p>
                <button value='start' onclick='startterm()'>START</button>
            </div></center>";
    }
    else{
        header('location:new2.php');
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['start'])){
            $new_year = $_POST['new_year'];
            $new_term = $_POST['new_term'];

            $sql = "INSERT INTO ac_year (year, term) VALUES ('$new_year', '$new_term')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('New year and new term started successfully!')</script>";
                header('location:new2.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        #modale{ display: none; }
    </style>
</head>
<body>
    <center><div id='modale' style='height:100px;width:250px;background-color:blue;position:fixed;left:50%;dispaly:flex;z-index: 999;transform-origin: top; top: calc(13px + 8px);margin-left:-10%;border-radius:10px;padding:10px;'>
        <p>CLICK BELOW TO START YOUR SYSTEM</p>
        <a href="new2.php"><button value='start'>START</button></a>
    </div></center>
    <script>
        function startterm(){
            const modal = document.getElementById('modal');
            modal.innerHTML = '';
            modal.style.display = 'none';
            const new_year = prompt("Enter new year:");
            const new_term = prompt("Enter new term:");
            if (new_year && new_term) {
                fetch('', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        'new_year': new_year,
                        'new_term': new_term,
                        'start': true
                    })
                }).then(response => response.text())
                    .then(data => {
                        alert('New year of ' + new_year + ' with ' + new_term + ' has started now successfully') ;
                    });
                    document.getElementById('modale').style.display = 'block';
            }
            else{
                modal.innerHTML = `<center><div id='modal' style='height:100px;width:250px;background-color:blue;position:fixed;left:50%;dispaly:flex;z-index: 999;transform-origin: top; top: calc(13px + 8px);margin-left:-10%;border-radius:10px;padding:10px;'>
                <p>TO PROCEED ADD NEW ACADEMIC YEAR</p>
                <button value='start' onclick='startterm()'>START</button>
                </div></center>`;
                modal.style.display = 'block';
            }
        }
    </script>
</body>
</html>