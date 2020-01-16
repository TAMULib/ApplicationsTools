<?php    
    header("Content-Type: application/json; charset=UTF-8");

    $active = 'https://api.library.tamu.edu/project-management-service/sprints/active';
    $sprintsData = file_get_contents($active); 
    $results['sprints'] = json_decode($sprintsData, true);
    $sprints = $results['sprints']['payload']['ArrayList<Sprint>'];

    echo json_encode($sprints);