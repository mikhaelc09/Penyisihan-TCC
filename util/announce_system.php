<?php
   require_once './announcement.php';

   if (isset($_POST['announce'])) {
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