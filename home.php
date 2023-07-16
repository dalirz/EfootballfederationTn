<?php
require_once 'connect.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

$user = $_SESSION['username'];

$query = "SELECT logo FROM clans WHERE username = '$user'";
$result = mysqli_query($con, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profilePicture = $row['logo']; // Corrected line
} else {
    $profilePicture = 'img/opt.jpg'; // Set a default profile picture
}

$query = "SELECT clannom FROM clans WHERE username = '$user'";
$result = mysqli_query($con, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $clannom = $row['clannom']; // Corrected line
}

if (isset($_POST['save-player'])) {
    $playername = $_POST['playername'];
    $playerid = $_POST['playerid'];
    $playertel = $_POST['playertel'];
    $playerclan = $_POST['playerclan'];
    
    include 'connect.php';
    $sql = "SELECT * FROM players WHERE playername='$playername'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $userpl = 1;
        } else {
            $sql = "INSERT INTO players (playername, playerid, playertel, playerclan) VALUES ('$playername', '$playerid', '$playertel', '$playerclan')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $success = 1;
                header('location: home.php');
            } else {
                die(mysqli_error($con));
            }
        }
    }

}
$searchedClan = ""; // Initialize the variable

if (isset($_POST['searched_clan'])) {
    $searchedClan = $_POST['searched_clan'];
}

$clansearchQuery = "SELECT * FROM clans WHERE clannom = '$searchedClan'";
$clansearchResult = mysqli_query($con, $clansearchQuery);

while ($row = mysqli_fetch_assoc($clansearchResult)) {
    $clansearchlogo = $row['logo'];
    $clanadmin = $row['username'];
}

$searchedQuery = "SELECT * FROM players WHERE playerclan = '$searchedClan' ORDER BY idmypl DESC";
$searchedResult = mysqli_query($con, $searchedQuery);


$playersQuery = "SELECT * FROM players WHERE playerclan = '$clannom' ORDER BY idmypl DESC";
$playersResult = mysqli_query($con, $playersQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link  href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
      <h1 class="logo">Federation</h1>
      <div class="sidebar-container">
        <div class="profile">
          <img src="<?php echo $profilePicture ?>" alt="" class="profile-img">
          <div class="profile-name">
            <h4><?php echo $clannom ?></h4>
          </div>
        </div>
        <div class="addplayer">
          <form action="home.php" method="post">
            <input type="text" placeholder="PLAYER NAME" class="addplr" name="playername" id="playername">
            <input type="text" placeholder="PLAYER ID" class="addplr" name="playerid" id="playerid">
            <input type="text" placeholder="PLAYER TEL" class="addplr" name="playertel" id="playertel">
            <input type="text" placeholder="PLAYER CLAN" class="addplr" name="playerclan" id="playerclan">
            <input type="submit" name="save-player" value="ADD PLAYER" id="addplayer">
          </form>
        </div>
      </div>
      <div class="menus">
          <a href="#"><ion-icon name="home-outline"></ion-icon>Home</a>
          <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon>Logout</a>
      </div>
  </div>  
  <!-- end Sidebar -->

  <!-- main -->
  <div class="main">
      <div class="main-header">
          <ion-icon class="menu-bar" name="menu-outline"></ion-icon>
          <div class="search">
              <form action="home.php" method="post">
                <input type="text" name="searched_clan" placeholder="Search clan">
                <button type="submit" class="btn-search"><ion-icon name="search-outline"></ion-icon></button>
              </form>
          </div>
      </div>
      <div class="wrapper">
          <div class="card">
              <div class="card-left">
                  <img src="<?php echo $clansearchlogo ?>" alt="">
              </div>
              <div class="card-center">
                <?php
                // Display the searched clan
                echo "<h3> $searchedClan</h3>"
                ?>
              </div>
          </div>
      </div>

      <div class="punished">
          <h3>Punished</h3>
          <hr class="divider">
          <div class="playerpunish">
              <div class="plypunishimg">
                  <img src="" alt="">
              </div>
              <h3>Player</h3>
              <p>CLAN</p>
              <p>2 week</p>
          </div>
          <div class="playerpunish">
            <div class="plypunishimg">
                <img src="" alt="">
            </div>
            <h3>Player</h3>
            <p>CLAN</p>
            <p>2 week</p>
            </div>
        <div class="playerpunish">
            <div class="plypunishimg">
                <img src="" alt="">
            </div>
            <h3>Player</h3>
            <p>CLAN</p>
            <p>2 week</p>
        </div>
      </div>
      

      <div class="myplayers">
        <h3>My Players</h3>
        <hr class="divider">
        <?php
      // Retrieve and display players from the database
      $playersQuery = "SELECT * FROM players WHERE playerclan = '$clannom' ORDER BY idmypl DESC";
      $playersResult = mysqli_query($con, $playersQuery);

      while ($row = mysqli_fetch_assoc($playersResult)) {
          $playername = $row['playername'];
          $playerid = $row['playerid'];
          $playertel = $row['playertel'];
      ?>
        <div class="myplyr">
          <div class="playerm">
              <img src="img/player.webp" alt="">
          </div>
          <h3><?php echo $playername ?></h3>
          <p><?php echo $playerid ?></p>
          <p><?php echo $playertel ?></p>
        </div>
      <?php
      }
      ?>
    </div>

    <footer>
        <h2>Developed by Dali Rzeygui</h2>
    </footer>

  </div>
  <!-- end main -->
  <!-- right section: detail job -->
  <div class="detail">
      <ion-icon class="close-detail" name="close-outline"></ion-icon>
      <div class="detail-header">
          <div class="logoclan">
              <img src="<?php echo $clansearchlogo ?>" alt="">
          </div>
          <h2><?php echo $searchedClan ?></h2>
      </div>
      <hr class="divider">
      <div class="detail-desc">
          <div class="about">
              <h4>About Clan</h4>
              <p>ADMIN : <?php echo $clanadmin ?> </p>
          </div>
          <hr class="divider">
          <div class="qualification">
  <h4>Players</h4>
  <?php
  // Retrieve and display players from the database
  if (isset($_POST['searched_clan'])) {
    $searchedClan = $_POST['searched_clan'];

    $searchedQuery = "SELECT * FROM players WHERE playerclan = '$searchedClan' ORDER BY idmypl DESC";
    $searchedResult = mysqli_query($con, $searchedQuery);

    while ($row = mysqli_fetch_assoc($searchedResult)) {
        $playerclansearchedname = $row['playername'];
        $playerclansearchedid = $row['playerid'];
        $playerclansearchedtel = $row['playertel'];
    ?>
    <div class="card">
      <div class="card-left">
        <img src="img/player.webp">
      </div>
      <div class="card-center">
        <h4><?php echo $playerclansearchedname ?></h4>
        <p class="card-detail">ID: <?php echo $playerclansearchedid ?></p>
        <p class="card-detail">TEL: <?php echo $playerclansearchedtel ?></p>
      </div>
    </div>
    <?php
    }
  }
  ?>
</div>
      </div>
      <hr class="divider">
  </div>
  <!-- end right section -->

</body>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
    $(".card").on("click", function () {
  $(".detail").addClass("active");
});

$(".close-detail").on("click", function () {
  $(".detail").removeClass("active");
});

$(".menu-bar").on("click", function () {
  $(".sidebar").addClass("active");
});

$(".logo").on("click", function () {
  $(".sidebar").removeClass("active");
});
</script>

</html>