<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_marks'])) {

        $sec = $_POST['sec'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $marks = $_POST['marks'];
        $subject = $_POST['subject'];

        $sql = "UPDATE marks SET `$sec` = ? WHERE fname = ? AND lname = ? AND subject = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $marks, $fname, $lname, $subject);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
        exit;

    }
    
    if (isset($_POST['update_outof'])) {
        // $new_outof = $_POST['new_outof'];
        // $test_id = $_POST['test_id'];

        // $sql = "UPDATE assessments SET outof=? WHERE id=?";
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param("ii", $new_outof, $test_id);
        // $stmt->execute();
        // $stmt->close();
        // echo json_encode(['status' => 'success']);

        // //header("location:".$_SERVER['PHP_SELF']);
        // exit;
        $new_outof = $_POST['new_outof'];
        $test_id = $_POST['test_id'];
        $secl = $_POST['sekk'];
        
        echo '<script>document.write("efg")</script>';

        $sql = "UPDATE assessments SET `$secl` = '$new_outof' WHERE id ='$test_id'";
        // $sql = "UPDATE assessments SET ? = ? WHERE id = ? ";

        if(mysqli_query( $conn , $sql )){
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
    }
}

    

// Fetching available tests
$sql = "SELECT id, name, class FROM assessments";
$tests = $conn->query($sql);

