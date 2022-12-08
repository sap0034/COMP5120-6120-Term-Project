<?php
include 'database.php';
$con = getConnection();
if(!$con) {
    reportError(mysqli_error($con));
return false;
    //die();    
}
function reportError($msg) {

echo '<div id="error"><div class="errorMsg">' . $msg . '</div><button type="button" onClick="acknowledgeError()">Acknowledge</button></div>'; 
}

function reportSuccess($msg) {

echo '<div id="success"><div class="successMsg">' . $msg . '</div><button type="button" onClick="acknowledgeSuccess()">Acknowledge</button></div>'; 
}


?>
<!DOCTYPE html>
<html>
    <head>
       <title>Run Queries</title>
 <link rel='stylesheet' href='Site.css' type='text/css' media='all' />
</head>
<body>
<section id="inputQuery">
    <h1 class="BookstoreTitle">Stephanie Langley's Online Bookstore</h1>
    <h2 class="PageTitle">Input SQL Query and Press Execute</h2>
    <div style="text-align: center;">
<form class="sqlForm" method="POST" action="RunQueries.php" onsubmit="document.getElementById('ExecuteButton').disabled = true;">
        <textarea id="sqlDataText" name="query" placeholder="Add SQL Query Here..."><?= stripslashes($_POST['query'])?></textarea>	
<br/>
        <input id="ExecuteButton" type="submit" value="Execute Query"/>
	<input type="button" value="Clear" onclick="javascript:eraseText();"> 
</form>
</div>
<?php
if(isset($_POST['query'])) {
    $query = $_POST['query'];
    $query = stripcslashes($query);
    $q = strtolower($query);
if($q === NULL || $q === '') {
 reportError("You cannot submit an empty query. Please try again.");
}
else {

    $forbidden = array('drop');
    $acceptedKeys = array('create', 'insert', 'delete', 'update', 'select');
        foreach($forbidden as $key) {
        if(strpos($q, $key) !== false) {
            reportError("DROP queries are not allowed. Please enter a new query.");
        }
	else {
  	$result = executeQuery($con, $query);      
    	if($result == false) {
        	reportError(mysqli_error($con));
	 
    	}
	else {
 	$numFields = mysqli_num_fields($result);
	$numRows = countAffectedRows($con);
	foreach($acceptedKeys as $key) {
        if(strpos($q, $key) !== false) {
		switch($key) {
			case 'select':
				 reportSuccess("Select command was successfully ran and returned {$numRows} results.");
				break;
			case 'create': 
				 reportSuccess("Create table command was successfully completed.");
				break;
			case 'insert':
				 reportSuccess("Insert command was successfully ran and rows have been inserted.");
				break;
			case 'delete': 
				 reportSuccess("Delete command was successfully ran and rows have been deleted.");
				break;
			case 'update':
				 reportSuccess("Update command was successfully ran and rows have been updated.");
				break;
			default: 
				 reportSuccess("Command was successfully ran.");
				break;
		
		}
        }
}
}

}
	}
    }   
?>
<br/>
 <?php

if($numFields !== NULL && $numFields > 0) {
 ?>


<div id="ResultsSection">
<h2 class="PageTitle">Query Results</h2>
<div id="successMessage">

</div>

  <table class="bordered resultsTable">
   <thead>
<?php
     echo '<tr>';
        for($i = 0; $i < $numFields; $i++) {
            $field = mysqli_fetch_field_direct($result, $i);
            echo '<th>' . $field->name . '</th>';
        }
        echo '</tr>';
        ?>
        </thead>
        
        <?php        
        $rows = array();
        while($resultRow = mysqli_fetch_assoc($result)) {
            $rows[] = $resultRow;
        }
        foreach($rows as $row) {
            echo '<tr>';
            foreach($row as $col) {
                echo '<td>' . $col . '</td>';        
            }
            echo '</tr>';
        }
        
        mysqli_free_result($result);

   ?>     

</table>
</div>
<?php
}
 ?>
<?php
}
?>
</section>
</body>
<footer>
<div style="align-content: center;">
<button class="button buttonfooter" onClick="window.location.href='https://webhome.auburn.edu/~sap0034';">Back to Home Page</button>
</div>
</footer></html>
<?php mysqli_close($con); ?>
<script type="text/javascript">
//function to remove the text from the input and to clear the table
const targetDiv = document.getElementById("ResultsSection");
const errorDiv = document.getElementById("error");
const successDiv = document.getElementById("success");
function eraseText() {
    document.getElementById("sqlDataText").value = "";
    targetDiv.style.display = "none";
}

function acknowledgeError() {
 errorDiv.innerHTML = "";
 errorDiv.style.display = "none";
 document.getElementById("sqlDataText").value = "";
}

function acknowledgeSuccess() { 
 successDiv.innerHTML = "";
 successDiv.style.display = "none";

}
</script>

