<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Reset Password In PHP MySQL</title>

        <link rel="stylesheet" href="../style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </head>
    <body>
    <p class="header"></p>
    <div class="container" style='border:0;'>
        <div class="card">
            <div class="card-header text-center">
                Reset Password
            </div>
                        <div class="card-body">
            <?php if ($_GET["token"]) {
                require_once '../../db.php';
                $token = $_GET["token"];
                $query = mysqli_query(
                    DB::connect(),
                    "SELECT * FROM `users` WHERE `code_password`='$token'"
                );
                $curDate = date("Y-m-d H:i:s");
                if (mysqli_num_rows($query) > 0) {
                    $row = mysqli_fetch_array($query);
                    if ($row["new_password_expires"] >= $curDate) { 
                        echo "
                        <form action='updatePassword.php' method='post'>
                            <input type='hidden' name='token' value='$token'>
                            <div class='form-group'>
                                <label for='exampleInputEmail1'>Password</label>
                                <input type='password' name='password' class='form-control'>
                            </div>                
                            <div class='form-group'>
                                <label for='exampleInputEmail1'>Confirm Password</label>
                                <input type='password' name='cpassword' class='form-control'>
                            </div>
                            <input type='submit' name='new-password' class='btn btn-primary mt-3'/>
                        </form>
                        ";
                    } else {
                        echo "<p>This forget password link has been expired</p>";
                    }
                }
                } ?>
                </div>
            </div>
        </div>
    </body>
</html>