<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include 'home.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['new_student'])) {
        $class = $_POST['class'];
        $fname = $_POST['student_fname'];
        $lname = $_POST['student_lname'];
        $imgg = $_FILES['filename']['name'];
        $prov = $_POST['prov'];
        $dist = $_POST['dist'];
        $sect = $_POST['sect'];
        $villa = $_POST['villa'];
        $mother = $_POST['mothername'];
        $father = $_POST['fathername'];
        $tel1 = '+25'.$_POST['tel1'];
        $tel2 = '+25'.$_POST['tel2'];
        $level = $_POST['nlevel'];
        $section = $_POST['nsec'];

        if($imgg==""){
            $img = "default.png";
        }
        else{
            $img = $imgg;
        }
        // if (file_exists("passports/".$img)){ 
        //     echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
        //         <div class="modal-dialog" role="document">
        //         <div class="modal-content">
        //             <div class="modal-header bg-primary text-light">
        //             <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
        //             <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
        //                 <span aria-hidden="true">&times;</span>
        //             </button>
        //             </div>
        //             <div class="modal-body">
        //                 <center><p>Image exists</p></center>
        //             </div>
        //             <div id="counterr"></div>
        //         </div>
        //         </div>
        //     </div>';
        // }
        // else{
            move_uploaded_file($_FILES['filename']['tmp_name'],"passports/".$img); 
        // }

        $check = "SELECT * FROM students WHERE class='$class' AND fname='$fname' AND lname='$lname' ";
        $chec = mysqli_query( $conn , $check );

        if(mysqli_num_rows($chec) > 0){
            echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <center><p style="color: grey;">Student exists</p></center>
                </div>
                <div id="counterr"></div>
              </div>
            </div>
          </div>';
        } else{
            $sql = "INSERT INTO students (class , fname, lname, classid, level , count, dir, prov, dist, sect, villa, mother, father, tel1, tel2, section ) VALUES ('$class', '$fname', '$lname', (SELECT id FROM class WHERE class='$class' ) , (SELECT level FROM class WHERE class='$class' ) , '1' , '$img', '$prov', '$dist', '$sect', '$villa', '$mother', '$father', '$tel1', '$tel2', '$section' )";
            // if (mysqli_query($conn, $sql)) {
            //     echo "New student added successfully!";
            // } else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }
    
    
    
            // $query1 = "SELECT lesname , outof FROM lesson";
            // $res1 = mysqli_query( $conn , $query1 );
    
            // $query2 = "SELECT id FROM class WHERE class = '$class_name' ";
            // $res2 = mysqli_query( $conn , $query2 );
            // $rowe = mysqli_fetch_assoc($res2);
            // $classid = $rowe['id'];
    
            // while($row = mysqli_fetch_assoc($res1)){
            //     $subject = $row['lesname'];
            //     $outof = $row['outof'];
            //     $query3 = "INSERT INTO assessments ( name , sec , typofass , outof , class , classid  ,term , subject ) VALUES ( 'Test 1' , 'cat1a' , 'test' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Test 2' , 'cat1b' , 'test' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Test 3' , 'cat1c' , 'test' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Test 4' , 'cat1d' , 'test' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Exam' , 'ex1' , 'exam' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Test 1' , 'cat2a' , 'test' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject'), ( 'Test 2' , 'cat2b' , 'test' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject'), ( 'Test 3' , 'cat2c' , 'test' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject'), ( 'Test 4' , 'cat1d' , 'test' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject'), ( 'Exam' , 'ex2' , 'exam' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject') , ( 'Test 1' , 'cat3a' , 'test' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject'), ( 'Test 2' , 'cat3b' , 'test' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject'), ( 'Test 3' , 'cat3c' , 'test' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject'), ( 'Test 4' , 'cat3d' , 'test' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject'), ( 'Exam' , 'ex3' , 'exam' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject')";
            //     $res3 = mysqli_query( $conn , $query3 );
            // }

            move_uploaded_file($_FILES['filename']['tmp_name'],"passports/".$img);
    
            if ($re = mysqli_query($conn, $sql)) {
                echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                      <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                          <center><p style="color:grey;">Student added</p></center>
                    </div>
                    <div id="counterr"></div>
                  </div>
                </div>
              </div>';
            } // else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }
    
    
            // $row = mysqli_fetch_assoc($re)
            // $iddd = $row['id'];
    
    
            $query1 = "SELECT lesname , outof FROM lesson WHERE level =(SELECT level FROM class WHERE class='$class') ";
            $res1 = mysqli_query( $conn , $query1 );

            while($row = mysqli_fetch_assoc($res1)){
                $blesson = $row['lesname'];
                $boutof = $row['outof']; 
                $query2 = "INSERT INTO marks ( stid , fname , lname , dir, date , class , classid , level , subject , outof , cat1a , cat1b , cat1c , cat1d , cat11 , ex1 , tot1 , be1 , cat2a ,	cat2b , cat2c , cat2d , cat22 , ex2 , tot2 , be2 , cat3a , cat3b , cat3c , cat3d , cat33 , ex3 , tot3 , be3 ) VALUES ( (SELECT id FROM students WHERE class='$class' AND fname='$fname' AND lname='$lname') , '$fname' , '$lname' , (SELECT dir FROM students WHERE class='$class' AND fname='$fname' AND lname='$lname'), CURDATE(), '$class' , (SELECT id FROM class WHERE class='$class' ) , (SELECT level FROM class WHERE class='$class'), '$blesson' , '$boutof' , '0' , '0' , '0' , '0' , '0' , '0' , '0' , '40' , '0' , '0' , '0' , '0' , '0' , '0' , '0' , '40' , '0' , '0' , '0' , '0' , '0' , '0' , '0' , '40') ";
                $res2 = mysqli_query( $conn , $query2 );
            }
        }
    } elseif (isset($_POST['fetch_students'])) {
        $stid = $_POST['id'];
        $students_result = mysqli_query($conn, "SELECT * FROM students WHERE id='$stid'");
        $students = [];
        while ($row = mysqli_fetch_assoc($students_result)) {
            $students[] = $row;
        }
        echo json_encode($students);
        exit;    

    }
}    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        body{
            margin:0;
            padding:0;
            scroll-behavior: smooth;

        }
        ::-webkit-scrollbar {
            width: 0px;
        }   
        html {
        font-size: 62.5%;
        scroll-behavior: smooth;
        } 
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
            height: 400px;
            border: 1px chartreuse solid;
        }
        #addst{
            display: block;
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
        #infor{
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

        #info{ margin-right: 10px; overflow: auto; position: fixed; z-index: 2; right: 0; align-items: center; animation:fade 0.5s linear; }
        #info1{ margin-right: 10px; overflow: auto; position: fixed; z-index: 2; right: 0; align-items: center; animation:fade 0.5s linear; display:none; }
        #counterr{ margin-bottom: 0px; height: 2px; background: red; animation: progress 4s linear; };
        #counterr1{ margin-bottom: 0px; height: 2px; background: red; animation: progress 4s linear; };

        .modal-body{ -webkit-box-flex: 1; background-color: white; flex: 1 1 auto; padding: 1rem; position: relative; height: 50px;}
        .modal-dialog{ position:relative; width:auto; margin:0.5rem; pointer-events: none; }
        .modal-content{background-color: #fff; max-height: 120px;background-clip: padding-box; flex-direction: column; width: 100%; outline: 0; border-radius: 0.3rem; pointer-events: auto; color: black; position: relative; display: flex; -webkit-box-orient: vertical; -webkit-box-direction: normal; width:100%; border: 1px solid rgba(0, 0, 0, 0.2); } 
        .modal-title{ float: left; margin-bottom: 0; line-height: 1.5; font-weight: 400; font-family: "Poppins", Arial, sans-serif; } 
        .close{ float: right;font-size:1.5rem; font-weight:700; line-height: 1; text-shadow: 0 1px 0 #fff; background: transparent; cursor:pointer; opacity: 0.5; transition: .3s all ease; text-transform: none; overflow: visible; border-radius: 0; background-color: transparent; border: 0; -webkit-appearance: none; -moz-appearance: none; appearance: none; padding: 1rem 1rem; margin: -1rem -1rem -1rem auto; } 
        .modal-header{ -webkit-box-align: start; flex-shrink: 0; display: flex; align-items: flex-start; justify-content: space-between; padding: 1rem 1rem;  -webkit-box-pack: justify; border-bottom: 1px solid #dee2e6; border-top-left-radius: 0.3rem; border-top-right-radius: 0.3rem; }
        .text-light{ color: #f8f9fa !important; }
        .bg-primary{ background-color: #007bff !important; }

        #scroll{ overflow-y: scroll; height: 262px; background: rgba(255, 255, 255, 0.276); margin-left:100px; padding:10px; border-radius: 10px; margin-top:-20px; width: 78%;}
        #scroll::-webkit-scrollbar { width: 5px; background: transparent; scrollbar-color: blue; border: 1px solid rgba(255, 255, 255, 0.276); border-radius: 2px; }
        #scroll::-webkit-scrollbar-thumb { border-radius: 1px; border: 1px solid blue; background-clip: content-box; background-color: blue; width: 5px; border-radius: 7px; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 15px; text-align: left; }

        .btn { padding: 12px 0px; cursor: pointer; margin-right: 10px; }
        .btn-primary { background-color: #007bff; color: #fff; border: none; }
        .btn-secondary { background-color: #6c757d; color: #fff; border: none; }
        .btn-danger { background-color: #dc3545; color: #fff; border: none; }
        
        @-webkit-keyframes fade1 {
                0% {
                    margin-top:-100px;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }

                to { 
                    margin-top: -10px;
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

        /* a{
            align-self:center;
            margin: 5px;
            color: white;
        } */

        .left1{
            gap: 10px;
            justify-content: space-between;
            align-items: center;
            display: flex;
            float: left;
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

        #change{ margin-top:0px; }
        #editButton{ background:black;margin-right:50px; margin-bottom: 50px; width:40px;height:40px;border-radius:50%; border:none; }
        .hidden{ display: none; }


    </style>
</head>
<body>
    <div class="nav top" style="background:transparent;margin-left:50px;">
        <div class="left1" style="padding-left:10px;" style="margin-left:80px;">
            <div class="logos" style="margin-left: 0px;">
                <img class="logo" src="logo2.jpg" alt="logo">
            </div>
            <a href="new4.php"><h3>ESK MS</h3></a>
            <input type="text" class="entry" placeholder="Search for artists, songs, albums!">
        </div>
        <!-- <div class="right"> -->
            <div class="profile2" style="margin-right:50px;">
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="fill: white; pointer-events: none; padding-top: 10px; padding-left: 10px; display: inherit; width: 80%; height: 80%;"><path d="M12 9.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5m0-1c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5 3.5-1.57 3.5-3.5-1.57-3.5-3.5-3.5zM13.22 3l.55 2.2.13.51.5.18c.61.23 1.19.56 1.72.98l.4.32.5-.14 2.17-.62 1.22 2.11-1.63 1.59-.37.36.08.51c.05.32.08.64.08.98s-.03.66-.08.98l-.08.51.37.36 1.63 1.59-1.22 2.11-2.17-.62-.5-.14-.4.32c-.53.43-1.11.76-1.72.98l-.5.18-.13.51-.55 2.24h-2.44l-.55-2.2-.13-.51-.5-.18c-.6-.23-1.18-.56-1.72-.99l-.4-.32-.5.14-2.17.62-1.21-2.12 1.63-1.59.37-.36-.08-.51c-.05-.32-.08-.65-.08-.98s.03-.66.08-.98l.08-.51-.37-.36L3.6 8.56l1.22-2.11 2.17.62.5.14.4-.32c.53-.44 1.11-.77 1.72-.99l.5-.18.13-.51.54-2.21h2.44M14 2h-4l-.74 2.96c-.73.27-1.4.66-2 1.14l-2.92-.83-2 3.46 2.19 2.13c-.06.37-.09.75-.09 1.14s.03.77.09 1.14l-2.19 2.13 2 3.46 2.92-.83c.6.48 1.27.87 2 1.14L10 22h4l.74-2.96c.73-.27 1.4-.66 2-1.14l2.92.83 2-3.46-2.19-2.13c.06-.37.09-.75.09-1.14s-.03-.77-.09-1.14l2.19-2.13-2-3.46-2.92.83c-.6-.48-1.27-.87-2-1.14L14 2z"></path></svg>
            </div>
            <div class="profile1" style="margin-right:140px;">
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="fill: white; pointer-events: none; padding-top: 10px; padding-left: 10px; display: inherit; width: 80%; height: 80%;"><path d="M10 20h4c0 1.1-.9 2-2 2s-2-.9-2-2zm10-2.65V19H4v-1.65l2-1.88v-5.15C6 7.4 7.56 5.1 10 4.34v-.38c0-1.42 1.49-2.5 2.99-1.76.65.32 1.01 1.03 1.01 1.76v.39c2.44.75 4 3.06 4 5.98v5.15l2 1.87zm-1 .42-2-1.88v-5.47c0-2.47-1.19-4.36-3.13-5.1-1.26-.53-2.64-.5-3.84.03C8.15 6.11 7 7.99 7 10.42v5.47l-2 1.88V18h14v-.23z"></path></svg>
            </div>
    </div>
    <div id="stinfo">
        <div id="box1" style=""></div>
        <div id="infor">
            <div id="left">
                <form action=""></form>
                <div id="box2" style="display: flex;overflow:hidden;">
                    <!-- <input type="" src="passports/default.png" alt=""> -->
                    <img src="passports/logo1.jpg" alt="" style="float:left;width:80px;height:80px;border-radius:50%;margin-left:10px;margin-top:0px;" id="one">
                    <h5 id="one" style="float:right;margin-top:20px;padding-left: 20%;">STUDENT INFORMATION</h2>
                </div>
                <div id="box3" style="padding-top:10px;">
                    <ul>
                        <li><P>Names:<input type="text" name="lname" value="MUCYO" style="margin-left: 5px;width:60px;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"><input type="text" name="fname" value="Josue" style="margin-left: 2px;width:60px;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></P></li>
                        <li><p>Class: <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                        <li><p>Level:  <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                        <li><p>Section :  <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                        <li><p>Reg number :  <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                    </ul>
                </div>
            </div>
            <div id="right">
                <div id="box4" style="">
                    <h4 style="padding:45px 0px 0 20px;">OTHER INFORMATION</h1>  
                </div>
                <div id="box5" style="overflow-y: scroll;">
                    <h4 style="padding-left: 10px;color:white;">Residence</h2>
                    <hr style="margin-left: 10px;width:90%;background:white;">
                    <ul>
                        <li><P>Province:  <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></P></li>
                        <li><p>District:  <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                        <li><p>Sector:  <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                        <li><p>Village :  <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                    </ul>
                    <h4 style="padding-left: 10px;margin-top:30px;color:white;">Parental information</h2>
                    <hr style="margin-left: 10px;width:90%;background:white;">
                    <ul>
                        <li><P>Fathername:  <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></P></li>
                        <li><p>Mothername:  <input type="text" name="lname" value="S1A" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                        <li><p>Tel-1: <input type="tel" name="tel" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                        <li><p>Tel-2 : <input type="tel" name="tel" "margin-left: style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;"></p></li>
                    </ul>
                </div>
            </div>
        </div>      
    </div>
    <div id="add">
        <form method="POST" enctype="multipart/form-data" id ="form2">
            <div id="box1" style="">
                <center><h2 style="color:grey; padding:15px 0 0 0;">ADD STUDENT</h2></center>
            </div>
            <div id="infor">
                <div id="left">
                    <div id="box2" style="display: flex;overflow:hidden;">
                        <!-- <input type="" src="passports/default.png" alt=""> -->
                        <img src="passports/${student.dir}" alt="" style="float:left;width:80px;height:80px;border-radius:50%;margin-left:10px;margin-top:0px;" id="one">
                        <h5 id="one" style="float:right;margin-top:20px;padding-left: 20%;">STUDENT INFORMATION</h2>
                    </div>
                    <div id="box3" style="padding-top:10px;">
                        <ul>
                            <li><P>Names:<input type="text" name="student_fname" value="${student.fname}"style="margin-left: 5px;width:60px;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Firstname"><input type="text" value="${student.lname}"name="student_lname" style="margin-left: 2px;width:60px;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Lastname"></P></li>
                            <li><p>Class: <select type="text" name="class" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: grey;" required><option value="">${student.class}</option><?php $query = "SELECT class FROM class"; $res = mysqli_query( $conn , $query); while($row = $res->fetch_assoc()){ echo "<option value=".$row['class'].">".$row['class']."</option>"; }?></select></p></li>
                            <li><p>Level:  <select type="text" name="nlevel" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: grey;" required><option value="">${student.level}</option><option value="Ordinary level">Ordinary level</option><option value="Advanced level">Advanced level</option></select></p></li>
                            <li><p>Section :  <input type="text" name="nsec" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="${student.section}"></p></li>
                            <li><p><input type="file" name="filename" style="margin-left: 0px;width:89%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Image"></p></li>
                        </ul>
                    </div>
                </div>
                <div id="right">
                <div id="box4" style="">
                    <h4 style="padding:45px 0px 0 20px;">OTHER INFORMATION</h1>  
                </div>
                <div id="box5" style="overflow-y: scroll;">
                    <h4 style="padding-left: 10px;color:white;">Residence</h2>
                    <hr style="margin-left: 10px;width:90%;background:white;">
                    <ul>
                        <li><P>Province:  <input type="text" value="${student.prov}" name="prov" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Province"></P></li>
                        <li><p>District:  <input type="text" value="${student.dist}" name="dist" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="District"></p></li>
                        <li><p>Sector:  <input type="text" value="${student.sect}" name="sect" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Sector"></p></li>
                        <li><p>Village :  <input type="text" value="${student.villa}" name="villa" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Village"></p></li>
                    </ul>
                    <h4 style="padding-left: 10px;margin-top:30px;color:white;">Parental information</h2>
                    <hr style="margin-left: 10px;width:90%;background:white;">
                    <ul>
                        <li><P>Fathername:  <input type="text" value="${student.father}" name="mothername" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Father"></P></li>
                        <li><p>Mothername:  <input type="text" value="${student.mother}" name="fathername" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Mother"></p></li>
                        <li><p>Telephone-1: <input type="tel" value="${student.tel1}" name="tel1" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Telephone 1"></p></li>
                        <li><p>Telephone-2 : <input type="tel" value="${student.tel2}"name="tel2" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Telephone 2"></p></li>
                        </ul>
                </div>
            </div>
        </div> 
    </form>
    </div>
    <div id="addst" class="hidden">
        <div id="addstu">

        </div>
        <div id="footer" style="background:chartreuse;padding-bottom:1000px;height:10px;margin-top: 10px;">
            <button onclick="hide()" style="background:orange;width:40px;height:40px;border-radius:50%;border: 1px solid #03A9F4;margin-left:10%;margin-top:15px;">&larr;</button>
            <button type="submit" class="btn btn-primary" name="new_student" onclick="reload()" style="background:orange;width:40px;height:40px;border-radius:50%;border: 1px solid #03A9F4;margin-left:56%;margin-top:15px;" form="form2">&rarr;</button>
        </div>
    </div>
    <div sttyle="display:flex;">
        <center><h2 style="margin-top:100px;width: 80%;">ALL STUDENTS</h2></center>
        <button id="editButton" onclick="show()" style="float:right;margin-top:-35px;"><p style="font-size: xx-large;font-weight: bolder;margin:0px 0 0 0;">+</p></button><br><br><br><br>
    </div>
    <div id="change">
        <div id="scroll">
            <table class="table table-hover text-center" id="table1">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Passport</th>
                        <th scope="col">Student's name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $sql= "SELECT * FROM students ORDER BY class ASC";
                $result = mysqli_query($conn , $sql);
                while($row = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td class = "td-sm"><img src="passports/<?php echo $row['dir']?>" alt="" style="width:50px;height:50px;border-radius:50%;"></td>
                    <td class = "td-sm"><?php echo $row['fname']. ' ' .$row['lname'] ?></td>
                    <td class = "td-sm">
                        <button class="btn btn-primary" onclick="editst('<?php echo $row['id']; ?>')" style="width:50px;"><p style="margin:0;color:black">EDIT</p><!--<i class="fa fa-pencil">--></i></button>
                        <button class="btn btn-danger btn-sm" onclick="deleteTest('<?php echo $row['id']; ?>')" style="padding-left:-2px;width:40px;"><p style="font-size:1.5rem; font-weight:700; line-height: 1; text-shadow: 0 1px 0 #fff; background: transparent; cursor:pointer; opacity: 0.5; transition: .3s all ease; text-transform: none; border-radius: 0; background-color: transparent; border: 0; appearance: none; padding: 1rem 0rem; margin: -1rem 0rem -1rem auto;color:black;">&times;</p><!--<i class="fa fa-pencil">--></i></button>
                        <button class="btn btn-secondary btn-sm" onclick="showClassOptions('<?php echo $row['id']; ?>')" style="padding-left:-2px;width:40px;"><p style="font-size:1.5rem; font-weight:700; line-height: 1; text-shadow: 0 1px 0 #fff; background: transparent; cursor:pointer; opacity: 0.5; transition: .3s all ease; text-transform: none; border-radius: 0; background-color: transparent; border: 0; appearance: none; padding: 1rem 0rem; margin: -1rem 0rem -1rem auto;color:black;">&rarr;</p></button>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>   
    </div>     
    <script>
        document.getElementById('addst').style.display = 'none';
        document.getElementById('footer').style.display = 'none';

        function show(){
            document.getElementById('add').style.display = 'block';
        }

        function hide(){
            document.getElementById('addst').style.display = 'none';
        }

        function editst(id){
            document.getElementById('addst').style.display = 'block';
            document.getElementById('footer').style.display = 'block';
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'fetch_students': true,
                    'id': id
                })
            })
            .then(response => response.json())
            .then(data => {
                disp = document.getElementById('addstu');
                // disp.classList.remove('hidden');
                disp.innerHTML = '';
                data.forEach(student => {
                disp.innerHTML += `<form method="POST" enctype="multipart/form-data" id ="form2">
                        <div id="box1" style="">
                            <center><h2 style="color:grey; padding:15px 0 0 0;">ADD STUDENT</h2></center>
                        </div>
                        <div id="infor">
                            <div id="left">
                                <div id="box2" style="display: flex;overflow:hidden;">
                                    <!-- <input type="" src="passports/default.png" alt=""> -->
                                    <img src="passports/${student.dir}" alt="" style="float:left;width:80px;height:80px;border-radius:50%;margin-left:10px;margin-top:0px;" id="one">
                                    <h5 id="one" style="float:right;margin-top:20px;padding-left: 20%;">STUDENT INFORMATION</h2>
                                </div>
                                <div id="box3" style="padding-top:10px;">
                                    <ul>
                                        <li><P>Names:<input type="text" name="student_fname" value="${student.fname}"style="margin-left: 5px;width:60px;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Firstname"><input type="text" value="${student.lname}"name="student_lname" style="margin-left: 2px;width:60px;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Lastname"></P></li>
                                        <li><p>Class: <select type="text" name="class" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: grey;" required><option value="">${student.class}</option><?php $query = "SELECT class FROM class"; $res = mysqli_query( $conn , $query); while($row = $res->fetch_assoc()){ echo "<option value=".$row['class'].">".$row['class']."</option>"; }?></select></p></li>
                                        <li><p>Level:  <select type="text" name="nlevel" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: grey;" required><option value="">${student.level}</option><option value="Ordinary level">Ordinary level</option><option value="Advanced level">Advanced level</option></select></p></li>
                                        <li><p>Section :  <input type="text" name="nsec" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="${student.section}"></p></li>
                                        <li><p><input type="file" name="filename" style="margin-left: 0px;width:89%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Image"></p></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="right">
                                <div id="box4" style="">
                                    <h4 style="padding:45px 0px 0 20px;">OTHER INFORMATION</h1>  
                                </div>
                                <div id="box5" style="overflow-y: scroll;">
                                    <h4 style="padding-left: 10px;">Residence</h2>
                                    <hr style="margin-left: 10px;width:90%;">
                                    <ul>
                                        <li><P>Province:  <input type="text" value="${student.prov}" name="prov" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Province"></P></li>
                                        <li><p>District:  <input type="text" value="${student.dist}" name="dist" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="District"></p></li>
                                        <li><p>Sector:  <input type="text" value="${student.sect}" name="sect" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Sector"></p></li>
                                        <li><p>Village :  <input type="text" value="${student.villa}" name="villa" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Village"></p></li>
                                    </ul>
                                    <h4 style="padding-left: 10px;margin-top:30px;">Parental information</h2>
                                    <hr style="margin-left: 10px;width:90%;">
                                    <ul>
                                        <li><P>Fathername:  <input type="text" value="${student.father}" name="mothername" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Father"></P></li>
                                        <li><p>Mothername:  <input type="text" value="${student.mother}" name="fathername" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Mother"></p></li>
                                        <li><p>Telephone-1: <input type="tel" value="${student.tel1}" name="tel1" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Telephone 1"></p></li>
                                        <li><p>Telephone-2 : <input type="tel" value="${student.tel2}"name="tel2" style="margin-left: 5px;width:57%;background: transparent;border: 0px;border-bottom: 1px solid red;color: white;" required placeholder="Telephone 2"></p></li>
                                    </ul>
                                </div>
                            </div>
                        </div> 
                    </form>`;
                });
            });
        }

        function dothis(){  
            var here = document.getElementById('info');
            here.style.animation = ' fad 0.5s linear ';

            var here10 = document.getElementById('info1');
            here10.style.animation = ' fad 0.5s linear ';
            here10.style.display= 'block';
        }
        setTimeout(dothis , 4000);

        function fthis(){  
            var here = document.getElementById('info');
            here.style.display = 'none';
            var here = document.getElementById('counterr');
            here.style.width = '0%';

            var here1 = document.getElementById('info1');
            here1.style.display = 'none';
            var here2 = document.getElementById('counterr1');
            here2.style.width = '0%';
        }
        setTimeout(fthis , 4000);
    </script>
</body>
</html>