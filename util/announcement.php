<?php
   require_once './connection.php';
   /**
    * A constant variable for the status property of the Announcement class.
    * You can use it with calling the `{AnnouncementObject}->set_status(ANNOUNCEMENT_STATUS['ACTIVE']);` method.
    */
   define("ANNOUNCEMENT_STATUS", [
      'NOT_ACTIVE' => 0,
      'ACTIVE' => 1,
      'DISABLE' => 2
   ]);

   class Announcement {
      public $id;
      protected $title;
      protected $body;
      protected $status;

      function __construct($title, $body) {
         $this->id = -1;
         $this->title = $title;
         $this->body = $body;
         $this->status = ANNOUNCEMENT_STATUS['NOT_ACTIVE'];
      }

      function set_title($newTitle) {
         if (is_string($newTitle)) $this -> title = $newTitle;
         else echo 'New title for announcement is invalid!<br>';
      }

      function get_title() {
         return $this->title;
      }

      function set_body($newBody) {
         if (is_string($newBody)) $this -> body = $newBody;
         else echo 'New body for announcement is invalid!<br>';
      }

      function get_body() {
         return $this -> body;
      }

      function set_status($status) {
         if ($status === ANNOUNCEMENT_STATUS['NOT_ACTIVE'] || $status === ANNOUNCEMENT_STATUS['ACTIVE'] || ANNOUNCEMENT_STATUS['DISABLE']) $this -> status = $status;
         else echo 'New status for announcement is invalid!<br>';
      }

      function get_status() {
         return $this -> status;
      }
   }
   
   /** This class is used to modify the database according to what the user needs. Currently it supports static methods for adding, editing, and deleting (although deleting from a database is discouraged!). */
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
?>