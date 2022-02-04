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
      <button id="get">Get announcement</button>
      
      <table>
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
   </div>
   <script>
      class AnnouncementRequests {
         static get ANNOUNCE_PARAMS() {
            return {
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
            }
         }
         static get EDIT_PARAMS() {
            return {
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
            }
         }
         static get DELETE_PARAMS() {
            return {
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
            }
         }
         static get_params(page) {
            return {
               url: './util/announce_system.php',
               data: {
                  page: page,
                  get: true
               },
               success: (response) => {
                  if (response) {
                     alert(response);
                     $("#announcementList").html(response);
                     $(".edit").each(function (index) {
                        $(this).click((event) => {
                           const targetRow = event.target.getAttribute('id').split('-')[1];

                           const row = document.querySelector("#row-" + targetRow);
                           const td = row.querySelectorAll("td");

                           $("#idAnnounce").val(td[0].innerText);
                           $("#title").val(td[1].innerText);
                           $("#body").val(td[2].innerText);
                        });
                     });
                     console.log($(".edit")[0]);
                  }
               },
               error: (err) => {
                  throw new Error(err.message);
               }
            }
         }
      }

      $("#announce").click((event) => {
         const params = AnnouncementRequests.ANNOUNCE_PARAMS;
         $.post({
            url: params.url,
            data: params.data,
            success: params.success,
            error: params.error
         });
      });
      $("#edit").click((event) => {
         const params = AnnouncementRequests.EDIT_PARAMS;
         $.post({
            url: params.url,
            data: params.data,
            success: params.success,
            error: params.error
         });
      });
      $("#delete").click((event) => {
         const params = AnnouncementRequests.DELETE_PARAMS;
         $.post({
            url: params.url,
            data: params.data,
            success: params.success,
            error: params.error
         });
      });
      $("#get").click((event) => {
         // let target = event.target;
         // while (!Number(target.textContent)) {
         //    target = target.parentElement;
         // }

         const params = AnnouncementRequests.get_params(1);
         $.post({
            url: params.url,
            data: params.data,
            success: params.success,
            error: params.error
         });
      });

      
   </script>
</body>
</html>