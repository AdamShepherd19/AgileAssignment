<?php include "../Includes/db.inc.php";?>
<?php $userID = $_GET['id']; ?>
<html>
	<title>Manage User</title>
	<body>
		<h1> Manage User <?php echo $userID; ?> </h1>
		
		<button onclick="location.href='';" type="button">Delete Account</button>
		
		<div>
			<?php
			
				if(ISSET($_GET['id'])){
					$query = "SELECT * FROM User WHERE User.UserID = $userID";
					$result = mysqli_query($conn, $query);
					
					while($row = mysqli_fetch_array($result)){
						echo "<h4>Username: " . $row['UserName'] . "</h4>";
						echo "<h4>Firstname: " . $row['Firstname'] . "</h4>";
						echo "<h4>Surname: " . $row['Surname'] . "</h4>";
						echo "<h4>Email: " . $row['EmailAddress'] . "</h4>";
						echo "<h4>Role: " . $row['Role'] . "</h4>";
						echo "<h4>Password: " . $row['Password'] . "</h4>";
					}
				}
			?>
		</div>
	</body>

</html>