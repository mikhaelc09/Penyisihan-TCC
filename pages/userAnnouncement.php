<?php
   // if (!isset($_SESSION['TCC_CONTESTANT'])) {
   //    header("Location: ./pages/start.php");
   //    exit;
   // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dummy User Page</title>
   <link rel="stylesheet" href="../style.css">
   <link rel="stylesheet" href="../tailwind/tailwind.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="bg-tcc-darkBlue">
   <header class="back-nav">
      <a href="./start.php">Go Back</a>
   </header>
   <main class="user-announcement-main text-white">
      <h1 class="text-5xl">Announcements:</h1>
      <table class="announce-table">
         <thead>
            <tr>
               <th>Title</th>
               <th>Body</th>
               <th>Date Created</th>
            </tr>
         </thead>
         <tbody id="announcementList"></tbody>
      </table>
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