// Fetching available subjects
$sql = "SELECT id, lesname FROM lesson";
$les = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Marks</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap');
        *,
        *::after,
        *::before {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        list-style-type: none;
        outline: none;
        }

        html {
        font-size: 62.5%;
        scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
        width: 0;
        }

        body {
        font-size: 1.6rem;
        font-family: 'Inter', sans-serif;
        background: url('images/bg.jpeg') no-repeat center/cover;
        height: 100vh;
        --bg: #fff;
        --text: #475569;
        --active-link: #edeef3;
        --divider: 0.1rem solid #d9d9da;
        --profile-text-1: #000;
        --profile-text-2: #8a8b8c;
        --dropdown-bg: rgb(245, 245, 245);
        }

        body.dark {
        --bg: #1a2037;
        --text: #ededed;
        --active-link: linear-gradient(
            0deg,
            rgba(255, 255, 255, 0.6),
            rgba(255, 255, 255, 0.6)
            ),
            #1a2037;
        --divider: 0.1rem solid #d9d9da;
        --profile-text-1: #e0e0e0;
        --profile-text-2: #bfbfbf;
        --dropdown-bg: rgb(31, 44, 76);
        }

        .container {
        max-width: 140rem;
        margin: 0 auto;
        padding: 0 3rem;
        }

        body.dark .icon-img,
        body.dark .dropdown-arrow img,
        body.dark .dropdown-link img,
        body.dark .sidebar-toggle-icon img{
        filter: brightness(0) invert(1);
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

        .entry {
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

        .entry:hover {
            border: 1px solid #007bff;
            width: 120px;
            border-radius: 10px;
        }

        .entry:focus{
            border:none;
            border-color:violet;
        }

        .entry:active{

            border: 2px solid violet;
        }

        .entry:placeholder-shown{
            color: black;
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

        .sidebar-top1{
            /* height: 100px;*/
            /* width: 100%; 
            background: red;
            align-items: center;
            margin-bottom: 15px; */
        }

        .jeeze{
            /* padding-right: 10px;
            padding-left: 10px;
            padding-bottom: 10px;
            position: fixed;
            width: 100%;
            justify-content: space-between; */
        }

        .list1{
            /* padding-top: 5px; */
            /* align-self: center; */
            /* width: 30px; */

            /* position: relative;
            display: inline-block;
            padding-left: 5px;
            padding-right: 20px;
            padding-bottom: 10px;
            margin-bottom: 10px;
            margin-right: 3.5%;
            margin-left: 3.5%;
            border-radius: 0.8rem;
            background-blend-mode: soft-light, normal;
            transition: all 0.5s ease; */
        }


        /*wapiiiiiiii--------------------------------------------- */
        /* .list1:active {
            padding-top: 4px;
            width: 30px;
            height: 30px;
            background: var(--active-link);
        } */
        /* ----------------------------------------------------- */



        /* .hidden { display: none; } */
        .container { margin: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; }
        /* .btn { padding: 10px 15px; cursor: pointer; margin-right: 10px; }
        .btn-primary { background-color: #007bff; color: #fff; border: none; }
        .btn-secondary { background-color: #6c757d; color: #fff; border: none; }
        .btn-danger { background-color: #dc3545; color: #fff; border: none; } */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; margin: 5px 0% 0 0px;}
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        .editable {
            pointer-events: auto;
            color:white !important;
            background: black !important;
            border:none;
        }
        .non-editable {
            pointer-events: none;
        }
        .success-tick {
            color: green;
            display: none;
        }

        @-webkit-keyframes fade1 {
                0% {
                    margin-top:-100px;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }

                to { 
                    margin-top: 5px;
                    /* top: 1; */
                    /* -webkit-transform: rotate(1turn) */
                }
        }

        @-webkit-keyframes fad {
                0% {
                    display: block;
                    margin-top:5px;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }

                to {
                    display: none; 
                    margin-top:-100px;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }
        } 

        @-webkit-keyframes progress {
                0% {
                    width: 100%;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }

                

                to {
                    width: 0%;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }
        } 

        #info{ display: none; margin-right: 10px; overflow: auto; position: fixed; z-index: 2; right: 0; align-items: center; animation:fade1 0.5s linear; }
        #counterr{ margin-bottom: 0px; height: 2px; background: red; animation: progress 4s linear; }
        .modal-body{ -webkit-box-flex: 1; background-color: white; flex: 1 1 auto; padding: 1rem; position: relative; height: 50px;}
        .modal-dialog{ position:relative; width:auto; margin:0.5rem; pointer-events: none; }
        .modal-content{background-color: #fff; max-height: 120px;background-clip: padding-box; flex-direction: column; width: 100%; outline: 0; border-radius: 0.3rem; pointer-events: auto; color: black; position: relative; display: flex; -webkit-box-orient: vertical; -webkit-box-direction: normal; width:100%; border: 1px solid rgba(0, 0, 0, 0.2); } 
        .modal-title{ float: left; margin-bottom: 0; line-height: 1.5; font-weight: 400; font-family: "Poppins", Arial, sans-serif; } 
        .close{ float: right;font-size:1.5rem; font-weight:700; line-height: 1; text-shadow: 0 1px 0 #fff; background: transparent; cursor:pointer; opacity: 0.5; transition: .3s all ease; text-transform: none; overflow: visible; border-radius: 0; background-color: transparent; border: 0; -webkit-appearance: none; -moz-appearance: none; appearance: none; padding: 1rem 1rem; margin: -1rem -1rem -1rem auto; } 
        .modal-header{ -webkit-box-align: start; flex-shrink: 0; display: flex; align-items: flex-start; justify-content: space-between; padding: 1rem 1rem;  -webkit-box-pack: justify; border-bottom: 1px solid #dee2e6; border-top-left-radius: 0.3rem; border-top-right-radius: 0.3rem; }
        .text-light{ color: #f8f9fa !important; }
        .bg-primary{ background-color: #007bff !important; }
        .gee{ margin-top: 0px;font-family: "Poppins", Arial, sans-serif; font-size: 14px; line-height: 1.8; font-weight: normal; color: gray; }
        /* h5{ font-size: 1.25rem; margin-top: 0; } */
        #mhn{ margin-top: 0px; position: fixed; width: 90%; }
        .col{ display: inline-block; width: 13%; }
        #jee{ padding-left: 10%; align-items:center; height: 50px; margin-top: 100px; }
        #editButton{ margin-right:5%; margin-bottom: 10px; }
        #outof{ display: inline; }
        #temporary{ overflow-y: scroll; height: 262px; background: rgba(255, 255, 255, 0.276); margin-left:15%; padding:10px; border-radius: 10px;margin-top:70px; width:80%; }
        #scroll{ overflow-y: scroll; height: 262px; background: rgba(255, 255, 255, 0.276); margin-left:100px; padding:0px; border-radius: 10px; margin-top:0px; }
        #scroll::-webkit-scrollbar { width: 5px; background: transparent; scrollbar-color: blue; border: 1px solid rgba(255, 255, 255, 0.276); border-radius: 2px; }
        #scroll::-webkit-scrollbar-thumb { border-radius: 1px; border: 1px solid blue; background-clip: content-box; background-color: blue; width: 5px; border-radius: 7px; }
        #infor{ margin-left: 100px; margin-top: 50px; position: absolute; height: 70%; width: 82%; background: white; z-index: 2; border-radius: 20px; display: block; }  
        #infor1{ margin-left: 100px; margin-top: 100px; position: absolute; height: 70%; width: 82%; background: white; z-index: 2; border-radius: 20px; display: none; }  
        h2{ font-weight:lighter; padding-top: 30px; padding-left: 10px; }
        .heado{  height: 20%; background: #007bff; border-top-left-radius: 20px; border-top-right-radius: 20px; }
        #clos{ margin-top: -25px; padding-right: 10px; float: right;font-size:2.5rem; font-weight:700; line-height: 1; text-shadow: 0 1px 0 #fff; background: transparent; cursor:pointer; opacity: 0.5; transition: .3s all ease; text-transform: none; overflow: visible; border-radius: 0; background-color: transparent; border: 0; -webkit-appearance: none; -moz-appearance: none; appearance: none; /*padding: 1rem 1rem;*/ }
        .right1{ float: right; width:50%; }
        .left1{ float: left; border-right: 1px solid black; width: 50%;}
        .p1{ color: grey; margin-bottom: 40px; margin-top: 40px; padding: 0 30px; width: 90%; }
        .in{ border : 2px #007bff solid; }
        #form{ margin: 0px auto; }
        #change{ margin:0px auto;line-height:1;max-width: 100rem; }




        #box1{
            height:100px;
            background:blue;
            display:absolute;
            
        }
        #box2{
            align-items: center;
            margin-top:-50px;
            height:100px;
            background:black;
            position:flex;
            width:80%;
            margin-left:10%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #box3{
            overflow-y: scroll;
            margin-top:30px;
            height:200px;
            background:black;
            position:flex;
            width:80%;
            margin-left:10%;
            border-radius:10px;
        }
        #box3::-webkit-scrollbar { width: 5px; background: transparent; scrollbar-color: blue; border: 1px solid rgba(255, 255, 255, 0.276); border-radius: 2px; }
        #box3::-webkit-scrollbar-thumb { border-radius: 1px; border: 1px solid blue; background-clip: content-box; background-color: blue; width: 5px; border-radius: 7px; }
        #box4{
            align-items: center;
            /* margin-top:-50px; */
            /* margin-top:30px; */
            height:100px;
            background:black;
            position:flex;
            width:80%;
            margin-left:10%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        #box5{
            padding-top:10px;
            margin-top:30px;
            height:200px;
            background:black;
            position:flex;
            width:80%;
            margin-left:10%;
            border-radius:10px;
        }
        #box5::-webkit-scrollbar { width: 5px; background: transparent; scrollbar-color: blue; border: 1px solid rgba(255, 255, 255, 0.276); border-radius: 2px; }
        #box5::-webkit-scrollbar-thumb { border-radius: 1px; border: 1px solid blue; background-clip: content-box; background-color: blue; width: 5px; border-radius: 7px; }
        #stinfo{
            display: none;
            overflow: hidden;
            background: grey;
            margin-left: 20%;
            border-radius: 12px;
            margin-top: 100px;
            width: 60%;
            float: center;
            /* margin-left: 10%; */
            height: 450px;
            border: 1px chartreuse solid;
        }
        #addst, #add{
            z-index:2;
            display: none;
            overflow: hidden;
            background: grey;
            margin-left: 20%;
            border-radius: 12px;
            margin-top: 80px;
            width: 60%;
            float: center;
            /* margin-left: 10%; */
            height: 450px;
            border: 1px chartreuse solid;
        }
        #inforr{
            display: flex;
        }
        #left{
            width:40%;
        }
        #right{
            margin-top: -50px;
            width:60%;
        }
        p{
            color: white;
            margin: 10px;
        }
        h1,h2,h3,h4,h5{
            /* margin: 10px; */
            color: white;
        }
        #one{
            display: inline-block;
        }
    </style>
    <!-- <script>
 
    </script>
