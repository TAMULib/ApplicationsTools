<?php
$projectID = $_GET['project'];

// GET CURRENT PRODUCT
$product = 'https://api.library.tamu.edu/project-management-service/products/'.$projectID;
$productData = file_get_contents($product); 
$results = json_decode($productData, true);
$project = $results['payload']['Product'];


// GET ALL PROJECTS
$projects = 'https://api.library.tamu.edu/project-management-service/products/stats';
$projectsData = file_get_contents($projects); 
$results['projects'] = json_decode($projectsData, true);
$projectstInfo = $results['projects']['payload']['ArrayList<ProductStats>'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overview</title>
    <link rel="stylesheet" href="../css/overview.css">


</head>
<body class="no-bg">

    <div class="global-header">
      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/2283/Libraries_white.svg" alt="Texas A&amp;M Libraries" />
      <div class="date-time">
        <span class="date"><?php echo date('F d, Y'); ?></span>
        <span class="time" id="timer"></span> 
      </div>
    </div>

    <div class="wrapper">
        <div class="overview-header">
            <h1> <?php echo $project['name']; ?> </h1>
            <nav>
                <ul>
                <?php
                    if($project['productionUrl'] != ''){
                        echo '<li><a href="'.$project['productionUrl'].'">Production</a></li>';
                    } else {
                        echo '<li class="isDisabled">Production</li>';
                    }

                    if($project['preUrl'] != ''){
                        echo '<li><a href="'.$project['preUrl'].'">Pre Production</a></li>';
                    } else {
                        echo '<li class="isDisabled">Pre Production</li>';
                    }

                    if($project['devUrl'] != ''){
                        echo '<li><a href="'.$project['devUrl'].'">Development</a></li>';
                    } else {
                        echo '<li class="isDisabled">Development</li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
        
        
        
       
                

<div class="detail-container">


    <div class="location-wrapper">
        <ul>
        <?php
                    if($project['wikiUrl'] != ''){
                        echo '<li><a href="'.$project['wikiUrl'].'">Wiki</a></li>';
                    } else {
                        echo '<li class="isDisabled">Wiki</li>';
                    }

                    if($project['qcUrl'] != ''){
                        echo '<li><a href="'.$project['qcUrl'].'">Quality Control</a></li>';
                    } else {
                        echo '<li class="isDisabled">Quality Control</li>';
                    }

                    if($project['serverUrl'] != ''){
                        echo '<li><a href="'.$project['serverUrl'].'">Server</a></li>';
                    } else {
                        echo '<li class="isDisabled">Server</li>';
                    }
                    ?>
        </ul>
    </div>

    <?php
        foreach ($projectstInfo as $project) { 
            if($project['id'] == $projectID){ 

                $feature = $project['featureCount'];
                $defect = $project['defectCount'];
                $issue = $project['issueCount'];

                $cards = ($feature/($feature + $defect + $issue))*100;
                $requests = ($defect/($feature + $defect + $issue))*100;
                $issues = ($issue/($feature + $defect + $issue))*100;               
            ?>
    <div class="graph-container">
        <div class="graph">
            <svg  xmlns="http://www.w3.org/2000/svg" height="400" width="400" viewBox="0 0 200 200" data-value="<?php echo round($cards); ?>">
            <path class="bg" stroke="#ccc" d="M41 149.5a77 77 0 1 1 117.93 0"  fill="none"/>
            <path class="meter" stroke="#1497e5" d="M41 149.5a77 77 0 1 1 117.93 0" fill="none" stroke-dasharray="350" stroke-dashoffset="350"/>

            <text x="140" y="81" class="number"><?php echo round($cards);?></text>
            <text x="170" y="81" class="small">Requests</text>
            </svg>

            <svg  xmlns="http://www.w3.org/2000/svg" height="300" width="300" viewBox="0 0 200 200" data-value="<?php echo round($requests); ?>">
            <path class="bg" stroke="#ccc" d="M41 149.5a77 77 0 1 1 117.93 0"  fill="none"/>
            <path class="meter" stroke="#7aa03e" d="M41 149.5a77 77 0 1 1 117.93 0" fill="none" stroke-dasharray="350" stroke-dashoffset="350"/>

            <text x="140" y="83" class="number"><?php echo round($requests);?></text>
            <text x="179" y="83" class="small">Open Cards</text>
            </svg>

            <svg  xmlns="http://www.w3.org/2000/svg" height="200" width="200" viewBox="0 0 200 200" data-value="<?php echo round($issues); ?>">
            <path class="bg" stroke="#ccc" d="M41 149.5a77 77 0 1 1 117.93 0"  fill="none"/>
            <path class="meter" stroke="#ce77c7" d="M41 149.5a77 77 0 1 1 117.93 0" fill="none" stroke-dasharray="350" stroke-dashoffset="350"/>

            <text x="139" y="88" class="number"><?php echo round($issues); ?></text>
            <text x="196" y="88" class="small">Open Issues</text>
            </svg>
        </div>

    </div>


    








                    

<?php     
            }
        }
        ?>

</div>    
            
<script>
const meters = document.querySelectorAll('svg[data-value] .meter');

meters.forEach(path => {
  let length = path.getTotalLength();
  let value = parseInt(path.parentNode.getAttribute('data-value'));
  let to = length * ((100 - value) / 100);
  path.getBoundingClientRect();
  path.style.strokeDashoffset = Math.max(0, to);
});

</script>
       
   
</body>
</html>