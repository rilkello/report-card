 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bottom Navigation Bar</title>
    <style>
        .bottom-navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #1E3264; /* Dark blue background color */
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
        }

        .nav-item {
            color: #fff; /* White text color */
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 12px;
        }

        .nav-item.active {
            color: #FFD700; /* Yellow color for active item */
        }

        .nav-item svg {
            width: 24px;
            height: 24px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<nav class="bottom-navbar">
    <a href="#" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.7 19.4L2 14.7l1.4-1.4 3.3 3.3 8.3-8.3 1.4 1.4-10 10zm4.6-10.7l1.4-1.4 8.3 8.3-1.4 1.4-8.3-8.3 3.3-3.3 1.4 1.3z"/><path fill="none" d="M0 0h24v24H0z"/></svg>
        Home
    </a>
    <a href="#" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 3h-8c-1.1 0-1.99.9-1.99 2L11 11H3c-1.1 0-1.99.9-1.99 2l.01 8A2 2 0 0 0 3 23h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14h-4v-2h4v2zm6-5H4V7h16v5z"/><path fill="none" d="M0 0h24v24H0z"/></svg>
        Classes
    </a>
</nav>




<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor\autoload.php'; // Path to PHPMailer autoload file

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $from_email = $_POST['from_email'];
//     $to_email = $_POST['to_email'];
//     $message = $_POST['message'];

//     // Instantiation and passing `true` enables exceptions
//     $mail = new PHPMailer(true);

//     try {
//         // Server settings
//         $mail->isSMTP();                                            // Send using SMTP
//         $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
//         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//         $mail->Username   = 'rilkello251@gmail.com';                 // SMTP username
//         $mail->Password   = 'abami@gmail.com';                        // SMTP password
//         $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_STARTTLS` encouraged
//         $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//         // Recipients
//         $mail->setFrom($from_email);
//         $mail->addAddress($to_email);                               // Add a recipient

//         // Content
//         $mail->isHTML(false);                                       // Set email format to plain text
//         $mail->Subject = 'Message from ' . $from_email;
//         $mail->Body    = $message;

//         $mail->send();
//         $success_message = "Message sent successfully!";
//     } catch (Exception $e) {
//         $error_message = "Failed to send message. Error: {$mail->ErrorInfo}";
//     }
// }
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
</head>
<body>
    <h2>Send Message</h2>
    <?php //if (isset($success_message)): ?>
        <p style="color: green;"><?php //echo $success_message; ?></p>
    <?php //endif; ?>
    <?php // if (isset($error_message)): ?>
        <p style="color: red;"><?php // echo $error_message; ?></p>
    <?php //endif; ?>
    <form action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="from_email">Your Email:</label><br>
        <input type="email" id="from_email" name="from_email" required><br><br>

        <label for="to_email">Recipient's Email:</label><br>
        <input type="email" id="to_email" name="to_email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Send Message</button>
    </form>
</body>
</html> -->
<?php
// include "config/db.php";
// include "header.php";
?>

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
      <!-- <ul>
          
          <li><a href="#">Link 2</a></li>
          <li><a href="#">Link 3</a></li>
          <li><a href="#">Link 4</a></li>
          <li><a href="#">Link 5</a></li>
          <li><a href="#">Link 6</a></li>
      </ul> -->
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
    <!-- <script src="script.js"></script> -->
    <script>
      let sidebar = document.querySelector('.sidebar');
let lists = document.querySelectorAll('.list');
let dropdown_lists = document.querySelectorAll('.dropdown-list');
let toggle_icon = document.querySelector('.sidebar-toggle-icon');
const body = document.body;

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

toggle_icon.addEventListener('click', () => {
  toggle_icon.classList.toggle('active');
  sidebar.classList.toggle('active');
  document
    .querySelectorAll('.dropdown')
    .forEach((dropdown) => dropdown.classList.remove('active'));
  dropdown_lists.forEach((list) => list.classList.remove('active'));
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

dropdown_lists.forEach((dropdown_list) => {
  dropdown_list.addEventListener('click', () => {
    toggle_icon.classList.toggle('active');
    sidebar.classList.remove('active');
    lists.forEach((list) => list.classList.remove('active'));

    let dropdown = dropdown_list.querySelector('.dropdown');
    let links = dropdown_list.querySelectorAll('.dropdown .dropdown-link');
    dropdown_list.classList.toggle('active');
    dropdown.classList.toggle('active');

    links.forEach((link) => {
      link.addEventListener('click', (e) => {
        e.stopPropagation();
        links.forEach((link) => link.classList.remove('active'));
        link.classList.add('active');
      });
    });
  });
});
    </script>
  </body>
</html> 