</head> -->
<body>

<?php // include 'home.php'?>



<div  id="info" style="width:200px;"> 
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center><p class="gee">Marks inserted</p></center>
            </div>
            <div id="counterr">

            </div>
        </div>
    </div>
</div>

<div class="nav top" style="background:transparent;margin-left:50px;">
    <div class="left" style="padding-left:10px;" style="margin-left:80px;">
        <div class="logos" style="margin-left: 0px;">
            <img class="logo" src="logo2.jpg" alt="logo">
        </div>
        <a href="new4.php"><h3>ESK MS</h3></a>
        <input type="text"class="entry" placeholder="Search for artists, songs, albums!">
    </div>
    <div class="profile2" style="margin-right:50px;">
        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="fill: white; pointer-events: none; padding-top: 10px; padding-left: 10px; display: inherit; width: 80%; height: 80%;"><path d="M12 9.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5m0-1c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5 3.5-1.57 3.5-3.5-1.57-3.5-3.5-3.5zM13.22 3l.55 2.2.13.51.5.18c.61.23 1.19.56 1.72.98l.4.32.5-.14 2.17-.62 1.22 2.11-1.63 1.59-.37.36.08.51c.05.32.08.64.08.98s-.03.66-.08.98l-.08.51.37.36 1.63 1.59-1.22 2.11-2.17-.62-.5-.14-.4.32c-.53.43-1.11.76-1.72.98l-.5.18-.13.51-.55 2.24h-2.44l-.55-2.2-.13-.51-.5-.18c-.6-.23-1.18-.56-1.72-.99l-.4-.32-.5.14-2.17.62-1.21-2.12 1.63-1.59.37-.36-.08-.51c-.05-.32-.08-.65-.08-.98s.03-.66.08-.98l.08-.51-.37-.36L3.6 8.56l1.22-2.11 2.17.62.5.14.4-.32c.53-.44 1.11-.77 1.72-.99l.5-.18.13-.51.54-2.21h2.44M14 2h-4l-.74 2.96c-.73.27-1.4.66-2 1.14l-2.92-.83-2 3.46 2.19 2.13c-.06.37-.09.75-.09 1.14s.03.77.09 1.14l-2.19 2.13 2 3.46 2.92-.83c.6.48 1.27.87 2 1.14L10 22h4l.74-2.96c.73-.27 1.4-.66 2-1.14l2.92.83 2-3.46-2.19-2.13c.06-.37.09-.75.09-1.14s-.03-.77-.09-1.14l2.19-2.13-2-3.46-2.92.83c-.6-.48-1.27-.87-2-1.14L14 2z"></path></svg>
    </div>
    <div class="profile1" style="margin-right:140px;">
        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="fill: white; pointer-events: none; padding-top: 10px; padding-left: 10px; display: inherit; width: 80%; height: 80%;"><path d="M10 20h4c0 1.1-.9 2-2 2s-2-.9-2-2zm10-2.65V19H4v-1.65l2-1.88v-5.15C6 7.4 7.56 5.1 10 4.34v-.38c0-1.42 1.49-2.5 2.99-1.76.65.32 1.01 1.03 1.01 1.76v.39c2.44.75 4 3.06 4 5.98v5.15l2 1.87zm-1 .42-2-1.88v-5.47c0-2.47-1.19-4.36-3.13-5.1-1.26-.53-2.64-.5-3.84.03C8.15 6.11 7 7.99 7 10.42v5.47l-2 1.88V18h14v-.23z"></path></svg>
    </div>
