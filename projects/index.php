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
 <div class="container">
 <div class="global-header">
      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/2283/Libraries_white.svg" alt="Texas A&amp;M Libraries" />
      <div class="date-time">
        <span class="date"><?php echo date('F d, Y'); ?></span>
        <span class="time" id="timer"></span> 
      </div>
    </div>

  <section class="sprints">
    <h2>Current Sprints</h2>
    <div class="sprints-container">

        <?php
          
          $sprintNames = array();
          for ($i = count($sprints) - 1; $i >= 0; $i--) {
              if(in_array($sprints[$i]['name'], $sprintNames) == false) {
                array_push($sprintNames, $sprints[$i]['name']);
              } else {
                array_splice($sprints, $i, 1);
              }
          }

          
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

           
            echo '<div class="sprint">'.
              $sprint['name'] .'<br/>
              <span class="project"><h3>'.$sprint['project'].'</h3></span>
              <div class="card-stats">
              <ul class="stats">
              <li class="stat-none vh-center">'.$none.'</li>
              <li class="stat-in-progress vh-center">'.$inProgress.'</li>
              <li class="stat-completed vh-center">'.$completed.'</li>
              <li class="stat-accepted vh-center">'.$accepted.'</li>
              </ul>
              </div>
              </div>';
          };
        ?>
    </div>
</section>

  <section class="projects">
    <h2>All Projects</h2>
    <table>
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
                    <td class="project-title">'.$project['name'].'</td>
                    <td>'.$project['backlogItemCount'].'</td>
                    <td>'.$project['issueCount'].'</td>
                    <td>'.$project['requestCount'].'</td>
                  </tr>';
          }
      ?>
      </tbody>
    </table>
  </section>
</div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
      var $sortable = $('.sortable');
      $sortable.on('click', function(){
        var $this = $(this);
        var asc = $this.hasClass('asc');
        var desc = $this.hasClass('desc');
        $sortable.removeClass('asc').removeClass('desc');
        if (desc || (!asc && !desc)) {
          $this.addClass('asc');
        } else {
          $this.addClass('desc');
        }
        
      });
    </script>

</body>
</html>







