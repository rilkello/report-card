<?php
include "header.php";
?>
<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Side Bar</title>
    <link rel="stylesheet" href="s1.css"> -->
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
  width: 0px;
}

.form {
    height: 100px;
    margin-top: 60px; /* Adjust this value to ensure proper spacing */
    padding: 10px; /* Add padding for better appearance */
    background-color: #f0f0f0; /* Example background color */
    display: flex;
    align-items: center;
}

/* Optionally, you can style the form inputs inline */
.form input[type="text"],
.form select {
    width: 200px; /* Example width */
    margin-right: 10px; /* Example margin */
}

/* Style for the bottom navbar */
.bottom-navbar {
    height: 50px;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #333; /* Background color */
    padding: 10px 0; /* Vertical padding */
}

.top-navbar {
    color: #fff;
    justify-content: space-between;
    z-index: 1000; 
    position: fixed;
    display: flex;
    height: 75px;
    top: 0;
    left: 0;
    /* position: fixed; */
    /* bottom: 1;
    left: 0; */
    align-items: center;
    width: 100%;
    background-color: #333; /* Background color */
    padding: 0 20px; /* Vertical padding */
}

/* Style for the list items */
.top-navbar ul {
    list-style-type: none;
    text-align: center;
}

.top-navbar ul li {
    display: inline;
    margin: 0 10px; /* Spacing between links */
}

/* Style for the links */
.top-navbar ul li a {
    color: #fff; /* Text color */
    text-decoration: none;
    padding: 5px 10px; /* Padding around links */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s; /* Smooth transition */
}

.top-navbar ul li a:hover {
    background-color: #555; /* Background color on hover */
}

.bottom-navbar {
    height: 50px;
    position: fixed;
    bottom: 1;
    left: 0;
    width: 100%;
    background-color: #333; /* Background color */
    padding: 10px 0; /* Vertical padding */
}

/* Style for the list items */
.bottom-navbar ul {
    list-style-type: none;
    text-align: center;
}

.bottom-navbar ul li {
    display: inline;
    margin: 0 10px; /* Spacing between links */
}

/* Style for the links */
.bottom-navbar ul li a {
    color: #fff; /* Text color */
    text-decoration: none;
    padding: 5px 10px; /* Padding around links */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s; /* Smooth transition */
}

.bottom-navbar ul li a:hover {
    background-color: #555; /* Background color on hover */
}

