<?php
    // GET ACTIVE SPRINTS
    $active = 'https://api.library.tamu.edu/project-management-service/sprints/active';
    $sprintsData = file_get_contents($active); 
    $results['sprints'] = json_decode($sprintsData, true);
    $sprints = $results['sprints']['payload']['ArrayList<Sprint>'];

    // GET ALL PROJECTS
    $projects = 'https://api.library.tamu.edu/project-management-service/projects/stats';
    $projectsData = file_get_contents($projects); 
    $results['projects'] = json_decode($projectsData, true);
    $projectstInfo = $results['projects']['payload']['ArrayList<ProjectStats>'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Overview</title>
    <link rel="stylesheet" href="css/overview.css">
</head>
<body>

<header>
        <div class="global-header">
            <img src="../assets/images/libraries_logo.svg" alt="Texas A&amp;M Libraries" />

            <div class="nav-time">
            <div class="nav">
              <ul>
                <li><a href="../"><img src="../assets/images/home-icon.svg" /></a></li>
                <li><a href="../whiteboard"><img src="../assets/images/whiteboard-2.svg" /></a></li>
                <li><a href="../sprints"><img src="../assets/images/sprints-2.svg" /></a></li>
              </ul>
            </div>

            <div class="date-time">
            <span class="date"><?php echo date("F d, Y"); ?> </span>
            <span class="time">
                <span id="timer"></span>
            </span>
          </div>
            </div>
          
        </div>
    </header>

<div class="container">
 
  <section class="sprints">
    <h2>Current Sprints</h2>
    <div class="sprints-container">

        <?php
          
          
          
          
          $sprintNames = array();
          for ($i = count($sprints) - 1; $i >= 0; $i--) {
            $newSprint = $sprints[$i];

            if(in_array($newSprint['name'], $sprintNames) == false) {
              array_push($sprintNames, $newSprint['name']);
            } else {
              for($j = count($sprints) - 1; $j >= 0; $j--){
                $existingSprint = &$sprints[$j];
                if($newSprint['name'] == $existingSprint['name']) {
                  $existingSprint['project'] = $existingSprint['project'].'</li> <li>'.$newSprint['project'].'</li>';
                  break;
                }
              }
              array_splice($sprints, $i, 1);
            }
          }
       

          $count = 0;
          foreach ($sprints as $sprint) {
            $totalCards = count($sprint['cards']); 
                $none = 0;
                $accepted = 0;
                $inProgress = 0;
                $completed = 0;
                foreach($sprint['cards'] as $a=>$b){
                    
                    foreach($b as $d=>$status){
                        if($status==="None") {
                            $none++;
                        } else if($status==="Accepted") {
                            $accepted++;
                        } else if($status==="In Progress") {
                            $inProgress++;
                        } else if($status==="Completed") {
                            $completed++;
                        }
                    }
                }

           
            echo '
            <a href="sprint.php?id='.$sprint['id'].'">
            <div class="sprint" data-sprint="'.$sprint['id'].'">
              <h3>'.$sprint['name'].'</h3>
              <h4>Included Project(s): </h4>
              <ul class="project-list"><li>'.$sprint['project'].'</ul>
                <div class="card-stats">
                  <ul class="stats">
                  <li class="stat-none vh-center">'.$none.'</li>
                  <li class="stat-in-progress vh-center">'.$inProgress.'</li>
                  <li class="stat-completed vh-center">'.$completed.'</li>
                  <li class="stat-accepted vh-center">'.$accepted.'</li>
                  </ul>
                </div>
            </div></a>';
              $count++;
          };
        ?>
     </div>
</section>

  <section class="projects">
    <h2>All Projects</h2>
    <table id="myTable">
      <thead>
        <tr>
          <th>Name</th>
          <th class="sortable">Cards</th>
          <th>Issue</th>
          <th>Request</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($projectstInfo as $project) { 

        
            echo '<tr class="project">
                    <td class="project-title">'.$project['name'].'</td>'.
                    '<td>'.($project['backlogItemCount'] >= 10 ? $project['backlogItemCount'] : '0'.$project['backlogItemCount']).'</td>
                    <td>'.($project['issueCount'] >= 10 ? $project['issueCount'] : '0'.$project['issueCount']).'</td>
                    <td>'.($project['requestCount'] >= 10 ? $project['requestCount'] : '0'.$project['requestCount']).'</td>
                  </tr>';
          }
      ?>
      </tbody>
    </table>
  </section>
</div>



<table class="projects"></table>


<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
    <script src="js/tableSorter.js"></script>
    <script>
        $(document).ready( function () {
                $("#myTable").tablesorter({
                      sortList: [[1,0]]
                });
        });





        // Change the selector if needed
var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();
    
    // Set the width of thead columns
    $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });    
}).resize(); // Trigger resize handler
    </script>


</body>
</html>