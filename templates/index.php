<?php 

//including database connection file
   require ('config/db_connect.php');

     //write query for all pizzas.
     $sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

     //make query and get result.
     $result = mysqli_query($conn, $sql);

     //get the resulting row as an array.
     $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

     //free result from memory.
     mysqli_free_result($result);

     //close connection.
     mysqli_close($conn);
    
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

    <h4>Pizzas</h4>
    <div class="items">
            <div class="container">
                <div class="row">
                    <?php foreach($pizzas as $pizza ){?>
                    <div class="card">
                        <img src="images/pizza.svg" id"pizza">
                        <div class="card-content">
                            <h6> <?php echo htmlspecialchars($pizza['title'])?></h6>
                              <div>
                                <ul>
                                    <?php foreach(explode(',', $pizza['ingredients']) as $ing) {?>
                                        <li style="list-style: none;"> <?php echo htmlspecialchars($ing);?></li>

                                        <?php }?>
                                </ul>

                              </div>
                        </div>
                           <div class="more-info"> <a href="details.php?id=<?php echo $pizza['id']?>">more info</a> </div>
                    </div>
                    <?php }?>
                </div>
        </div>
    </div>

    <?php include('footer.php')?>
</body>
</html>