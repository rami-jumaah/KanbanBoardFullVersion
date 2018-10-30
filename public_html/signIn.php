<?php
session_start();
require_once ('../src/config.php');
require_once ('../src/DBsource.php');
$DBsource = new DBsource($config);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>KanBan Board</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/main.css">


</head>

<body>
<div class="sign-up container">
    <a href="#" class="signin" data-toggle="modal" data-target="#signin"><button id="btnsignIn" class="btn btn-primary">Sign in</button></a>
    <a href="signUp.php" class="signup" ><button id="btnsignUp" class="btn btn-primary">Sign up</button></a>
</div>

<?php

class SignIn {
    public $email;
    public $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;

    }

    public function validate ()
    {

        $this->email = filter_var($this->email, FILTER_VALIDATE_EMAIL);

        if (empty($this->email)) {
            return false;
        }

        if (empty($this->password)) {
            return false;
        }

        $this->password = hash('sha512', $this->password);
        return true;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $signIn = new SignIn($_POST['email'], $_POST['password']);

    if ($signIn->validate()) {
        echo "it's validated";

        $sql = 'SELECT * 
                FROM T_users 
                WHERE t_users_name = "' . $DBsource->escapeString($signIn->email) . '" 
                and t_users_pass = "' . $DBsource->escapeString($signIn->password) .'"';

        $loggedIn = false;
        $result = $DBsource->dbQuery($sql);
        if($result->num_rows > 0) {
            while($row=$result->fetch_assoc()) {
                if (isset($row['t_users_name'])) {
                    $loggedIn = true;
                    $_SESSION["t_users_name"] = $row['t_users_name'];
                    $_SESSION["t_users_id"] = $row['idT_users'];
                }
            }
        }

        if ($loggedIn) {
            echo "logged in";

            header("Location: index.php");
            die();
        }
        echo 'Data is already there';

    } else {
        echo 'it\'s not valid data';
    }

}

?>


<div class='container text-center'>
    <a href="index.php"> <h1 id="title">KanBan Board</h1></a>
</div>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Sign in</h4>
    </div>
    <div class="modal-body">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" role="form">
            <div class="form-group">
                <label for="email">Email address</label>
                <input id="email" type="email" name="email" class="form-control input-lg" placeholder="Enter email">
                <span class="error"><?php echo $emailError;?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control input-lg" placeholder="Password">
                <span class="error"><?php echo $passwordError;?></span>
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
<script src="jquery/jquery-3.1.1.min.js"></script>
<script src="bootstrap/bootstrap.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/app.js"></script>

</body>

</html>
