<?php
// if (isset($_GET['id'])){
//     $id = $_GET['id'];
//     $loggedin = TRUE;
//     session_start();

//     $sql = "SELECT * FROM users WHERE id = '$id'";
//     $result = $conn->query($sql);
//     $arr = mysqli_fetch_assoc($result);
//     $_SESSION['user'] = $arr['fname'].' '.$arr['lname'];
//     $_SESSION['id'] = $id;

//     echo $id;
// }
// if(!$loggedin){
//         header("location:../index.php");
// }
// session_start();
// include 'home.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// if (isset($_GET['id'])){
//     $id = $_GET['id'];
//     $loggedin = TRUE;
//     // session_start();

//     $sql = "SELECT * FROM users WHERE id = '$id'";
//     $result = $conn->query($sql);
//     $arr = mysqli_fetch_assoc($result);
//     $_SESSION['user'] = $arr['fname'].' '.$arr['lname'];
//     $_SESSION['id'] = $id;

//     echo $id;
// }
// if(!$loggedin){
//         header("location:../index.php");
// }

// Fetching available tests
$sql = "SELECT class FROM class";
$class = $conn->query($sql);

// Fetching available tests
$sql1 = "SELECT class FROM class";
$classee = $conn->query($sql1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Generate Report</title>
    <style>
        .center{ 
            z-index: 2;
            float: left;
            display: flex;
            height:200px;
            margin-top: 100px;
            margin-left: 10%;
            background: blue;
            width:20%; 
            border-radius: 20px;
            overflow: auto;
            position: fixed;
        }

        form{ 
            max-height: 1000rem;
            max-width: 50rem;
            margin: auto auto;
            /* padding-left: 30%; */
        }

        select{
            background: transparent;
            border: 0px;
            border-bottom: 1px solid red;
        }

        .info{
            float: left;
            z-index: 1;
            background: rgba(255, 255, 255, 0.8);
            height:300px;
            width: 60%;
            position: fixed;
            margin-top: 50px;
            margin-left: 27%;
            border-radius: 20px;
            overflow-y: scroll; 
            display: flex;
        }

        .info::-webkit-scrollbar { width: 5px; background: transparent; scrollbar-color: blue; border: 1px solid rgba(255, 255, 255, 0.276); border-radius: 2px; }
        .info::-webkit-scrollbar-thumb { border-radius: 1px; border: 1px solid blue; background-clip: content-box; background-color: blue; width: 5px; border-radius: 7px; }

        #idd{
            border-bottom: 1px solid blue;
            background: white;
        }


        .container { margin: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }

        /* .btn { padding: 10px 15px; cursor: pointer; margin-right: 10px; border-radius:10px; }
        .btn-primary { background-color: #007bff; color: #fff; border: none; }
        .btn-secondary { background-color: #6c757d; color: #fff; border: none; }
        .btn-danger { background-color: #dc3545; color: #fff; border: none; } */
        table { width: 98%; border-collapse: collapse; margin-bottom: 20px; margin: 10px 1% 0 1%; }
        table, th, td { /*border: 1px solid #ddd*/;border-bottom:1px solid grey; }
        th, td { padding: 10px; text-align: left; }
        #student{ display:block; }
        #class{ display: none; }

        .nav{
            align-items: center;
            height: 65px;
            position: fixed;
            /* background: black; */
            width: 70%;
            margin-left: 15%;
            margin-right: 15%;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            /* justify-content: space-between; */
            gap: 0rem;
            display: flex;
        }
        .nav.top{
            /* display: none; */
            background-image:url('images/bg.jpeg');
            top: 0; 
        }

        .nav.bottom{
            background: black;
            bottom: 0;
        }

        .logos{
            align-items:center;
            margin: 3px;
            border-radius: 10px;
            height: 54px;
            width: 54px;
            background: grey;
            border-radius:10 px;
        }

        .logo{
            border-radius: 10px;
            margin: 2px;
            width:50px;
            height:50px;
        }

        .navtop-list{
            color: white;
            display: inline;
        }
        h3{
            color: white;
            font-size: x-large;
            font-weight: lighter;
            width: 100px;
        } 

        .right{
            gap: 10px;
            justify-content: space-between;
            align-items: center;
            display: flex;
            float: right;
        }

        .left{
            gap: 10px;
            justify-content: space-between;
            align-items: center;
            display: flex;
            float: left;
        }
        
        .profile2{
            right: 0;
            position: fixed;
            margin-right:18%;
            border-radius: 50%;
            float: left;
            height:55px;
            width: 55px;
            background: grey;
        }

        .profile1{
            right: 0;
            position: fixed;
            margin-right:27%;
            border-radius: 50%;
            float: left;
            height: 55px;
            width: 55px;
            background: grey;
        }

        input {
                height: 40px;
                border-radius: 10px;
                border: none;
                padding-inline: 20px;
                scroll-padding-inline: 20px;
                padding-top: 12px;
                padding-right: 10px;
                padding-left: 10px;
                padding-bottom: 12px;
                line-height: 1.3;
                background: white;
                font-weight: 600;
                color: black;
                display: flex;
                width:120px;
                margin-left: 1%;
                transition: width 0.5s linear;
                border: 1px solid #03A9F4;
        }

        input:hover {
            border: 1px solid #007bff;
            width: 120px;
            border-radius: 10px;
        }

        input:focus{
            border:none;
            border-color:violet;
        }

        input:active{

            border: 2px solid violet;
        }

        input:placeholder-shown{
            color: black;
        }

        #opt{
            margin-top: 100px;
            margin-left: 10%;
            display: flex;
        }

    </style>
