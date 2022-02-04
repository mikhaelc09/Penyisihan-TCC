<?php
   require_once './announcement.php';

   if (isset($_POST['get'])) {
      $result = AnnounceSystem::getAnnouncement($_POST['page']);

      if (is_array($result)) {
         for ($i=0; $i<count($result); $i++) {
            ?>
               <tr>
                  <td><?=$result[$i]['announcement_id']?></td>
                  <td><?=$result[$i]['judul']?></td>
                  <td><?=$result[$i]['body']?></td>
                  <td><?=$result[$i]['date_created']?></td>
                  <td><?=$result[$i]['status']?></td>
               </tr>
            <?php
         }
      }
      else echo $result;
   }
   else if (isset($_POST['announce'])) {
      $newAnnounce = new Announcement($_POST['title'], $_POST['body']);
      AnnounceSystem::addAnnouncement($newAnnounce);
   }
   else if (isset($_POST['edit'])) {
      $newAnnounce = new Announcement($_POST['title'], $_POST['body']);
      AnnounceSystem::editAnnouncement($_POST['id'], $newAnnounce);
   }
   else if (isset($_POST['delete'])) {
      AnnounceSystem::deleteAnnouncement($_POST['id']);
   }
   
?>