<?php
   // if (!isset($_SESSION['TCC_CONTESTANT'])) {
   //    header("Location: ./pages/start.php");
   //    exit;
   // }
   require_once("../util/connection.php");
   require_once("../util/userValidation.php");
   require_once("../util/inQuizChecker.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Announcement | TCC</title>
   <link rel="stylesheet" href="../style.css">
   <link rel="stylesheet" href="../tailwind/tailwind.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="bg-tcc-darkBlue">
   <?php require("../components/navbar.php") ?>
   <main class="user-announcement-main text-white">
      <h1 class="text-5xl">Announcements:</h1>
      <div id="announcementList"></div>
   </main>
   <footer>

   </footer>
   <script src="../util/announcementRequest.js"></script>
   <script>
      document.addEventListener("DOMContentLoaded", () => {
         const params = AnnouncementRequests.get_user_params();
         $.post(params);
      })
   </script>
</body>
</html>