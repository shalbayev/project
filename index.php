<?php 
//connect to database
$db = mysqli_connect('localhost','root','','todo');
if(isset($_POST['submit'])){
	$task = $_POST['task'];

	mysqli_query($db,"INSERT INTO tasks (task) VALUES ('$task')"); 
	header('location: index.php');
	$tasks = mysqli_query($db, "SELECT * FROM `tasks`");
} 
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Todo list application with PHP and MySQL</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<div class="heading">
		<h2>Todo list application with PHP and MySQL</h2>
	</div>
	<form action="index.php" method="POST">
		<input type="text" name="task" class="task_input">
		<button type="submit" class="add_btn" name="submit"> Add task</button>
	</form>
	<table> 
		<thead>
		<tr>
			<th>N</th>
			<th>Task</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($row = mysqli_fetch_array($tasks)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td class="task"><?php echo $row['task']; ?></td>
			<td class="delete">
				<a href="#">x</a>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</body>
</html>