</head>
<body>
<?php 
    // include 'home.php';
    // if (isset($_GET['id'])){
    //     $id = $_GET['id'];
    //     $loggedin = TRUE;
    
    //     $sql = "SELECT * FROM users WHERE id = '$id'";
    //     $result = $conn->query($sql);
    //     $arr = mysqli_fetch_assoc($result);
    
    // session_start();
    //     $_SESSION['user'] = $arr['fname'].' '.$arr['lname'];
    //     $_SESSION['id'] = $id;

    //     echo $id;
    // }

    // if(!$loggedin){
    //     header("location:../index.php");
    // }
?>
<div class="nav top" style="background:transparent;margin-left:50px;">
    <div class="left" style="padding-left:10px;" style="margin-left:80px;">
        <div class="logos" style="margin-left: 0px;">
            <img class="logo" src="logo2.jpg" alt="logo">
        </div>
        <a href="index.php?generate"><h3 style="font-family: sans-serif;"> ESK MS </h3></a>
        <input type="text"class="entry" placeholder="Search for artists, songs, albums!">
    </div>
    <!-- <div class="right"> -->
        <div class="profile2" style="margin-right:50px;">
        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="fill: white; pointer-events: none; padding-top: 10px; padding-left: 10px; display: inherit; width: 80%; height: 80%;"><path d="M12 9.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5m0-1c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5 3.5-1.57 3.5-3.5-1.57-3.5-3.5-3.5zM13.22 3l.55 2.2.13.51.5.18c.61.23 1.19.56 1.72.98l.4.32.5-.14 2.17-.62 1.22 2.11-1.63 1.59-.37.36.08.51c.05.32.08.64.08.98s-.03.66-.08.98l-.08.51.37.36 1.63 1.59-1.22 2.11-2.17-.62-.5-.14-.4.32c-.53.43-1.11.76-1.72.98l-.5.18-.13.51-.55 2.24h-2.44l-.55-2.2-.13-.51-.5-.18c-.6-.23-1.18-.56-1.72-.99l-.4-.32-.5.14-2.17.62-1.21-2.12 1.63-1.59.37-.36-.08-.51c-.05-.32-.08-.65-.08-.98s.03-.66.08-.98l.08-.51-.37-.36L3.6 8.56l1.22-2.11 2.17.62.5.14.4-.32c.53-.44 1.11-.77 1.72-.99l.5-.18.13-.51.54-2.21h2.44M14 2h-4l-.74 2.96c-.73.27-1.4.66-2 1.14l-2.92-.83-2 3.46 2.19 2.13c-.06.37-.09.75-.09 1.14s.03.77.09 1.14l-2.19 2.13 2 3.46 2.92-.83c.6.48 1.27.87 2 1.14L10 22h4l.74-2.96c.73-.27 1.4-.66 2-1.14l2.92.83 2-3.46-2.19-2.13c.06-.37.09-.75.09-1.14s-.03-.77-.09-1.14l2.19-2.13-2-3.46-2.92.83c-.6-.48-1.27-.87-2-1.14L14 2z"></path></svg>
        </div>
        <div class="profile1" style="margin-right:140px;">
        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="fill: white; pointer-events: none; padding-top: 10px; padding-left: 10px; display: inherit; width: 80%; height: 80%;"><path d="M10 20h4c0 1.1-.9 2-2 2s-2-.9-2-2zm10-2.65V19H4v-1.65l2-1.88v-5.15C6 7.4 7.56 5.1 10 4.34v-.38c0-1.42 1.49-2.5 2.99-1.76.65.32 1.01 1.03 1.01 1.76v.39c2.44.75 4 3.06 4 5.98v5.15l2 1.87zm-1 .42-2-1.88v-5.47c0-2.47-1.19-4.36-3.13-5.1-1.26-.53-2.64-.5-3.84.03C8.15 6.11 7 7.99 7 10.42v5.47l-2 1.88V18h14v-.23z"></path></svg>
        </div>
