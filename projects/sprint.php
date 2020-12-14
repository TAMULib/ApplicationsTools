<?php  $sprintID = $_GET['id']; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sprints Overview</title>
    <link rel="stylesheet" href="css/app.css">
</head>

<body>

<header>
    <div class="global-header">
      <img src="images/Libraries_white.svg" alt="Texas A&amp;M Libraries" />
      <div class="date-time">
        <span class="date"><?php echo date('F d, Y'); ?></span>
        <span class="time" id="timer"></span> 
      </div>
    </div>
<?php
    $url = 'https://api.library.tamu.edu/project-management-service/sprints/active'; // path to your JSON file
    $jsonData = file_get_contents($url); // put the contents of the file into a variable
    $results = json_decode($jsonData, true);
    $sprints = $results['payload']['ArrayList<Sprint>'];




        $sprintNames = array();
        for ($i = count($sprints) - 1; $i >= 0; $i--) {
            $newSprint = $sprints[$i];

            if(in_array($newSprint['name'], $sprintNames) == false) {
                array_push($sprintNames, $newSprint['name']);
            } else {
                for($j = count($sprints) - 1; $j >= 0; $j--){
                    $existingSprint = &$sprints[$j];
                    if($newSprint['name'] == $existingSprint['name']) {
                        $existingSprint['project'] = $existingSprint['project'].' / '.$newSprint['project'].'</li>';
                        break;
                    }
                }
                array_splice($sprints, $i, 1);
            }
        }
          
          

    $i = 0;
foreach ($sprints as $sprint) { 
    if($sprint['id'] == $sprintID ){
        $sprintNumber = $sprint['name'];

echo '<div class="sprint-title">
      <h1 id="'. $sprintNumber .'">'. $sprintNumber .'</h1>
    </div>
  </header>

    <section class="sprint-comtainer">
    <div class="progress-titles">
      <div class="title">None</div>
      <div class="title">In Progress</div>
      <div class="title">Completed</div>
      <div class="title">Accepted</div>
    </div>
    <div class="cards">';

            $cards = $sprints[$i]['cards'];
            foreach ($cards as $card) { 
                        echo '<div class="card" data-progress="'.$card['status'].'">
                                <div class="quick-info">
                                    <span class="card-name development">'.$card['number'].'</span>
                                    <ul class="devs">';
                                        foreach($card['assignees'] as $image){
                                            echo '<li><img src="https://api.library.tamu.edu/project-management-service/images/'.$image['avatar'].'" alt="'.$image['name'].'" /></li>';
                                        } 
                            echo '</ul>
                                </div>
                            <div class="description">
                                <h2>'.$card['name'].'</h2>
                                <p>'.$card['description'].'</p>
                            </div>
                            <div class="fadeout"></div>
                        </div>';
            }
        }
        $i++;
        echo '</div>
    </section>';
    }
    ?>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- <script src="js/scripts.js"></script> -->
</body>