</div>

<div class="" id="mhn">
    <div class="row">
        <form action="" method="POST" enctype="multipart/form-data" id="form">
            <input type="hidden" class="form-control" id="served_by" name="served_by" value="<?php echo $session_id; ?>" onkeydown="return false">
            <div class="form-row mb-2" id="jee">
                <div class="col">
                    <select class="form-select form-select-sm" aria-label=".form-select-md example" id="level" name="level" required style="width:100%;height:30px;border-radius:4px;background:lightgray;color:darkgray;display:inline;">
                        <option selected value="" style="color:lightgray;">level</option>
                        <option value="Ordinary level">Ordinary level</option>ption
                        <option value="Advanced level">Advanced level</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required style="width:100%;height:30px;border-radius:4px;background:lightgray;color:darkgray;display:inline;">
                        <option selected value="" style="color:lightgray;">class</option>
                        <?php
                        $sql = "SELECT * FROM class";
                        $result = $conn->query($sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row["class"]; ?>"> <?php echo $row["class"]; ?> </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select form-select-sm" aria-label=".form-select-md example" id="typofass" name="typofass" required style="width:100%;height:30px;border-radius:4px;background:lightgray;color:darkgray;display:inline;">
                        <option selected value="" style="color:lightgray;">Type of assessment</option>
                        <option value="test">Test</option>
                        <option value="exam">Exam</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select form-select-sm" aria-label=".form-select-md example" id="subject" name="subject" required style="width:100%;height:30px;border-radius:4px;background:lightgray;color:darkgray;display:inline;">
                        <option selected value="" style="color:lightgray;">Subject</option>
                        <?php
                        $sql = "SELECT lesname, level FROM lesson ORDER BY level ASC";
                        $result = $conn->query($sql);
                        if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row["lesname"]; ?>"> <?php echo $row["lesname"].' - '.$row['level']; ?> </option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select form-select-sm" aria-label=".form-select-md example" id="term" name="term" required style="width:100%;height:30px;border-radius:4px;background:lightgray;color:darkgray;display:inline;">
                        <option selected value="" style="color:lightgray;">Term</option>
                        <option value="term 1">Term 1</option>
                        <option value="term 2">Term 2</option>
                        <option value="term 3">Term 3</option>
                        </select>
                </div>
                <div class="col">
                    <select class="form-select form-select-sm" aria-label=".form-select-md example" id="sec" name="sec" required style="width:100%;height:30px;border-radius:4px;background:lightgray;color:darkgray;display:inline;">
                        <option selected value="" style="color:lightgray;">Assessment</option>
                        <option value="test 1">Test 1</option>
                        <option value="test 2">Test 2</option>
                        <option value="test 3">Test 3</option>
                        <option value="test 4">Test 4</option>
                        <option value="exam">Exam</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background:blue;float: right;margin-bottom:-13px;" onclick="hidem()">Filter</button>
                </div>
            </div>
        </form>
        <!-- <div id="temporary" style="align-items:center;">
            <center><pre style="width:50%;padding-top:100px;padding-bottom:100px;">SELECT CLASS TO GET DATA</pre></center>
        </div> -->
        <!-- <button id="editButton" onclick="toggleEdit()">Enable Editing</button> -->
        
                    
        <?php
            // $limit = 15;
            // // include ('config/db.php');
            // $getQuery = " SELECT * from marks ";
            // $result = mysqli_query ( $conn, $getQuery);
            // $total_rows =  mysqli_num_rows($result);
            // $total_rows =  mysqli_num_rows($result);
            // $total_pages = ceil($total_rows / $limit);

            // // Check if $total_pages is defined before using it
            // if (isset($_GET['page'])) {
            // 	$page_number = $_GET['page'];
            // } else {
            // 	$page_number = 1;
            // }
            // $initial_page = ($page_number - 1) * $limit;
            
            if (isset($_POST['submit'])){
                $typofass = $_POST['typofass'];
                $term = $_POST['term'];  
                $class = $_POST['class'];
                $level = $_POST['level'];
                $sec = $_POST['sec'];
                $subject = $_POST['subject'];

                if($term === "term 1" && $sec === "test 1" && $typofass == "test"){
                    $secc = "cat1a"; 
                }   
                elseif($term === "term 1" && $sec === "test 2"){
                    $secc = "cat1b";
                }

                elseif($term === "term 1" && $sec === "test 3"){
                    $secc = "cat1c"; 
                }   
                elseif($term === "term 1" && $sec === "test 4"){
                    $secc = "cat1d";
                }
                elseif($term === "term 1" && $sec === "exam"){
                    $secc = "ex1"; 
                }   
                elseif($term === "term 2" && $sec === "test 1"){
                    $secc = "cat2a";
                }
                elseif($term === "term 2" && $sec === "test 2"){
                    $secc = "cat2b";
                }
                elseif($term === "term 2" && $sec === "test 3"){
                    $secc = "cat2c";
                }
                elseif($term === "term 2" && $sec === "test 4"){
                    $secc = "cat2d";
                }
                elseif($term === "term 2" && $sec === "exam" && $typofass == "exam"){
                    $secc = "ex2";
                }
                elseif($term === "term 3" && $sec === "test 1"){
                    $secc = "cat3a";
                }
                elseif($term === "term 3" && $sec === "test 2"){
                    $secc = "cat3b";
                }
                elseif($term === "term 3" && $sec === "test 3"){
                    $secc = "cat3c";
                }
                elseif($term === "term 3" && $sec === "test 4"){
                    $secc = "cat3d";
                }
                elseif($term === "term 3" && $sec === "exam"){
                    $secc = "ex3";
                }

                $query = "SELECT $secc , id , outof FROM assessments WHERE class = '$class' AND subject = '$subject' ";
                $res = mysqli_query( $conn , $query );
                $rowe = mysqli_fetch_assoc($res);
                $outof = $rowe[$secc]; 
                $id = $rowe['id']; 
                $neww = $rowe[$secc]; 
                $outofff= $rowe['outof'];
                ?>

                <?php
                    $result1 = mysqli_query($conn , $query);
                    $rok = mysqli_fetch_assoc($result1);
                    $neww = $rok[$secc];
                ?>
    </div>
    <div id='change'>
        <button id="editButton" class="btn btn-success" onclick="toggleEdit()" style="float:right;">Enable Editing</button><br><br><br><br>
        <div id="scroll">
            <table class="table table-hover text-center" id="table1">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Student's name</th>
                        <th scope="col">Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getQuery = " SELECT id , fname , lname , `$secc` , dir FROM marks
                    WHERE  
                    class = '$class' 
                    AND level = '$level'
                    AND subject = '$subject'
                    LIMIT  15 " ;//.$initial_page.' ,' .$limit ;

                    $result = mysqli_query($conn , $getQuery);
                    // $result1 = mysqli_query($conn , $query);
                    if( mysqli_num_rows($result) >0):?>
                    <?php
                    while($row = mysqli_fetch_assoc($result)): ?>
                    <tr class = "td-sm" >
                        <td class = "td-sm" ><img src="passports/<?php echo $row['dir']; ?>" style="width:50px;height:50px;border-radius:50%;"></td>
                        <td class = "td-sm" ><?php echo $row['fname'].' '.$row['lname']; ?></td>
                        <td class = "td-sm" ><input type="text" class="non-editable" value="<?php echo $row[$secc]; ?>" oninput="validateMarks(this, '<?php echo $outof; ?>')" onchange="updateMarks(this, '<?php echo $row['fname']; ?>', '<?php echo $row['lname']; ?>', '<?php echo $secc; ?>', '<?php echo $subject; ?>', '<?php echo $outof; ?>')" style="border-top:none !important;border-left:none !important;border-right:none !important;border-bottom:1px solid blue;background:lightgray;text-align:center;background-color:white;width:50px;color:black;border-radius:5px;height:30px;">
                            <span class="error-message"></span>
                            <span class="success-tick">&#10004;</span>
                        </td>
                    </tr>
                    <?php endwhile ; endif; ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Generate_Report_Cards" style="margin-right: 30px; border-radius: 10px; margin-top:10px;margin-left: 100px;" onclick = "linkk()" >Generate report</button>
        <button type="button" class="btn btn-primary" id="goo" style="float:right;margin-top: 10px;height:40px;width:40px;background:orange;border:none;border-radius:50%;" onclick="reload()">&rarr;</button>  <!--onclick="alertt()"-->
    </div>
    <div id="add">  <!-- style=" display: block;margin-top: -450px;" -->
            <form method="POST" enctype="multipart/form-data" id ="form2">
                <div id="box1" style="">
                    <center><h2 style="color:grey; padding:15px 0 0 0;;color:white;">ASSESMENT INFO</h2></center>
                </div>
                <div id="inforr">
                    <div id="leftt">
                        <div id="box2" style="display: flex;overflow:hidden;">
                            <img src="passports/<?php echo $sec?>.png" alt="" style="float:left;width:80px;height:80px;border-radius:50%;margin-left:10px;margin-top:0px;" id="one">
                            <h5 id="one" style="float:right;margin-top:20px;padding-left: 20%;;color:white;"><?php echo ucfirst($sec); ?></h2>
                        </div>
                        <div id="box3" style="padding-top:10px;">
                            <center><p style="margin-top: 5rem;">Total: </p></center>
                            <center><input type="number" name="outof" id="outof" value="<?php echo $outof ;?>" onchange="updateOutof(this, '<?php echo $id ;?>' , '<?php echo $secc ; ?>' )" style="width: 80%;transparent;border: 0px;border-bottom: 1px solid red;color: grey;border-radius:10px;padding-inline: 5px;"></center>
                        </div>
                    </div>
                    <div id="right">
                    <div id="box4" style="">
                        <h4 style="padding:45px 0px 0 20px;;color:white;">OTHER INFORMATION</h1>  
                    </div>
                    <div id="box5" style="overflow-y: scroll;">
                        <h4 style="padding-left: 10px;color:white;">Addenda</h2>
                        <hr style="margin-left: 10px;width:90%;background:white;">
                        <ul>
                            <li><p>Level: <?php echo $level ?></p></li>
                            <li><p>Class: <?php echo $class?></p></li>
                            <li><p>Subject:  <?php echo $subject?></p></li>
                            <li><p>Subject weight :  <?php echo $outofff ?></p></li>
                        </ul>
                    </div>
                </div>
            </div> 
        </form>
        <div id="footer" style="background:chartreuse;padding-bottom:100px;height:10px;margin-top: 10px;bottom: 0;">
            <button onclick="hidde()" style="background:orange;width:40px;height:40px;border-radius:50%;border: 1px solid #03A9F4;margin-left:10%;margin-top:15px;">&larr;</button>
            <button class="btn btn-primary" onclick="hidde()" style="background:orange;width:40px;height:40px;border-radius:50%;border: 1px solid #03A9F4;margin-left:56%;margin-top:0px;">&rarr;</button>
        </div>
    </div>
    <?php } ?>
</div>
    
<div class="pagination" style="text-align:center;">
    <?php
    // for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
    //     echo '<a class="page-link" href="new5.php?page=' . $page_number . '"> ' . $page_number . '</a>';
    // }
    ?>
</div>

<!-- <div class="sidebar">
    <div class="hidden">
        <div class="bg">
            <div class="sidebar-top">
                <li class="list active">
                    <a href="#!" class="link" onclick="history.back()">
                        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
                        <span>Home</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#!" class="link" onclick="pop()">
                        <img src="images/icon-2.svg" alt="icon" class="icon-img" />
                        <span>Campaigns</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#!" class="link">
                        <img src="images/icon-3.svg" alt="icon" class="icon-img" />
                        <span>Flows</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#!" class="link">
                        <img src="images/icon-4.svg" alt="icon" class="icon-img" />
                        <span>Forms</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#!" class="link">
                        <img src="images/icon-8.svg" alt="icon" class="icon-img" />
                        <span>Chats</span>
                    </a>
                </li>
            </div>
            <div class="sidebar-bottom">
                <li class="list">
                    <a href="#!" class="link">
                        <img src="images/settings.svg" alt="icon" class="icon-img" />
                        <span>Settings</span>
                    </a>
                </li>
                <div class="profile">
                    <div class="profile-content">
                        <img src="images/profile.svg" alt="Profile" class="profile-img" style="cursor: pointer;" onclick="back()" />
                        <div class="profile-info">
                            <h3 class="profile-name">Ketan’s Studio</h3>
                            <span class="profile-email">koriigami@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-toggle">
        <div class="sidebar-toggle-icon"  onclick="show()" >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M5.75 5.25h12.5a.75.75 0 1 1 0 1.5H5.75a.75.75 0 0 1 0-1.5zm0 6h12.5a.75.75 0 1 1 0 1.5H5.75a.75.75 0 1 1 0-1.5zm0 6h12.5a.75.75 0 1 1 0 1.5H5.75a.75.75 0 1 1 0-1.5z"></path></svg>
        </div>
    </div>
    <div class="sidebar-toggle1">
        <div class="sidebar-toggle-icon1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M5.75 5.25h12.5a.75.75 0 1 1 0 1.5H5.75a.75.75 0 0 1 0-1.5zm0 6h12.5a.75.75 0 1 1 0 1.5H5.75a.75.75 0 1 1 0-1.5zm0 6h12.5a.75.75 0 1 1 0 1.5H5.75a.75.75 0 1 1 0-1.5z"></path></svg>
        </div>
    </div>
</div>     -->

</body>
<script>
    // let sidebar = document.querySelector('.sidebar');
    // let lists = document.querySelectorAll('.list');
    // let toggle_icon = document.querySelector('.sidebar-toggle-icon');
    // const body = document.body;
    // let toggleback = document.querySelector('.sidebar-toggle1');
    // let toggleon = document.querySelector('.bg');

    // // toggleon.style.height = '100px';
    // // toggle_icon.style.display = 'flex'; 
    // toggleback.style = 'display: none';
    // // toggleon.style = 'display: block; gap: 0rem;';

    // function show(){
    //     toggleback.style = 'display: fixed;margin-bottom: 0px;z-index:2;';
    //     document.querySelector('.sidebar-toggle-icon').style.display = 'none';
    //     document.querySelector('.hidden').style = 'display: block;'
    //     toggleon.style = 'display: fixed;transition: height 1s linear;height: 380px;position: flex;border-radius:10px;padding :2px;background: grey;';
    //     toggleon.style = 'display: flex';
    //     toggle_icon.style.display = 'none'; 
    //     sidebar.style = 'animation: fade 1s linear';
    //     sidebar.style.height = '450px';
    //     toggleon.style = 'animation: fade 1s linear';  
    //     toggleon.style = 'height: 390px;';  
    //     toggleon.style.height = 'fade 1s linear';   
    // }

    // function enableDarkMode() {
    // body.classList.add('dark');
    // }

    // function enableLightMode() {
    // body.classList.remove('dark');
    // }

    // function toggleColorMode() {
    // const prefersDarkMode = window.matchMedia(
    //     '(prefers-color-scheme: dark)'
    // ).matches;

    // if (prefersDarkMode) {
    //     enableDarkMode();
    // } else {
    //     enableLightMode();
    // }
    // }

    // toggleColorMode(); // Initial call to set the color mode based on system theme

    // // Listen for changes in system theme preference
    // window
    // .matchMedia('(prefers-color-scheme: dark)')
    // .addEventListener('change', toggleColorMode);

    // // toggle_icon.addEventListener('click', () => {
    // //     // toggle_icon.classList.toggle('active');
    // //     // sidebar.classList.toggle('active');
    // //     // toggleon.ClassList.toggle('active');
    // //     toggleon.style.display = 'flex';
    // //     toggleback.style.display = 'flex';
    // //     toggle_icon.style.display = 'none'; 
    // //     toggleon.style = ' /*display: none;*/ gap: 0rem;';
    // //     // toggle_icon.classList.toggle('hidden');
    // // });

    
    // toggleback.addEventListener('click', () => {
    //     toggleback.style.display = 'none';
    //     toggle_icon.style = 'display: fixed;z-index:2;';
    //     sidebar.style = 'animation: fad 1s linear';
    //     toggleon.style = 'height: 0;';
    //     sidebar.style = 'animation: fadeout 1s linear';
    //     //USE THIS ONE 
    //     // toggleon.style = 'animation: fadeout 1s linear';  
    //     // toggleon.style = 'height: 30px;';  
    //     setTimeout(function() { 
    //         toggleon.style = 'display:none';
    //         // toggleon.style.height = 'fade 1s linear'; 
    //         // toggle_icon.style.display = 'flex';
    //         document.querySelector('.hidden').style = 'display: none;'  
    //     }, 1000);
    // });

    // lists.forEach((list) => {
    //     list.addEventListener('click', (e) => {
    //         e.preventDefault();
    //         lists.forEach((list) => list.classList.remove('active'));
    //         list.classList.add('active');
    //         document
    //         .querySelectorAll('.dropdown')
    //         .forEach((dropdown) => dropdown.classList.remove('active'));
    //         dropdown_lists.forEach((list) => list.classList.remove('active'));
    //     });
    // });

    function hidde(){
        document.getElementById('add').style.display = 'none';
        document.getElementById('form').style.display = 'block';
        document.getElementById('change').style.display = 'block';
    }

    function showassinfo(){
        document.getElementById('form').style.display = 'none';
        document.getElementById('change').style.display = 'none';
        document.getElementById('add').style.display = 'block';
    }

    document.getElementById('infor').style.display ='none';
    
    function pop(){
        var modal = document.getElementById('infor');
        // var btn = document.getElementById('clos');
        // btn.onclick = function(){
            modal.style.display='block';
        // }

        var span = document.getElementById('clos');
        span.onclick = function(){
            modal.style.display = 'none';
        }
        
        window.onclick = function(event){
            if(event.target == modal){
                modal.style.display = 'none';
            }
        }
    }

    function reload(){
        document.location.href="new4.php";
    }

    document.querySelector('.sidebar').style.display ='flex';

    document.getElementById('temporary').style.display = 'none';
    document.getElementById('change').style.display = 'none';

    function hidem(){
        document.getElementById('form').style.display = 'none';
        document.getElementById('temporary').style.display = 'none';
        document.getElementById('change').style.display = 'block';
    }

    function back(){
        document.getElementById('change').style.display = 'none';
    }

    function linkk(){
        document.location.href = 'home.php?generate'; 
    }

    function dothis(){  
        var here = document.getElementById('info');
        here.style.display = 'block';
        here.style.animation = ' fade1 0.5s linear ';
    }

    function omg(){
        var here = document.getElementById('info');
        here.style.animation = 'fad 0.5s linear ';
    }
    setTimeout(dothis , 4000);

    function fthis(){  
        var here = document.getElementById('info');
        here.style.display = 'none';
        var here = document.getElementById('counterr');
        here.style.width = '0%';
    }
    setTimeout(fthis , 4000);

        function toggleEdit() {
            var elements = document.querySelectorAll('input[type="text"]');
            elements.forEach(function(element) {
                if (element.classList.contains('non-editable')) {
                    element.classList.remove('non-editable');
                    element.classList.add('editable');
                } else {
                    element.classList.remove('editable');
                    element.classList.add('non-editable');
                }
            });

            var button = document.getElementById('editButton');
            if (button.textContent === 'Enable Editing') {
                button.textContent = 'Lock Editing';
                <?php //header("location:".$_SERVER['PHP_SELF']);?>
            } else {
                button.textContent = 'Enable Editing';
            }
        }

        function validateMarks(input, outof) {
            var value = parseFloat(input.value);
            var span = input.nextElementSibling;
            if (value > outof) {
                span.textContent = 'Marks are out of limit';
            } else {
                span.textContent = '';
            }
        }

        function updateMarks(input, fname, lname, sec, subject, outof) {
            var value = parseFloat(input.value);
            validateMarks(input, outof);

            if (value <= outof) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "home.php?marks", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    co = 0;
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        co++;
                        document.getElementById('goo').addEventListener('click', () => {
                            document.write(co);
                        });
                        if((response.status === 'success')>0) {
                            var tick = input.parentElement.querySelector('.success-tick');
                            tick.style.display = 'inline';
                            dothis();
                            setTimeout(dothis , 0001);
                            omg();
                            setTimeout(omg , 4000);
                            fthis()
                            setTimeout(fthis , 4000);

                        } else {
                            console.error(response.message);
                        }
                    }
                };
                var params = "update_marks=1&fname=" + encodeURIComponent(fname) +
                             "&lname=" + encodeURIComponent(lname) +
                             "&marks=" + encodeURIComponent(value) +
                             "&subject=" + encodeURIComponent(subject) +
                             "&sec=" + encodeURIComponent(sec);
                xhr.send(params);
            }
        }

        function updateOutof(input, test_id, sek) {
            var new_outof = parseFloat(input.value);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "home.php?marks", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        var tick = input.parentElement.querySelector('.success-tick');
                        tick.style.display = 'inline';
                        // history.go(-1);
                        document.location.href = 'home.php?marks';
                        setTimeout(function() {
                            tick.style.display = 'none';
                        }, 2000);
                    }
                }
            };
            var params = "update_outof=1&new_outof=" + encodeURIComponent(new_outof) +
                         "&test_id=" + encodeURIComponent(test_id) +
                         "&sekk=" + encodeURIComponent(sek);
            xhr.send(params);
        }

</script>
</html>

<?php
$conn->close();
?>