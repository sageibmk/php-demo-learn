<?php 

//including database connection file

require('config/db_connect.php');


$title = $email = $ingredients = '';
$error = array('email'=> '', 'title'=> '', 'ingredients'=> '');

if (isset($_POST['submit'])){

    //checking email
    if(empty($_POST['email'])){
        $error['email'] = "email is required" . '<br>';
    }else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['email'] = 'email must be a valid email address'. '<br>';
        }
    }

    //checking title

    if(empty($_POST['title'])){
        $error['title'] = "title is required" . '<br>';
    }else{
        $title = $_POST['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
           $error['title'] = 'Title must be letter and space only';
        }
    }

    //checking ingredients
    if(empty($_POST['ingredients'])){
        $error['ingredients'] = "at least one ingredient is required" . '<br>';
    }else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z]*)*$/', $ingredients)){
           $error['ingredients'] = 'ingredients must be a comma separated list';
        }
    }

    if (array_filter($error)){
        // echo 'error is in the form';
    }else{

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //create sql
        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

        if(mysqli_query($conn, $sql)){
            //success
            header("location: index.php");
        }else{
            //error
            echo 'query error:' . mysqli_error($conn);
        }
    }


} //end of post check


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sage Pizza</title>
    <style>

        section{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
            padding-top: 50px;
            width: 100%;
        }
        h4{
            font-size: 1.9rem;
            color: grey;
        }
        section form{
            display: flex;
            align-items: center;
            flex-direction: column;
            height: fit-content;
            padding: 30px 0;
            background-color: #fff;
            width: 50%;
        }
        form input:not(:last-child){
            width: 90%;
            height: 50px;
            border: none;
            outline: none;
            border-bottom: 1px solid grey;
        }
        form  .btn{
            color:#fff;
            background-color: orangered;
            width: 100px;
            height: 40px;
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <?php include('header.php');?>

    <section>
        <h4>Add a Pizza</h4>
        <form action="add.php" method="POST">
            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
            <div class="error"><?php echo $error['email']; ?></div>
            <label>Pizza Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
            <div class="error"><?php echo $error['title']; ?></div>
            <label>Ingredient (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
            <div class="error"><?php echo $error['ingredients']; ?></div>
            <input type="submit" name="submit" value="submit" class="btn">
        </form>
    </section>
    
    <?php include('footer.php');?>
</body>
</html>