<?php
   require_once './connection.php';
   require_once './announcement.php';

   class AnnounceSystem {
      public static function addAnnouncement($announcement) {
         if ($announcement instanceof Announcement) {
            $title = $announcement->get_title();
            $body = $announcement->get_body();
            $dateNow = date('Y-m-d');
            $status = $announcement -> get_status();

            global $conn;
            $stmt = $conn -> prepare("INSERT INTO announcement(judul, body, date_created, status) VALUES (?, ?, ?, ?)");
            $stmt -> bind_param('sssi', $title, $body, $dateNow, $status);
            $stmt -> execute();

            echo 'Successfully add the announcement';
         }
         else echo "Gagal add announcement";
      }
      /** Avoid using this method at all cost, this is just here for emergency purposes only */
      public static function deleteAnnouncement($id) {
         global $conn;
         $stmt = $conn -> prepare("DELETE FROM announcement WHERE (announcement_id = ?)");
         $stmt -> bind_param('i', $id);
         $stmt -> execute();

         echo 'Successfully delete the announcement';
      }
      public static function editAnnouncement($id, $announcement) {
         if ($announcement instanceof Announcement) {
            $title = $announcement->get_title();
            $body = $announcement->get_body();
            $status = $announcement->get_status();

            global $conn;
            $stmt = $conn -> prepare("UPDATE announcement SET judul = ?, body = ?, status = ? where announcement_id = ?");
            $stmt -> bind_param('ssii', $title, $body, $status, $id);
            $stmt -> execute();

            echo 'Successfully edit the announcement';
         }
         else echo "Gagal Edit";
      }
   }

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