body {
  font-size: 1.6rem;
  font-family: 'Inter', sans-serif;
  /* background: url('images/bg.jpeg') no-repeat center/cover; */
  background-color: #1a2348;
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

.sidebar {
  margin-top : 200px;
  padding-top: 100px;
  width: 10rem;
  max-height: calc( 60vh - 5rem);
  background: var(--bg);
  padding: 1.4rem;
  /* margin: 2.5rem 0; */
  border-radius: 1.5rem;
  position: fixed;
  left: 2rem;
  display: flex;
  gap: 5%;
  flex-direction: column;
  justify-content: space-between;
  overflow-x: hidden;
  overflow-y: scroll;
  transition: width 0.5s cubic-bezier(0.215, 0.61, 0.355, 1);
}

.sidebar.active {
  width: 7rem;
}

.sidebar.active .profile-img {
  width: 3rem;
  height: 3rem;
}

.sidebar.active .list {
  width: 4.5rem;
  height: 4.5rem;
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
  margin-bottom: 20px;
}

.sidebar-toggle-icon img {
  width: 3rem;
  transform: rotate(180deg);
}

.sidebar-toggle-icon.active img {
  transform: rotate(0deg);
}

.list,
.dropdown-list {
  padding: 1rem 1.3rem;
  margin-bottom: 1rem;
  border-radius: 0.8rem;
  background-blend-mode: soft-light, normal;
  transition: all 0.5s ease;
}

.icon-img {
  width: 2.5rem;
  height: 2.5rem;
  /* width: 4vw; Adjust the value as needed
  height: 4vw; Adjust the value as needed */
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


.form-container {
    width:100%;
    position: fixed;
    margin-top: 75px; /* Match the height of the top navbar */
    padding: 20px; /* Add padding for better appearance */
    background-color: #f0f0f0;
}

.profile-content {
  padding: 1rem 0 0 0;
  margin-top: 1rem;
  border-top: var(--divider);
  display: flex;
  align-items: center;
  gap: 2rem;
}

.profile-img {
  width: 4rem;
  height: 4rem;
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


</style> 
</head>
 <body>
    <div class="sidebar">
      <div class="sidebar-toggle">
        <div class="sidebar-toggle-icon">
          <img src="images/icon-toggle.svg" alt="Toggle" />
        </div>
      </div>
      <div class="sidebar-top">
        <li class="list active">
          <a href="#!" class="link">
            <img src="images/icon-1.svg" alt="icon" class="icon-img" />
            <span>Home</span>
          </a>
        </li>
        <li class="list">
          <a href="#!" class="link">
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
        <li class="dropdown-list">
          <a href="#!" class="link">
            <img src="images/icon-5.svg" alt="icon" class="icon-img" />
            <span>Audience</span>
            <div class="dropdown-arrow">
              <img src="images/arrow.svg" alt="Arrow" />
            </div>
          </a>
          <div class="dropdown">
            <a href="#!" class="dropdown-link">
              <img src="images/icon-5.svg" alt="Icon" class="icon-img" />
              <span>Audience 1</span>
            </a>
            <a href="#!" class="dropdown-link">
              <img src="images/icon-5.svg" alt="Icon" class="icon-img" />
              <span>Audience 2</span>
            </a>
            <a href="#!" class="dropdown-link">
              <img src="images/icon-5.svg" alt="Icon" class="icon-img" />
              <span>Audience 3</span>
            </a>
          </div>
        </li>
        <li class="dropdown-list">
          <a href="#!" class="link">
            <img src="images/icon-6.svg" alt="icon" class="icon-img" />
            <span>Content</span>
            <div class="dropdown-arrow">
              <img src="images/arrow.svg" alt="Arrow" />
            </div>
          </a>
          <div class="dropdown">
            <a href="#!" class="dropdown-link">
              <img src="images/icon-design.svg" alt="Icon" class="icon-img" />
              <span>Design</span>
            </a>
            <a href="#!" class="dropdown-link">
              <img
                src="images/icon-code-working.svg"
                alt="Icon"
                class="icon-img"
              />
              <span>Development</span>
            </a>
            <a href="#!" class="dropdown-link">
              <img src="images/icon-cloud.svg" alt="Icon" class="icon-img" />
              <span>Cloud</span>
            </a>
          </div>
        </li>
        <li class="dropdown-list">
          <a href="#!" class="link">
            <img src="images/icon-7.svg" alt="icon" class="icon-img" />
            <span>Analytics</span>
            <div class="dropdown-arrow">
              <img src="images/arrow.svg" alt="Arrow" />
            </div>
          </a>
          <div class="dropdown">
            <a href="#!" class="dropdown-link">
              <img src="images/icon-calendar.svg" alt="Icon" class="icon-img" />
              <span>Day</span>
            </a>
            <a href="#!" class="dropdown-link">
              <img src="images/icon-calendar.svg" alt="Icon" class="icon-img" />
              <span>Month</span>
            </a>
            <a href="#!" class="dropdown-link">
              <img src="images/icon-calendar.svg" alt="Icon" class="icon-img" />
              <span>Yeary</span>
            </a>
          </div>
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
            <img src="images/profile.svg" alt="Profile" class="profile-img" />
            <div class="profile-info">
              <h3 class="profile-name">Ketan’s Studio</h3>
              <span class="profile-email">koriigami@gmail.com</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="top-navbar">
      <ul>
      <li >
        <a href="#!">
          <img src="images/icon-1.svg" alt="icon" class="icon-img" />
        </a>
       </li> 
       <li >
        <a href="#!">
          <img src="images/icon-1.svg" alt="icon" class="icon-img" />
        </a>
       </li> 
       <li >
        <a href="#!">
          <img src="images/icon-1.svg" alt="icon" class="icon-img" />
        </a>
       </li> 
       <li >
        <a href="#!">
          <img src="images/icon-1.svg" alt="icon" class="icon-img" />
        </a>
       </li> 
       <li>
       <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li >
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li>
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li>
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
      </ul>
  </nav>
  <nav class="bottom-navbar ">
    <ul>
      <li>
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li >
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li >
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li >
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li>
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li >
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li >
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
     <li >
      <a href="#!">
        <img src="images/icon-1.svg" alt="icon" class="icon-img" />
      </a>
     </li> 
    </ul>
    </ul>
</nav>
<div class="form-container" style="background-color:#1266f1;">
<form action="dashboard.php" method="POST" enctype="multipart/form-data">
<input type="hidden" class="form-control" id="served_by" name="served_by" value="<?php echo $session_id; ?>" onkeydown="return false">
<div class="row mb-2">
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="typofass" name="typofass" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">Typofass</option>
			<?php
			$sql ="SELECT * FROM assessments";
			$result = $conn->query($sql);
			if( mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
		?>
			<option value="<?php echo $row["subject"]; ?>"> <?php echo $row["subject"]; ?> </option>
		<?php }} ?>
			</select>
		</div>
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="date" name="date" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">date</option>
			<?php
			$sql ="SELECT * FROM assessments";
			$result = $conn->query($sql);
			if( mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
		?>
			<option value="<?php echo $row["date"]; ?>"> <?php echo $row["date"]; ?> </option>
		<?php }} ?>
			</select>
		</div>
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">class</option>
			<?php
			$sql ="SELECT * FROM class";
			$result = $conn->query($sql);
			if( mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
		?>
			<option value="<?php echo $row["class"]; ?>"> <?php echo $row["class"]; ?> </option>
		<?php }} ?>
			</select>
		</div>
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="level" name="level" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">level</option>
			<option value="Ordinary level">Ordinary level</option>
			</select>
		</div>	
		<div class="col-sm">
		    <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background:blue;">Filter</button>
	   </div>	
   </div>
</form>
</div> 
   
  </body>
  <script src="script.js"></script>
</html> 