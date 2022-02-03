<?php
   require_once "./util/connection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dummy Admin</title>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
   <div class="form">
      <label for="idAnnounce">id:</label><input type="text" name="idAnnounce" id="idAnnounce"><br>
      <label for="title">Title:</label><input type="text" name="title" id="title"><br>
      <label for="body">Body:</label><br>
      <textarea name="body" id="body" cols="30" rows="10"></textarea>
      <button id="announce">Create announcement</button>
      <button id="edit">Edit announcement</button>
      <button id="delete">Delete announcement</button>
      
   </div>
   <script>
      $("#announce").click((event) => {
         $.post({
            url: './util/announce_system.php',
            data: {
               title: $("#title").val(),
               body: $("#body").val(),
               announce: true
            },
            success: (response) => {
               if (response) {
                  alert(response);
               }
            },
            error: (err) => {
               throw new Error(err.message);
            }
         });
      });
      $("#edit").click((event) => {
         $.post({
            url: './util/announce_system.php',
            data: {
               id: Number($("#idAnnounce").val()),
               title: $("#title").val(),
               body: $("#body").val(),
               edit: true
            },
            success: (response) => {
               if (response) {
                  alert(response);
               }
            },
            error: (err) => {
               throw new Error(err.message);
            }
         });
      });
      $("#delete").click((event) => {
         $.post({
            url: './util/announce_system.php',
            data: {
               id: Number($("#idAnnounce").val()),
               delete: true
            },
            success: (response) => {
               if (response) {
                  alert(response);
               }
            },
            error: (err) => {
               throw new Error(err.message);
            }
         });
      });
   </script>
</body>
</html>