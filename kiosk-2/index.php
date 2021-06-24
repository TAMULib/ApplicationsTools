<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Applications Tools</title>
    <link rel="stylesheet" href="assets/styles/landing.css" />
    <link rel="stylesheet" href="assets/styles/footer.css" />
</head>
<body>


<footer>
  <div class="global-footer">
      <img src="assets/images/libraries_logo.svg" alt="Texas A&amp;M Libraries" />

      <div class="nav">
        <a href="whiteboard/">
          <div class="icon">
            <img src="assets/images/whiteboard.svg" />
          </div>
        </a>
        
        <a href="projects/">
          <div class="icon">
            <img src="assets/images/projects.svg" />
          </div>
        </a>

        <a href="sprints/">
          <div class="icon">
            <img src="assets/images/sprints-3.svg" />
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


<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>