</div>
<div id="opt">
    <h2 style="width:200px;">Generate for</h2>
    <div style="float:right;margin-bottom:-50px;">
        <button onclick="student()" class="btn btn-primary">Students</button>
        <button onclick="class()" class="btn btn-primary">Classes</button>
    </div>
</div>
<br>
<hr style="width:90%;margin-left:5%;">
<div id="student">
    <div class="center one">
            <form action="" method="post">
                <!-- <label for="class">Class:</label> -->
                <select name="class" id="clas" required style="color:grey;">
                <option value="">Class</option>
                <?php while ($classe = $class->fetch_assoc()): ?>
                        <option value="<?php echo $classe['class']; ?>"><?php echo $classe['class']; ?></option>
                    <?php endwhile; ?>
                </select>
                <br><br><br>
                <!-- <label for="term">Term:</label> -->
                <select id="term" name="term" required style="color:grey;">
                    <option value="">Period</option>
                    <option value="term 1">Term 1</option>
                    <option value="term 2">Term 2</option>
                    <option value="term 3">Annual</option>
                </select>    
                <br><br><br>
                <input type="submit" value="&rarr;" name="generate1" style="width:40px;height:40px;border:0px;border-radius:50%;float:right;margin-right:20%;padding-top:5px;margin-top:-30px;">
            </form>
        </div>
        <div class="info one">
                <table>
                    <thead>
                        <th style="padding-left:50px;">Action</th>
                        <th>Class name</th>
                    </thead>
                    <tbody>
                        <form action="nav.php" method="POST">
                            <!-- <tr>
                            <td class="td-sm"><input type="checkbox" name="idd" id="idd" value="<?php // echo $id ?>"></td>
                            <td class="td-sm"><?php // echo $fname.' '.$lname ?>MUCYO Josue</td>
                        </tr> -->
                        <?php
                            if (isset($_POST['generate1'])){
                            // $typofass = $_POST['typofass'];
                                $term = $_POST['term'];  
                                $class = $_POST['class'];
                                // $level = $_POST['level'];
                                // $sec = $_POST['sec'];
                                // $subject = $_POST['subject'];

                                $query = "SELECT class , id , lname , fname FROM students WHERE class = '$class' ";
                                $result = mysqli_query( $conn , $query );
                                // $rowe = mysqli_fetch_assoc($result);
                                // $fname = $rowe['fname'];
                                // $lname = $rowe['lname']; 
                                // $id = $rowe['id']; 
                            // if( mysqli_num_rows($result) >0):
                                while ($rowe = mysqli_fetch_assoc($result)) { ?>
                                    <?php
                                    $query1 = "SELECT classid FROM assessments WHERE class = '$class' ";
                                    $result1 = mysqli_query( $conn , $query1 );
                                    $nbr = mysqli_fetch_assoc($result1)['classid'];
                                    ?>
                                    <tr>
                                        <input type="hidden" name="classid" value="<?php echo $nbr ?>">
                                        <input type="hidden" name="term" value="<?php echo $term ?>">
                                        <input type="hidden" name="class" value="<?php echo $rowe['class'] ?>">
                                        <td class="td-sm" style="padding-left:50px;"><input type="checkbox" name="ice[]" id="ice" value="<?php echo $rowe['id'] ?>" style="width:20px;"></td>
                                        <td class="td-sm"><?php echo $rowe['fname'].' '.$rowe['lname'] ?></td>
                                    </tr>
                        <?php  } //endif; ?>
                        <?php }  ?>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit" value="go" name="go" style="float:right;margin:10px;position: fixed; right: 0;">GO</button>
                </form>
