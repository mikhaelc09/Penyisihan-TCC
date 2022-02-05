class AnnouncementRequests {
   static get ANNOUNCE_PARAMS() {
      return {
         url: '../util/announce_system.php',
         data: {
            title: $("#title").val(),
            body: $("#body").val(),
            announce: true
         },
         success: (response) => {
            if (response) {
               alert(response);

               // Get the new list
               const params = AnnouncementRequests.get_params(1);
               $.post(params);
            }
         },
         error: (err) => {
            throw new Error(err.message);
         }
      }
   }
   static get EDIT_PARAMS() {
      return {
         url: '../util/announce_system.php',
         data: {
            id: Number($("#idAnnounce").val()),
            title: $("#title").val(),
            body: $("#body").val(),
            status: 0,
            edit: true
         },
         success: (response) => {
            if (response) {
               alert(response);

               const params = AnnouncementRequests.get_params(1);
               $.post(params);
            }
         },
         error: (err) => {
            throw new Error(err.message);
         }
      }
   }
   static get DELETE_PARAMS() {
      return {
         url: '../util/announce_system.php',
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
         url: '../util/announce_system.php',
         data: {
            page: page,
            get: true
         },
         success: (response) => {
            if (response) {
               // alert(response);
               $("#announcementList").html(response);

               // Edit Announcement
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

               // Activate Announcement
               $(".activate").each(function (index) {
                  $(this).click((event) => {
                     const targetRow = event.target.getAttribute('id').split('-')[1];

                     const row = document.querySelector("#row-" + targetRow);
                     const td = row.querySelectorAll("td");

                     const params = AnnouncementRequests.activate_params(td[0].innerText, ToggleStatus.active);
                     $.post(params);
                  });
               });

               // Deactivate Announcement
               $(".deactivate").each(function (index) {
                  $(this).click((event) => {
                     const targetRow = event.target.getAttribute('id').split('-')[1];

                     const row = document.querySelector("#row-" + targetRow);
                     const td = row.querySelectorAll("td");

                     const params = AnnouncementRequests.activate_params(td[0].innerText, ToggleStatus.not_active);
                     $.post(params);
                  });
               });

            }
         },
         error: (err) => {
            throw new Error(err.message);
         }
      }
   }
   static get_user_params() {
      return {
         url: '../util/announce_system.php',
         data: {
            get_user: true
         },
         success: (response) => {
            if (response) {
               // alert(response);
               $("#announcementList").html(response);
            }
         },
         error: (err) => {
            throw new Error(err.message);
         }
      }
   }
   static activate_params(id, status) {
      return {
         url: '../util/announce_system.php',
         data: {
            id: id,
            status: status,
            toggle: true
         },
         success: (response) => {
            if (response) {
               alert(response);
               document.querySelector("#row-"+id).querySelectorAll("td")[4].innerText = status;
            }
         },
         error: (err) => {
            throw new Error(err.message);
         }
      }
   }
}