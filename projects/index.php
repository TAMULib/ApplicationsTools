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

          
          

// $ii = 0;
// $resultArr = array();  
// while (isset($sprints[$ii]['id'])) {
//   $resultArr[] = array('id' => $sprints[$ii]['id'], 'project'=>[$sprints[$ii]['project']]);

//   if(in_array($sprints[$ii]['name'], $resultArr) == false) {
//     array_push($resultArr, [$sprints[$ii]['project']]);
//   } else {
//     array_splice($resultArr, $ii, 1);
//   }


//   $ii++;
// }



// echo '<pre>';
// print_r(json_encode($resultArr));
// echo '</pre>';



          
              
            
            
            
            
          
          
          
          
          
          
          
          
          
          
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

           
            echo '<div class="sprint" data-sprint="'.$sprint['id'].'">
              <span class="project"><h3>'.$sprint['name'].'<br/>
              <span class="project">'.$sprint['project'].'</span>
              <div class="card-stats">
              <ul class="stats">
              <li class="stat-none vh-center">'.$none.'</li>
              <li class="stat-in-progress vh-center">'.$inProgress.'</li>
              <li class="stat-completed vh-center">'.$completed.'</li>
              <li class="stat-accepted vh-center">'.$accepted.'</li>
              </ul>
              </div>
              </div>';
              $count++;
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


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
$(document).ready(function(){
 
  if ( $('tr').val() < 10) x = '0' + x;
	$(this).val(x);
});


function sortTable(table, col, reverse) {
    var tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
        tr = Array.prototype.slice.call(tb.rows, 0), // put rows into array
        i;
    reverse = -((+reverse) || -1);
    tr = tr.sort(function (a, b) { // sort rows
        return reverse // `-1 *` if want opposite order
            * (a.cells[col].textContent.trim() // using `.textContent.trim()` for test
                .localeCompare(b.cells[col].textContent.trim())
               );
    });
    for(i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
}

function makeSortable(table) {
    var th = table.tHead, i;
    th && (th = th.rows[0]) && (th = th.cells);
    if (th) i = th.length;
    else return; // if no `<thead>` then do nothing
    while (--i >= 0) (function (i) {
        var dir = 1;
        th[i].addEventListener('click', function () {sortTable(table, i, (dir = 1 - dir))});
    }(i));
}

function makeAllSortable(parent) {
    parent = parent || document.body;
    var t = parent.getElementsByTagName('table'), i = t.length;
    while (--i >= 0) makeSortable(t[i]);
}

window.onload = function () {makeAllSortable();};

    </script>

</body>
</html>











