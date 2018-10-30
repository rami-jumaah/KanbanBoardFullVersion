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
    <a href="signIn.php" class="signin"><button id="btnsignIn" class="btn btn-primary">Sign in</button></a>
    <a href="#" class="signup" ><button id="btnsignUp" class="btn btn-primary">Sign up</button></a>
</div>

<?php

class Register {
    public $email;
    public $password;
    public $repeatPassword;

    public function __construct($email, $password, $repeatPassword)
    {
        $this->email = $email;
        $this->password = $password;
        $this->repeatPassword = $repeatPassword;

    }

    public function validate ()
    {

        $this->email = filter_var($this->email, FILTER_VALIDATE_EMAIL);

        if (empty($this->email)) {
            return false;
        }

        if (empty($this->password) && $this->password !== $this->repeatPassword) {
            return false;
        }

        $this->password = hash('sha512', $this->password);
        return true;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $register = new Register($_POST['email'], $_POST['password'], $_POST['repeatPassword']);

    if ($register->validate()) {
        echo "it's validated";

        $sql = 'INSERT INTO T_users SET t_users_name = "' . $DBsource->escapeString($register->email) . '", t_users_pass = "' . $DBsource->escapeString($register->password) .'"';
        $DBsource->dbQuery($sql);

        echo ' , Database query is excuted';

        $_SESSION["t_users_name"] = $register->email;
        $_SESSION["t_users_id"] = $DBsource->getConnection()->insert_id;


        header("Location: index.php");
        die();

    } else {
        echo 'it\'s not validated';
    }

}

?>

<div class='container text-center'>
    <a href="index.php"> <h1 id="title">KanBan Board</h1></a>
</div>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Sign up</h4>
    </div>
    <div class="modal-body">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" role="form">
            <div class="form-group">
                <input type="email" name="email" class="form-control input-lg" placeholder="Enter email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control input-lg" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" name="repeatPassword" class="form-control input-lg" placeholder="Confirm Password">
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


<span class="error">
<?php
if (!empty($email) && !empty($password)){
    echo "Hello $email your password is $password";
}
?>
</span>

<script src="jquery/jquery-3.1.1.min.js"></script>
<script src="bootstrap/bootstrap.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/app.js"></script>

</body>

</html>
