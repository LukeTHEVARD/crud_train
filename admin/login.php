<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <title>log in | Royal Pixels Gaming</title>
</head>
<body>
    <?php

        require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
        require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
        $error="";

        if (!empty($_POST["user_email"]) && !empty($_POST["user_password"])){
            
            $stmt = $db -> prepare("SELECT*FROM table_user WHERE user_email =:email");
            $stmt -> execute([":email" => $_POST["user_email"]]);
            
            if($row = $stmt -> fetch()){
                if(password_verify($_POST['user_password'], $row['user_password'])){
                    session_start();
                    $_SESSION["logged"]="1";
                    redirect("index.php");
                }
                $error="problème de connexion";
            }
            $error="problème de connexion";
        };
    
    ?>
    <form method="POST" action="login.php">

        <div class="form-group">
            <?php if($error){ ?>
                <div><?= $error; ?> </div>
            <?php } ?>
            <label for="InputEmail1">Email address</label>
            <input type="email" name="user_email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="InputPassword1">Password</label>
            <input type="password" name="user_password" class="form-control" id="InputPassword1" placeholder="Password">
        </div>

        <button type="submit" value="ok" class="btn btn-primary">Submit</button>
        
    </form>
</body>
</html>