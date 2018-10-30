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
<?php
    if (isset($_SESSION["t_users_name"])) {
        echo '<div class="sign-up container">';
        echo '    <a href="signOut.php" class="signout" ><button id="btnsignIn" class="btn btn-primary">Sign out ' . $_SESSION["t_users_name"] . '</button></a>';
        echo '</div>';

        // fetch the user data
        $sql = 'SELECT * 
                FROM T_tasks 
                WHERE fk_tasks_users = "' . $DBsource->escapeString($_SESSION["t_users_id"]) . '"';

        $loggedIn = false;
        $result = $DBsource->dbQuery($sql);
        $index = 0;
        if($result->num_rows > 0) {
            echo '<div class="hidden" id="tasks" data-tasks=\'[';
            while($row=$result->fetch_assoc()) {
                echo '{';
                if (isset($row['t_tasks_content']) && isset($row['t_buckets_name'])) {
                    echo '"content":"' . $row['t_tasks_content'] . '", ';
                    echo '"state":"' . $row['t_buckets_name'] . '"';
                }
                if ($index === ($result->num_rows-1)) {
                    echo '}';
                } else {
                    echo '},';
                }
                $index++;
            }
            echo ']\'></div>';
        }
    } else {
        echo '<div class="sign-up container">';
        echo '    <a href="signIn.php" class="signin" ><button id="btnsignIn" class="btn btn-primary">Sign in</button></a>';
        echo '    <a href="signUp.php" class="signup" ><button id="btnsignUp" class="btn btn-primary">Sign up</button></a>';
        echo '</div>';
    }
?>


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

        echo 'Database query is excuted';
    } else {
        echo 'it\'s not validated';
    }

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
    </div>
</div>
<!-- end:modal-signup -->


<!-- modal -->


<span class="error">
<?php
if (!empty($email) && !empty($password)){
    echo "Hello $email your password is $password";
}
?>
</span>


<div class='container text-center'>
    <h1 id="title">KanBan Board</h1>
</div>
<div class="container text-center">

    <input type="text" placeholder=" What are you going to do ??" id='input' required/>
    <button id="add" class="btn btn-primary">Add</button>

    <P class="must">You need to be signed in or up to start the work!</P>
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

<script src="jquery/jquery-3.1.1.min.js"></script>
<script src="bootstrap/bootstrap.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/app.js"></script>

</body>

</html>
