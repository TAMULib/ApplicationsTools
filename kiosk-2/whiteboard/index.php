<?php  
include 'app.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Whiteboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../assets/styles/footer.css">

</head>
<body>
 
<div class="headers">
<div class="title sprints"><h3>Sprints</h3></div>
<div class="title deployment"><h3>Deployment</h3>
</div>
</div>

<div class="wrapper" id="app">  
  <div class="columns">
    <div class="sub-columns">
        <div class="column">
          <div class="column-header">
            <h2 class="column-title">Pending</h2>
          </div>
          
            <div id="pending" class="container column-content">
              <?php $getCards->theCards('1');  ?>
          </div>
        </div>

        <div class="column">
          <div class="column-header">
            <h2 class="column-title">Stuff @ Large</h2>
          </div>
            <div id="at-large" class="container column-content">
              <?php $getCards->theCards('2');  ?>
          </div>
        </div>

        <div class="column">
           <div class="column-header">
            <h2 class="column-title">Ongoing</h2>
          </div>
            <div id="ongoing" class="container column-content">
              <?php $getCards->theCards('3');  ?>
            </div>
        </div>
    </div>
  </div>

  <div class="columns">
    <div class="sub-columns">
        <div class="column">
          <div class="column-header">
            <h2 class="column-title">On Deck</h2>
          </div>
            <div id="on-deck" class="column-content">
                <?php $getCards->theCards('4');  ?>
            </div>
        </div>
        <div class="column">
          <div class="column-header">
            <h2 class="column-title">Current</h2>
          </div>
            <div id="current" class="column-content">
              <?php $getCards->theCards('5');  ?>
            </div>
        </div>
        <div class="column">
          <div class="column-header">
            <h2 class="column-title">Wrap Up</h2>
          </div>
            <div id="wrap-up" class="column-content">
              <?php $getCards->theCards('10');  ?>
            </div>
        </div>
    </div>
  </div>


  <div class="columns">
    <div class="sub-columns">
      <div class="column">
          <div class="column-header">
            <h2 class="column-title">Moving To Pre</h2>
          </div>
          <div id="moving-pre" class="column-content">
            <?php $getCards->theCards('6');  ?>
          </div>
      </div>

      <div class="column">
          <div class="column-header">
            <h2 class="column-title">On Pre</h2>
          </div>

          <div id="on-pre" class="column-content">
            <?php $getCards->theCards('7');  ?>
          </div>
      </div>
    </div>
  </div>


  <div class="columns">
    <div class="sub-columns">
      <div class="column">
          <div class="column-header">
            <h2 class="column-title">Moving To Production</h2>
          </div>
        <div id="moving-prod" class="column-content">
          <?php $getCards->theCards('8');  ?>
        </div>
      </div>

      <div class="column">
          <div class="column-header">
            <h2 class="column-title">On Production</h2>
          </div>
        <div id="on-prod" class="column-content">
          <?php $getCards->theCards('9');  ?>
        </div>
      </div>
    </div>
  </div>

</div>



<div id="help">
      <div id="hover"></div>
      <div id="key">
        <ul>
          <li>None</li>
          <li class="customer">Waiting On Customer</li>
          <li class="di">Waiting On DI</li>
          <li class="qa">Quality Assurance</li>
          <li class="approved">Approved</li>
        </ul>
      </div>
    </div>

    <footer>
  <div class="global-footer">
      <a href="../"><img src="../assets/images/libraries_logo.svg" alt="Texas A&amp;M Libraries" /></a>

      <div class="nav">
        <a href="../whiteboard/">
          <div class="icon">
            <img src="../assets/images/whiteboard.svg" />
          </div>
        </a>
        
        <a href="../projects/">
          <div class="icon">
            <img src="../assets/images/projects.svg" />
          </div>
        </a>

        <a href="../sprints/">
          <div class="icon">
            <img src="../assets/images/sprints-3.svg" />
          </div>
        </a>

      </div>

      <div class="date-time">
      <span class="date"><?php echo date("F d, Y"); ?></span>
      <span class="time">
          <span id="timer"></span>
      </span>
    </div>
  </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>

</body>
</html>