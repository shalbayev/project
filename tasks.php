<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
<style>
  * {
  margin: 0;
  padding: 0;
  outline: none;
}

body {
  font-family: "Lato", sans-serif;
}

.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  margin-top: 55px;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;

}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;

  position:absolute;
  top:63px;
  
}

.openbtn:hover {
  background-color: #444;
}

#main {
  transition: margin-left .5s;
}

header {
  width: 100%;
  padding: 10px 0px ;
  background-color:black;
  float: left;
  position: absolute;
}

header #logo {
  color: #fff;
  cursor: pointer;
}

header #logo span {
  font-size: 1.7em;
  line-height: 45px;
  margin-left: 40px;
font-family: fantasy;
}

@media (min-width: 701px) {
  #logo {
    float: left;
    width: 30%;
    font-size: 1.1em;
  }

  #about {
    float: right;
    width: 67%;
  }
}

@media (max-width: 700px) {
  #logo {
    margin-top: 15px;
    width: 100%;
    font-size: 1.5em;
  }

  #about {
    float: left;
    width: 100%;
  }
}

#about {
  text-align: center;
  font-size: 1em;
  line-height: 40px;
  margin-bottom: 10px;
}

#about > a {color: #fff}

#about > a:hover {
  color: #b0b0b0;
  text-decoration: underline;
}

#about > a:not(:last-child) {
  margin-right: 7%;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
</head>
<body><header>
  <div id="logo" >
      <span>To DO</span>
    </div>
  </header>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
  <a href="#">My day</a>
  <a href="#">Important</a>
  <a href="#">Plans</a>
  <a href="#">Tasks</a>

</div>

<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fas fa-align-left"></i></button>  

<?php 
  include "db.inc.php";
  $query = "SELECT * FROM todo";
  $result = mysqli_query($connection,$query);
  if ($_SERVER['REQUEST_METHOD']=='POST') {
    $todo = $_POST['todo'];
    $date = date('l dS F\, Y');
    $sql = "INSERT INTO todo(t_name,t_date) VALUES('$todo','$date');";
    $results = mysqli_query($connection,$sql);
    if (!$results) {
      die("Failed");
    }else{
      header("Location:tasks.php?todo-added");
    }
  }
  if (isset($_GET['delete_todo'])) {
    $dtl_todo = $_GET['delete_todo'];
    $sqli = "DELETE FROM todo WHERE t_id = $dtl_todo";
    $res = mysqli_query($connection,$sqli);
    if (!$res) {
      die("Failed");
    }else{
      header("Location:tasks.php?todo-deleted");
    }
  }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TODO App Wtih PHP and MYSQL</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <style>
    .todo{
      display:flex;
      flex-direction:column;
      justify-content: center;
      align-items: center;
      border-radius:3px;
      border: 1px solid #ccc;
      margin-top:5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="todo">
      <h1>
        Start
      </h1>
      <h3>Add a New Todo</h3>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" name="todo" placeholder="Todo Name">
        </div>
        <div class="form-group">
          <input class="btn btn-primary" value="Add a New todo Task List" type="submit">
        </div>
      </form>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <th>ID</th>
          <th>Todo</th>
          <th>Date added</th>
          <th>Edit Todo</th>
          <th>Delete Todo</th>
        </thead>
        <tbody>
          <?php 


          while($row = mysqli_fetch_assoc($result)){
            $t_id = $row['t_id'];
            $t_name = $row['t_name'];
            $t_date = $row['t_date'];
          ?>
          <tr>
            <td><?php echo $t_id; ?></td>
            <td><?php echo $t_name; ?></td>
            <td><?php echo $t_date; ?></td>
            <td> <a href="#" class="btn btn-primary">Edit Todo</a></td>
            <td> <a href="tasks.php?delete_todo=<?php echo $t_id; ?>" class="btn btn-danger">Delete Todo</a></td>
          </tr>
        <?php } ?>
          
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
</div>

<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
   
</body>
</html> 
