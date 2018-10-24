<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>KanBan Board</title>
    <link rel="stylesheet" href="../resources/library/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../resources/library/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/main.css">


</head>

<body>
<div class="sign-up container">
    <a href="#" class="signin" data-toggle="modal" data-target="#signin"><button id="btnsignIn" class="btn btn-primary">Sign in</button></a>
    <a href="#" class="signup" data-toggle="modal" data-target="#signup"><button id="btnsignUp" class="btn btn-primary">Sign up</button></a>
</div>

<?php


// define variables and set to empty values
$email = $password = $repeatPassword = "";
$emailError = $passwordError = $repeatPasswordError = $passwordMatch = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($_POST["repeatPassword"])) {
        $passwordError = "Password is required";
    } else if ($_POST("repeatPassword") !== $_POST["password"]){
        $passwordMatch = "Password doesn't match";
    }
    else {
        $password = test_input($_POST["password"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<div>
    <div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="signin" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Sign in</h4>
                </div>
                <div class="modal-body">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" role="form">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input id="email" type="email" name="email" class="form-control input-lg" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" class="form-control input-lg" placeholder="Password" required>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="forget"> Keep me logged in
                            </label>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="confirm-btn" value="Sign in">
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- end:modal-signin -->

    <!-- modal -->

</div>
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="signup" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sign up</h4>
            </div>
            <div class="modal-body">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" role="form">
                    <div class="form-group">
                        <input type="email" name="email"  class="form-control input-lg" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password"  class="form-control input-lg" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="repeatPassword"  class="form-control input-lg" placeholder="Confirm Password" required>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="agree"> Agree to our <a href="#">terms of use</a> and <a href="#">privacy policy</a>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="confirm-btn" value="Sign up">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- end:modal-signup -->


<!-- modal -->

<div class='container text-center'>
    <h1 id="title">KanBan Board</h1>
</div>
<div class="container text-center">

    <input type="text" placeholder=" What are you going to do ??" id='input' required/>
    <button id="add" class="btn btn-primary">Add</button>

    <P class="must"></P>
</div>
<div class="row text-center">

    <div class="col-md-4">
        <h2 id="toDo-title"><span class="glyphicon glyphicon-th-list" aria-label="Left Align"></span>  TO DO </h2>
        <div class="todo"> </div>
    </div>

    <div class="col-md-4">
        <h2 id="inProgress-title"><span class="glyphicon glyphicon-pencil" aria-label="center Align"></span>  In Progress...  </h2>
        <div class="inprogress"> </div>

    </div>

    <div class="col-md-4">
        <h2 id="Done-title"> <span class="glyphicon glyphicon-ok" aria-label="center Align"></span>  DONE !!</h2>
        <div class="done"> </div>

    </div>
</div>
<?php
    echo "Hello $email your password is $password";
?>

<script src="../resources/library/jquery/jquery-3.1.1.min.js"></script>
<script src="../resources/library/bootstrap/bootstrap.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/app.js"></script>

</body>

</html>
