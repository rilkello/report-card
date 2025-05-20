<?php
// include ('index.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['dashboard'])) {
    include 'new2.php';
}
if (isset($_GET['marks'])) {
    include 'new4.php';
}
if (isset($_GET['generate'])) {
    include 'new3.php';
}
if (isset($_GET['again'])) {
    include 'new1.php';
}
if (isset($_GET['students'])) {
    include 'new8.php';
}
if (isset($_GET['classes'])) {
    include 'classes.php';
}
if (isset($_GET['addclass'])) {
    include 'addclass.php';
}
if (isset($_GET['subject'])) {
    include 'adduser.php';
}
if (isset($_GET['addsub'])) {
    include 'adduser.php';
}
if (isset($_GET['assess'])) {
    include 'adduser.php';
}
if (isset($_GET['addass'])) {
    include 'adduser.php';
}
if (isset($_GET['term'])) {
    include 'adduser.php';
}
if (isset($_GET['addterm'])) {
    include 'adduser.php';
}
if (isset($_GET['report_cards'])) {
    include 'report_cards.php';
}

// if (isset($_GET['id'])){
//     $id = $_GET['id'];
//     $loggedin = TRUE;

//     $sql = "SELECT * FROM users WHERE id = '$id'";
//     $result = $conn->query($sql);
//     $arr = mysqli_fetch_assoc($result);

//     session_start();
//     $_SESSION['user'] = $arr['fname'].' '.$arr['lname'];
//     $_SESSION['id'] = $id;
    
//     // echo $_SESSION['user'];
// }

