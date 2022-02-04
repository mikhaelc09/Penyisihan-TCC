<?php
require_once("../util/connection.php");
$user = $conn->query("SELECT * From peserta order by score desc")->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users | TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tailwind/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
</head>

<body>
    <div class="w-full h-screen bg-tcc-darkBlue">
        <?php require("../components/adminnav.php") ?>

        <main class="w-full flex flex-col items-center py-10 gap-4">
            <div style="background-color:#d4d0b5" class="relative flex flex-col min-w-0 break-words w-1/2 mb-6 shadow-lg rounded text-black">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 ">
                            <h3 class="font-semibold text-lg text-black text-center">List Users</h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto ">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th style="background-color: #f5bf6c; border-color:#743a36" class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-black">No.</th>
                                <th style="background-color: #f5bf6c; border-color:#743a36" class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-black">Full Name</th>
                                <th style="background-color: #f5bf6c; border-color:#743a36" class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-black">nrp</th>
                                <th style="background-color: #f5bf6c; border-color:#743a36" class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-black">Email</th>
                                <th style="background-color: #f5bf6c; border-color:#743a36" class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-black">Status</th>
                                <th style="background-color: #f5bf6c; border-color:#743a36" class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-black">User's Score</th>
                                <th style="background-color: #f5bf6c; border-color:#743a36" class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-pink-200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($user != null) { ?>
                                <?php foreach ($user as $key => $value) { ?>
                                    <tr>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?= $key + 1 ?>.</td>
                                        <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <span class="font-bold text-black align-middle"><?= $value['full_name'] ?></span>
                                        </th>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?= $value['nrp'] ?></td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?= $value['email'] ?></td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 items-center">
                                            <?php if ($value['status'] == 1) echo "Active";
                                            else echo "Non Active" ?>
                                        </td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <div class="flex items-center">
                                                <span class="mr-2"><?= $value['score'] ?></span>
                                                <div class="relative w-full">
                                                    <div style="border-color:#743a36" class="overflow-hidden h-2 text-xs flex rounded bg-red-200 border-2">
                                                        <div style="width: <?= $value['score'] ?>%;background-color:#de3163" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>