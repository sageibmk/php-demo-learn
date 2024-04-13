<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background-color: #ff30;     
        }
        nav ul{
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 200px;
        }
        .ul li {
            list-style: none;
            font-size: 1.9rem;
            color: #fff;
            background-color: orangered;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            
        }
        a{
            color: #fff;
            text-decoration: none;
        }
        nav{
            padding: 20px 130px;
            height: 100px;
            background-color:whitesmoke;
        }
    </style>
</head>
<body>
    <nav>
        <ul class="ul">
            <li> <a href="index.php">Sage Pizza</a></li>
            <li><a href="add.php">Add Pizza</a></li>
        </ul>
    </nav>
    
</body>
</html>