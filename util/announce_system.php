<?php
   require_once './announcement.php';

   if (isset($_POST['get'])) {
      $result = AnnounceSystem::getAnnouncement($_POST['page']);

      if (is_array($result)) {
         for ($i=0; $i<count($result); $i++) {
            ?>
               <tr id="row-<?=$result[$i]['announcement_id']?>">
                  <td><?=$result[$i]['announcement_id']?></td>
                  <td><?=$result[$i]['judul']?></td>
                  <td><?=$result[$i]['body']?></td>
                  <td><?=$result[$i]['date_created']?></td>
                  <td><?=$result[$i]['status']?></td>
                  <td><button id="edit-<?=$result[$i]['announcement_id']?>" class='edit'>Edit</button></td>
                  <td>
                     <button id="activate-<?=$result[$i]['announcement_id']?>" class='activate'>Activate</button>
                  </td>
                  <td>
                     <button id="deactivate-<?=$result[$i]['announcement_id']?>" class='deactivate'>Deactivate</button>
                  </td>
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
   else if (isset($_POST['toggle'])) {
      AnnounceSystem::toggleAnnouncement($_POST['id'], $_POST['status']);
   }
   else if (isset($_POST['delete'])) {
      AnnounceSystem::deleteAnnouncement($_POST['id']);
   }
   
?>