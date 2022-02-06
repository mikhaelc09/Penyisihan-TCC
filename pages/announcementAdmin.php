<?php
   require_once '../util/connection.php';
   require_once("../util/adminValidation.php");
   // if (!isset($_SESSION['TCC_ADMIN'])) {
   //    header("Location: ../index.php");
   //    exit;
   // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Announcement | TCC Admin</title>
   <link rel="stylesheet" href="../style.css">
   <link rel="stylesheet" href="../tailwind/tailwind.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="bg-tcc-darkBlue">
   <?php require("../components/adminnav.php") ?>
   <aside class="announce-create">
      <h1 class="text-5xl">Create Announcement:</h1>
      <div class="announce-detail">
         <div id="announce-id">
            <label for="idAnnounce">id:</label><br>
            <input type="text" name="idAnnounce" id="idAnnounce">
         </div>
         <div id="announce-title">
            <label for="title">Title:</label><br>
            <input type="text" name="title" id="title">
         </div>
      </div>
      <div id="announce-body">
         <label for="body">Body:</label><br>
         <textarea class="body-input" name="body" id="body" rows="3"></textarea>
      </div>
      <div class="announce-actions">
         <button class="announce-btn" id="announce">Create announcement</button>
         <button class="announce-btn" id="edit">Edit announcement</button>
         <button class="announce-btn" id="delete">Delete announcement</button>
         <button class="announce-btn" id="get">Get announcement</button>
      </div>
   </aside>
   <main class="list">
      <h1 class="text-5xl" style="color: white">Announcement Lists:</h1>
      <table class="announce-table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Title</th>
               <th>Body</th>
               <th>Date Created</th>
               <th>Status</th>
               <th colspan=3>Actions</th>
            </tr>
         </thead>
         <tbody id="announcementList"></tbody>
      </table>
   </main>
   <script src="../util/announcementRequest.js"></script>
   <script>
      const ToggleStatus = {
         not_active: 0,
         active: 1,
         disable: 2
      }

      function activateDeactivate(id) {
         $.post({
            url: params.url,
            data: params.data,
            success: params.success,
            error: params.error
         });
      }

      $("#announce").click((event) => {
         const params = AnnouncementRequests.ANNOUNCE_PARAMS;
         $.post(params);
      });
      $("#edit").click((event) => {
         const params = AnnouncementRequests.EDIT_PARAMS;
         $.post(params);
      });
      $("#delete").click((event) => {
         const params = AnnouncementRequests.DELETE_PARAMS;
         $.post(params);
      });
      $("#get").click((event) => {
         // let target = event.target;
         // while (!Number(target.textContent)) {
         //    target = target.parentElement;
         // }

         const params = AnnouncementRequests.get_params(1);
         $.post(params);
      });

      document.addEventListener("DOMContentLoaded", () => {
         const params = AnnouncementRequests.get_params(1);
         $.post(params);
      })
   </script>
</body>
</html>