<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Applications Tools</title>
    <link rel="stylesheet" href="assets/styles/landing.css" />
</head>
<body>

<header>
        <div class="global-header">
            <img src="assets/images/libraries_logo.svg" alt="Texas A&amp;M Libraries" />
            <div class="date-time">
            <span class="date"><?php echo date("F d, Y"); ?></span>
            <span class="time">
                <span id="timer"></span>
            </span>
          </div>
        </div>
</header>

<div class="container">
  <div class="nav-items">
    
    <div class="nav-item">
      <a href="whiteboard/">
        <div class="icon">
          <img src="assets/images/whiteboard-2.svg" />
        </div>
        <div class="title">
          <h2>Whiteboard</h2>
        </div>
      </a>
    </div>


    <div class="nav-item">
      <a href="projects/">
        <div class="icon">
          <img src="assets/images/projects.svg" />
        </div>
        <div class="title">
          <h2>Projects</h2>
        </div>
      </a>
    </div>


    <div class="nav-item">
      <a href="sprints/">
        <div class="icon">
          <img src="assets/images//sprints-2.svg" />
        </div>
        <div class="title">
          <h2>Sprints</h2>
        </div>
      </a>
    </div>
    
  </div>  
</div>
<script src="assets/js/scripts.js"></script>
</body>
</html>