// if(!$loggedin){
//     header("location:../index.php");
// }
?>
<?php include 'header.php'; ?>
<style>
    /* body.dark {
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
        max-width: 100rem;
        margin: 0 auto;
        padding: 0 8rem;
        } */

        body.dark .icon-img,
        body.dark .dropdown-arrow img,
        body.dark .dropdown-link img,
        body.dark .sidebar-toggle-icon img{
        filter: brightness(0) invert(1);
        }
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
    body {
        font-size: 1rem;
        font-family: 'Inter', sans-serif;
        /* background: url('images/bg.jpeg') no-repeat center/cover; */
        height: 100vh;
        --bg: #fff;
        --text: #475569;
        --active-link: #edeef3;
        --divider: 0.1rem solid #d9d9da;
        --profile-text-1: #000;
        --profile-text-2: #8a8b8c;
        --dropdown-bg: rgb(245, 245, 245);
        scroll-behavior: smooth;
        overflow-y: hidden;
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
    html {
        font-size: 85.5%;
        scroll-behavior: smooth;
    }  
    
    ::-webkit-scrollbar {
        width: 0;
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
        .list1{
            /* align-self: center; */
            position: relative;
            display: inline-block;
            /* width: 30px; */
            padding-left: 5px;
            padding-right: 20px;
            /* padding-top: 5px; */
            padding-bottom: 10px;
            margin-bottom: 10px;
            margin-right: 3.5%;
            margin-left: 3.5%;
            border-radius: 0.8rem;
            background-blend-mode: soft-light, normal;
            transition: all 0.5s ease;
        }
        .list1:active{
            padding-top: 4px;
            width: 30px;
            height: 30px;
            background: var(--active-link);
        }
        .icon-img {
            padding:0px;
            width: 2rem;
            height: 2rem;
        }
        .jeeze{
            padding-right: 10px;
            padding-left: 10px;
            padding-bottom: 10px;
            position: fixed;
            width: 100%;
            justify-content: space-between;
        }
        /* .list1.active {
            padding-top: 4px;
            width: 30px;
            height: 30px;
            background: var(--active-link);
        } */
        .link,
        .dropdown-link {
        display: flex;
        gap: 2rem;
        align-items: center;
        color: var(--text);
        }
        .link span,
        .dropdown-link span {
        font-size: 1.8rem;
        font-weight: 500;
        }
        .sidebar-top1{
            /* height: 100px;*/
            width: 100%; 
            background: red;
            align-items: center;
            margin-bottom: 15px;
        }
        


        .sidebar {
        height:55px;
        bottom:0;
        width: 55px;
        background: var(--bg);
        padding: 0.5rem;
        margin-left: 0;
        margin-bottom: 15px;
        border-radius: 1.5rem;
        position: fixed;
        left: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow-x: hidden;
        overflow-y: scroll;
        z-index: 10;
        }



        .sidebar.active {
        gap:0px;
        /* overflow-y: scroll; */
        }

        .sidebar.active .profile-img {
        width: 3rem;
        height: 3rem;
        }

        .sidebar.active .list {
        width: 4rem;
        height: 4rem;
        padding: 1rem 1.1rem;
        }

        .sidebar-toggle {
        display: flex;
        justify-content: center;
        }

        .sidebar-toggle .sidebar-toggle-icon {
        width: 4.5rem;
        height: 4.5rem;
        background: var(--dropdown-bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        }

        .sidebar-toggle-icon img {
        width: 3rem;
        transform: rotate(180deg);
        }

        .sidebar-toggle-icon.active img {
        transform: rotate(120deg);
        }

        .list,
        .dropdown-list {
        padding: 0.5rem 1rem;
        margin-bottom: 1rem;
        border-radius: 0.8rem;
        background-blend-mode: soft-light, normal;
        transition: all 0.5s ease;
        }

        .icon-img {
        padding:0px;
        width: 2rem;
        height: 2rem;
        }

        .list.active {
        background: var(--active-link);
        }

        .link,
        .dropdown-link {
        display: flex;
        gap: 2rem;
        align-items: center;
        color: var(--text);
        }

        .link span,
        .dropdown-link span {
        font-size: 1.8rem;
        font-weight: 500;
        }

        .dropdown-arrow {
        width: 100%;
        text-align: right;
        }

        .dropdown-link:not(:last-child) {
        margin-bottom: 0.5rem;
        }

        .dropdown-link {
        padding: 1rem 1.3rem;
        border-radius: 0.8rem;
        transition: all 0.5s ease;
        }

        .dropdown-list.active {
        margin-bottom: 0;
        background: transparent;
        }

        .dropdown-list .dropdown-arrow img {
        width: 1.3rem;
        transition: transform 0.5s ease;
        }

        .dropdown-list.active .dropdown-arrow img {
        transform: rotate(90deg);
        }

        .dropdown {
        height: 0;
        background: var(--dropdown-bg);
        border-radius: 1rem;
        clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
        transition: all 0.5s cubic-bezier(0.51, -0.02, 0.4, 0.91);
        }

        .dropdown.active {
        margin-top: 1rem;
        height: 100%;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
        transition: all 0.5s cubic-bezier(0.51, -0.02, 0.4, 0.91);
        }

        .dropdown-link.active {
        background-blend-mode: soft-light, normal;
        background: var(--active-link);
        }

        .profile {
        padding: 0 0.8rem;
        }

        .profile-content {
        padding: 1rem 0 0 0;
        margin-top: 1rem;
        border-top: var(--divider);
        display: flex;
        /* align-items: center; */
        gap: 2rem;
        }

        .profile-img {
        width: 3rem;
        height: 3rem;
        }

        .profile-name {
        color: var(--profile-text-1);
        padding-bottom: 0.3rem;
        }

        .profile-email {
        color: var(--profile-text-2);
        }

        @media (max-width: 375px) {
            .sidebar {
                width: 28rem;
            }
        }
        .sidebar-toggle{
        display: block;
        justify-content: center;
        }

        .sidebar-toggle .sidebar-toggle-icon1 {
        width: 4.5rem;
        height: 4.5rem;
        padding:6px;
        background: var(--dropdown-bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        bottom:0;
        }

        .sidebar-toggle1{
        display: block;
        justify-content: center;
        }

        .sidebar-toggle1 .sidebar-toggle-icon1 {
        width: 4.5rem;
        height: 4.5rem;
        padding:6px;
        background: var(--dropdown-bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        bottom:0;
        }

        .hide{
            /* animation: fade 1s linear; */
            display: none;
        }
        .bg{
            gap: 0rem;
            /* display: none; */
            transition: height 1s linear;
            height:0px;
            /* position: flex; */
            border-radius:10px;
            padding :2px;
            background: grey;
        }
        .bg.active{
            display: fixed;
            transition: height 1s linear;
            height: 254px;
            position: flex;
            border-radius:10px;
            padding :2px;
            background: grey;
        }

        @-webkit-keyframes fadeout {
                0% {
                    height: 450px;
                }

                to {
                    height: 55px;
                }
        } 


        @-webkit-keyframes fades {
                0% {
                    height: 10px;
                }

                to {
                    height: 450px;
                }
        } 
</style>  
<div class="nav bottom">
    <div class="sidebar-top1">
        <ul class="jeeze">
                <li class="list1">
                <a href="#!" class="link">
                    <img src="images/icon-1.svg" alt="icon" class="icon-img" onclick="document.location.href='home.php?dashboard'" />
                    <!-- <span>Home</span> -->
                </a>
                </li>
                <li class="list1">
                <a href="#!" class="link">
                    <img src="images/icon-2.svg" alt="icon" class="icon-img" onclick="document.location.href='home.php?marks'" />
                    <!-- <span>Campaigns</span> -->
                </a>
                </li>
                <li class="list1">
                <a href="#!" class="link">
                    <img src="images/icon-9.svg" alt="icon" class="icon-img" onclick="document.location.href='home.php?generate'" />
                    <!-- <span>Flows</span> -->
                </a>
                </li>
                <li class="list1">
                <a href="#!" class="link">
                    <img src="images/icon-10.svg" alt="icon" class="icon-img" onclick="document.location.href='home.php?again'">
                    <!-- <span>Forms</span> -->
                </a>
                </li>
                <li class="list1">
                <a href="#!" class="link">
                    <img src="images/icon-8.svg" alt="icon" class="icon-img" onclick="document.location.href='home.php?students'"/>
                    <!-- <span>Chats</span> -->
                </a>
                </li>
                <!-- <li class="list1">
                <a href="#!" class="link">
                    <img src="images/icon-8.svg" alt="icon" class="icon-img" />
                    <span>Chats</span>
                </a>
                </li> -->
                <li class="list1">
                <a href="#!" class="link">
                    <img src="images/settings.svg" alt="icon" class="icon-img" />
                    <!-- <span>Settings</span> -->
                </a>
                </li>
        </ul>    
    </div>
</div>


<div class="sidebar">
    <div class="hide">
        <div class="bg">
            <div class="sidebar-top">
                <li class="list active">
                    <a href="#!" class="link" onclick="history.back()">
                        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
                        <span>Home</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#!" class="link" onclick="history.forward()">
                        <img src="images/icon-2.svg" alt="icon" class="icon-img" />
                        <span>Campaigns</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#!" class="link" onclick="showassinfo()">
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
</div>  


<!-- <nav class="nav navbar container navbar-light bg-dark" style="margin-top:10px;">
	<a class="nav nav-link" href="index.php?dashboard">Marks</a>
    <a class="nav nav-link" href="index.php?students">Students</a>
	<a class="nav nav-link" href="index.php?classes">Classes</a>
	<a class="nav nav-link" href="index.php?subject">Subjects</a>
	<a class="nav nav-link" href="index.php?assess">Assessments</a>
	<a class="nav nav-link" href="index.php?term">Terms</a>
</nav>  -->

<script>
    let sidebar = document.querySelector('.sidebar');
    let lists = document.querySelectorAll('.list');
    let toggle_icon = document.querySelector('.sidebar-toggle-icon');
    const body = document.body;
    let toggleback = document.querySelector('.sidebar-toggle1');
    let toggleon = document.querySelector('.bg');

    // toggleon.style.height = '100px';
    // toggle_icon.style.display = 'flex'; 
    toggleback.style = 'display: none';
    // toggleon.style = 'display: block; gap: 0rem;';

    function show(){
        toggleback.style = 'display: fixed;margin-bottom: 0px;z-index:2;';
        document.querySelector('.sidebar-toggle-icon').style.display = 'none';
        toggleon.style = 'animation: fades 1s linear';  
        document.querySelector('.hide').style = 'display: block;';
        toggleon.style = 'display: fixed;transition: height 1s linear;height: 380px;position: flex;border-radius:10px;padding :2px;background: grey;';
        toggleon.style = 'display: flex';
        toggle_icon.style.display = 'none'; 
        sidebar.style = 'animation: fades 1s linear';
        sidebar.style.height = '455px';
        toggleon.style = 'height: 390px;';  
        toggleon.style.height = '400';   
    }

    function enableDarkMode() {
    body.classList.add('dark');
    }

    function enableLightMode() {
    body.classList.remove('dark');
    }

    function toggleColorMode() {
    const prefersDarkMode = window.matchMedia(
        '(prefers-color-scheme: dark)'
    ).matches;

    if (prefersDarkMode) {
        enableDarkMode();
    } else {
        enableLightMode();
    }
    }

    toggleColorMode(); // Initial call to set the color mode based on system theme

    // Listen for changes in system theme preference
    window
    .matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', toggleColorMode);

    // toggle_icon.addEventListener('click', () => {
    //     // toggle_icon.classList.toggle('active');
    //     // sidebar.classList.toggle('active');
    //     // toggleon.ClassList.toggle('active');
    //     toggleon.style.display = 'flex';
    //     toggleback.style.display = 'flex';
    //     toggle_icon.style.display = 'none'; 
    //     toggleon.style = ' /*display: none;*/ gap: 0rem;';
    //     // toggle_icon.classList.toggle('hidden');
    // });

    
    toggleback.addEventListener('click', () => {
        toggleback.style.display = 'none';
        toggle_icon.style = 'display: fixed;z-index:2;';
        sidebar.style = 'animation: fadout 1s linear';
        toggleon.style = 'height: 0;';
        sidebar.style = 'animation: fadeout 1s linear';
        //USE THIS ONE 
        // toggleon.style = 'animation: fadeout 1s linear';  
        // toggleon.style = 'height: 30px;';  
        setTimeout(function() { 
            toggleon.style = 'display:none';
            // toggleon.style.height = 'fade 1s linear'; 
            // toggle_icon.style.display = 'flex';
            document.querySelector('.hide').style = 'display: none;'  
        }, 1000);
    });

    lists.forEach((list) => {
        list.addEventListener('click', (e) => {
            e.preventDefault();
            lists.forEach((list) => list.classList.remove('active'));
            list.classList.add('active');
            document
            .querySelectorAll('.dropdown')
            .forEach((dropdown) => dropdown.classList.remove('active'));
            dropdown_lists.forEach((list) => list.classList.remove('active'));
        });
    });
</script>        