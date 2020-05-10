<?php
    $buddy = new Buddy();
?>

<div class="navbar">
    <ul>
    <li><a href="home.php">Home</a></li>
    <span class="welkom"><img src="<?php User::getAvatar(); ?>" alt="Uw avatar" height="20px"/> Welkom <?php echo $_SESSION['first_name']; ?></span>
        <li><a href="completeProfile.php">My profile</a></li>
        <li><a href="search.php">Find a buddy</a></li>
        <?php if($buddy->getBuddyStatus() == '1'){
           
           echo '<li><a href="chat.php">Chat with your buddy</a></li>';        
        } 
        ?>
        <li><a href="logout.php">Log out</a></li>
</ul>
</div>