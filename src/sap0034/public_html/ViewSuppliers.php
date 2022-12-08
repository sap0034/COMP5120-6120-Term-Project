<?php
include 'database.php';
$con = getConnection();

// SQL query to select data from database
$sql = " SELECT * FROM db_supplier";
$result = $con->query($sql);
?><!DOCTYPE html>
<html>
    <head>
       <title>View Suppliers</title>
 <link rel='stylesheet' href='Site.css' type='text/css' media='all' />
</head>
<body>
<h1 class="BookstoreTitle">Stephanie Langley's Online Bookstore</h1>
    <h2 class="PageTitle">View All Suppliers</h2>

<section>
<div>
        <!-- TABLE -->
        <table>
            <tr>
                <th>Supplier ID</th>
		<th>Company Name</th>
                <th>Contact Last Name</th>
                <th>Contact First Name</th>
                <th>Phone Number</th>
	</tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['SupplierID'];?></td>
 		<td><?php echo $rows['CompanyName'];?></td>
                <td><?php echo $rows['ContactLastName'];?></td>
                <td><?php echo $rows['ContactFirstName'];?></td>
                <td><?php echo $rows['Phone'];?></td>
  	   </tr>
            <?php
                }
            ?>
        </table>
</div>
    </section>

</body>
<footer>
<div style="align-content: center;">
<button class="button buttonfooter" onClick="window.location.href='https://webhome.auburn.edu/~sap0034';">Back to Home Page</button>
</div>
</footer>
</html>
<?php mysqli_close($con); ?>