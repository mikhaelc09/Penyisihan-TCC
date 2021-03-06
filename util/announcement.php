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

            if ($title !== '') {
               if ($body !== '') {
                  global $conn;
                  $stmt = $conn -> prepare("INSERT INTO announcement(judul, body, date_created, status) VALUES (?, ?, ?, ?)");
                  $stmt -> bind_param('sssi', $title, $body, $dateNow, $status);
                  $stmt -> execute();

                  echo 'Successfully add the announcement';
               } else echo 'Please insert a body!';
            } else echo "Please insert a title!";
         }
         else echo "Failed to add announcement";
      }
      /** Avoid using this method at all cost, this is just here for emergency purposes only */
      public static function deleteAnnouncement($id) {
         if ($id > 0) {
            global $conn;
            $stmt = $conn -> prepare("DELETE FROM announcement WHERE (announcement_id = ?)");
            $stmt -> bind_param('i', $id);
            $stmt -> execute();

            echo 'Successfully delete the announcement';
         } else echo 'Please insert a valid ID!';
      }
      public static function editAnnouncement($id, $announcement) {
         if ($announcement instanceof Announcement) {
            $title = $announcement->get_title();
            $body = $announcement->get_body();
            $status = $announcement->get_status();

            if ($id > 0) {
               if ($title !== '') {
                  if ($body !== '') {
                     global $conn;
                     $stmt = $conn -> prepare("UPDATE announcement SET judul = ?, body = ?, status = ? where announcement_id = ?");
                     $stmt -> bind_param('ssii', $title, $body, $status, $id);
                     $success = $stmt -> execute();
   
                     if ($success) echo 'Successfully edit the announcement.';
                     else echo 'Edit failed.';
                  } else echo 'Please insert a body!';
               } else echo 'Please insert a title!';
            }
         }
         else echo "Gagal Edit";
      }
      public static function toggleAnnouncement($id, $status) {
         global $conn;
         $stmt = $conn -> prepare("SELECT status FROM announcement where announcement_id = ?");
         $stmt -> bind_param('i', $id);$stmt -> execute();
         $result = $stmt -> get_result();

         if ($result -> fetch_row()[0] != $status) {
            $stmt = $conn -> prepare("UPDATE announcement SET status = ? where announcement_id = ?");
            $stmt -> bind_param('ii', $status, $id);
            $success = $stmt -> execute();

            if ($success) echo 'Successfully toggle the announcement.';
            else echo 'Toggle failed.';
         }
         else echo "Toggle is the same. No action is done.";
      }
      /** Get 10 announcement that when no announcement is found, return a string, else if some announcement is found, return an array of rows.*/
      public static function getAnnouncement($page) {
         if (is_string($page) || is_integer($page)) {
            $limit = 1000; // Practicaly disabling the limit
            $offset = ($page-1) * $limit;

            global $conn;
            $result = $conn -> query("SELECT COUNT(*) FROM announcement");
            $count = $result -> fetch_row();

            if ($count && $count[0] > 0) {
               $stmt = $conn -> prepare("SELECT * FROM announcement LIMIT ? OFFSET ?");
               $stmt -> bind_param('ii', $limit, $offset);
               $stmt -> execute();
               $result = $stmt -> get_result();
               
               if ($result -> num_rows > 0) {
                  $getResult = [];
                  while ($row = $result -> fetch_assoc()) {
                     $getResult[] = $row;
                  }
                  return $getResult;
               }
               else return "<td colspan=5>No announcement is found!</td>";
            }
            else return '<td colspan=5>Announcement is empty!</td>';
         }
         else return '<td colspan=5>Page is invalid!</td>';
      }
      public static function getUserAnnouncement() {
         global $conn;
         $stmt = $conn -> prepare("SELECT DISTINCT * FROM announcement ORDER BY announcement_id DESC");
         $stmt -> execute();
         $result = $stmt -> get_result();
         
         if ($result -> num_rows > 0) {
            $getResult = [];
            while ($row = $result -> fetch_assoc()) {
               $getResult[] = $row;
            }
            return $getResult;
         }
         else return "<td colspan=5>No announcement is found!</td>";
      }
   }
?>