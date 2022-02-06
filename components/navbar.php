
<nav class="h-10 w-full pr-10 py-8 text-gray-100 flex justify-end items-center text-xl font-medium">
    <ul class="flex flex-row gap-5 items-center">
        <?php if(isset($_SESSION["email"])){ ?>
            <li class="transition-all hover:scale-110"><a href="../pages/userStart.php">Home</a></li>
            <li class="transition-all hover:scale-110"><a href="../pages/userAnnouncement.php">Announcement</a></li>
            <li class="transition-all hover:scale-110"><a href="../pages/userProfile.php">Profile</a></li>
            <li class="transition-all hover:scale-110"><a href="../util/logout.php">Logout</a></li>
        <?php }else{ ?>
            <li class="transition-all hover:scale-110"><a href="../pages/start.php">Home</a></li>
            <li class="transition-all hover:scale-110"><a href="../pages/login.php">Login</a></li>
            <li class="transition-all hover:scale-110"><a href="../pages/register.php">Register</a></li>
        <?php } ?>
    </ul>
</nav>