<?php 
require('config/db_connect.php');

if(isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        //success
        header('location: index.php');
    }
    else{
        //failure
        echo 'query error:' . mysqli_error($conn);
    }
}


//check get request id parameter

if(isset ($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //make sql
    $sql = "SELECT * FROM pizzas WHERE id = $id";

    //get query result
    $result = mysqli_query($conn, $sql);

    //fetch result in array format
    $pizza = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php')?>

<center>
    <?php if($pizza) {?>
        <h2><?php echo htmlspecialchars($pizza['title']); ?></h2>
        <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
        <p><?php echo date($pizza['created_at']); ?></p>
        <h5>Ingredients:</h5>
        <p><?php echo htmlspecialchars($pizza['ingredients'])?></p>

        <!--DELETE FROM-->

        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
            <input type="submit" name="delete" id="delete" value="Delete">
        </form>




        <?php } else{?>
            <h1>No such pizza exist!!</h1>
            <?php }?>
</center>
    
<?php include('footer.php')?>
</body>
</html>