</div>
</div>
<div id="class">
    <div class="center one">
            <form action="" method="post">
                <!-- <label for="class">Class:</label> -->
                <select name="class" id="clas" required>
                <option value="">Class</option>
                <?php while ($classeee = $classee->fetch_assoc()): ?>
                        <option value="<?php echo $classeee['class']; ?>"><?php echo $classeee['class']; ?></option>
                    <?php endwhile; ?>
                </select>
                <br><br><br>
                <!-- <label for="term">Term:</label> -->
                <select id="term" name="term" required>
                    <option value="">Term</option>
                    <option value="term 1">Term 1</option>
                    <option value="term 2">Term 2</option>
                    <option value="term 3">Term 3</option>
                </select>    
                <br><br><br>
                <input type="submit" value="&rarr;" name="generate2" style="width:40px;height:40px;border:0px;border-radius:50%;float:right;margin-right:20%;">
            </form>
        </div>
        <div class="info one">
                <table>
                    <thead>
                        <th style="padding-left:50px;">Action</th>
                        <th>Class name</th>
                    </thead>
                    <tbody>
                        <form action="nav.php" method="POST">
                            <!-- <tr>
                            <td class="td-sm"><input type="checkbox" name="idd" id="idd" value="<?php // echo $id ?>"></td>
                            <td class="td-sm"><?php // echo $fname.' '.$lname ?>MUCYO Josue</td>
                        </tr> -->
                        <?php
                            if (isset($_POST['generate2'])){
                            // $typofass = $_POST['typofass'];
                                // $term = $_POST['term'];  
                                $class = $_POST['class'];
                                // $level = $_POST['level'];
                                // $sec = $_POST['sec'];
                                // $subject = $_POST['subject'];

                                $query = "SELECT class , id , lname , fname FROM students WHERE class = '$class' ";
                                $result = mysqli_query( $conn , $query );
                                // $rowe = mysqli_fetch_assoc($result);
                                // $fname = $rowe['fname'];
                                // $lname = $rowe['lname']; 
                                // $id = $rowe['id']; 
                            // if( mysqli_num_rows($result) >0):
                                while ($rowe = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <input type="hidden" name="classid" value="<?php echo $nbr ?>">                                        
                                        <input type="hidden" name="term" value="<?php echo $term ?>">
                                        <input type="hidden" name="class" value="<?php echo $rowe['class'] ?>">
                                        <td class="td-sm" style="padding-left:50px;"><input type="checkbox" name="ice[]" id="ice" value="<?php echo $rowe['id'] ?>" style="width:1px;"></td>
                                        <td class="td-sm"><?php echo $rowe['fname'].' '.$rowe['lname'] ?></td>
                                    </tr>
                        <?php  } //endif; ?>
                        <?php }  ?>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit" value="go" name="go" style="float:right;margin:10px;position: fixed; right: 0;">GO</button>
                </form>
</div>
</div>
<script>
    function student(){
        document.getElementById('student').style.display = 'block';
        documrnt.getElementById('class').style.display = 'none';
    }
    function class(){
        document.getElementById('student').style.display = 'none';
        document.getElementById('class').style.display = 'block';
    }
</script>
</body>
</html>