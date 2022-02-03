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
            $stmt -> bind_param('ssss', $title, $body, $dateNow, $status);
            $stmt -> execute();

            echo 'Successfully add the announcement';
         }
         else echo "Gagal add announcement";
      }
      /** Avoid using this method at all cost, this is just here for emergency purposes only */
      public static function deleteAnnouncement($announcement) {
         if ($announcement instanceof Announcement) {
            echo "Berhasil jalan";
         }
         else echo "Gagal delete announcement";
      }
      public static function editAnnouncement($announcement) {
         if ($announcement instanceof Announcement) {
            echo "Berhasil jalan";
         }
         else echo "Gagal jalan";
      }
   }

   if (isset($_POST['announce'])) {
      print_r($_POST);
      $newAnnounce = new Announcement($_POST['title'], $_POST['body']);
      AnnounceSystem::addAnnouncement($newAnnounce);
   }
?>