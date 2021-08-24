<?php
$host="localhost";
$user="root";
$password="";
$dbName="work";
$conn = mysqli_connect($host ,$user ,$password ,$dbName);
//================================================================
if (isset($_POST['send'])) {
    $name = $_POST['custName'];
    $address = $_POST['custAddress'];
    $phone = $_POST['custPhone'];
    $insert = "INSERT INTO `customer` VALUES(NULL,'$name' ,'$address' ,'$phone')" ;
  $i = mysqli_query($conn ,$insert);

  if ($i) {
      echo "insert ture";
  }else{
      echo "insert falso";
  }
}

// read
$select = "SELECT * FROM `customer` ";
$S = mysqli_query($conn ,$select);

//Delete
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete ="DELETE FROM `customer` WHERE id = $id";
    $d = mysqli_query($conn ,$delete);
    header("Location:/start/index.php");
}

// edit
$name ="";
$address ="";
$phone ="";

if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM `customer` WHERE id = $id";
    $s = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($s);
    $name = $row ['name'];
    $address = $row ['address'];
    $phone = $row ['phone'];
    if(isset($_POST['update'])) {
        $name = $_POST['custName'];
        $address = $_POST['custAddress'];
        $phone = $_POST['custPhone'];
        $update = "UPDATE `customer` SET name = '$name' , address = '$address' , phone = '$phone' where id = '$id'"  ;
        $u = mysqli_query($conn ,$update);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
 </head>

<body>
    <h1 class="text-center text-info">curd with php</h1>
    <div class="container col-6 my-3">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label> customer name</label>
                        <input name="custName" value="<?php echo $name  ?>" type="text" placeholder=" YOUR NAME" class="form-control">
                    </div>
                    <div class="form-group">
                        <label> customer address</label>
                        <input name="custAddress" value="<?php echo $address ?>" type="text" placeholder=" YOUR ADDRESS" class="form-control">
                    </div>
                    <div class="form-group">
                        <label> customer phone</label>
                        <input name="custPhone" value="<?php echo $phone ?>" type="text" placeholder=" YOUR PHONE" class="form-control">
                    </div>
                    <button name="send" class="btn btn-info w-50 btn-block m-2 mx-auto">send data</button>
                    <button name="update" class="btn btn-primary w-50 btn-block m-2 mx-auto">update data</button>

                </form>
            </div>
        </div>
    </div>
    <div class="container col-6 my-3">
        <div class="card">
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($S as $customer) { ?>
                    <tr>
                        <td> <?php echo $customer['id'] ?> </td>
                        <td> <?php echo $customer['name'] ?> </td>
                        <td> <?php echo $customer['address'] ?> </td>
                        <td> <?php echo $customer['phone'] ?> </td>
                        <td><a href="index.php?delete=<?php echo $customer['id']?>" class="btn btn-danger"> Delete</a></td>
                        <td><a href="index.php?edit=<?php echo $customer['id']?>" class="btn btn-info">Edit</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>