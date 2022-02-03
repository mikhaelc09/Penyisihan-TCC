<?php
   /**
    * A constant variable for the status property of the Announcement class.
    * You can use it with calling the {AnnouncementObject}->get_status(ANNOUNCEMENT_STATUS['ACTIVE']); method.
    */
   define("ANNOUNCEMENT_STATUS", [
      'NOT_ACTIVE' => 'NOT ACTIVE',
      'ACTIVE' => 'ACTIVE'
   ]);

   class Announcement {
      protected $title;
      protected $body;
      protected $status;

      function __construct($title, $body) {
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
         if ($status === ANNOUNCEMENT_STATUS['NOT_ACTIVE'] || $status === ANNOUNCEMENT_STATUS['ACTIVE']) $this -> status = $status;
         else echo 'New status for announcement is invalid!<br>';
      }

      function get_status() {
         return $this -> status;
      }
   }
?>