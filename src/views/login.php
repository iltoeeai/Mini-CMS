<?php
session_start();
require 'includes/header.php';

// login
$msg = '';

if (
    isset($_POST['login']) && !empty($_POST['username'])
    && !empty($_POST['password'])
) {
    $user = $entityManager->getRepository('User')->findBy(['username' => $_POST['username']]);
    //var_dump ($user);

    if ($user) {
        $username = $user[0]->getUsername();
        $password = $user[0]->getPassword();

        if ($password === md5($_POST['password'])) {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $username;
            Header('Location: login');
        }
    } else {
        $msg = 'Wrong password or username';
    }
}

//logout
if ($rootUrl === "logout") {
    unset($_SESSION['valid']);
    unset($_SESSION['username']);
    unset($_SESSION['timeout']);
    session_destroy();
    Header('Location: login');
    exit();
}

#LOGIN FORM
if (!$_SESSION['valid']) {
    print('<div class="container mt-5 pt-5 form-signin"><div class="container">');
    print('<form class="form-signin" role="form" action=""  method="post">');           
    print('<h4 class="form-signin-heading">' . $msg . '</h4>');         // $msg = 'Wrong password or username';
    print('<input type="text" class="form-control" name="username" placeholder="Username" required autofocus></br>');
    print('<input type="password" class="form-control mb-5" name="password" placeholder="Password" required>');
    print('<button class="btn btn btn-primary btn-lg mt-2 btn-block" type="submit" name="login">Login</button></form>');
    print('</div>');
} else {
    echo '<h2 class="display-6 mt-5 pt-5 text-secondary text-center">
        Welcome, ' . $_SESSION['username'] . ', you have successfully logged in
        </h2>';
}
echo"</div>";
require 'includes/footer.php';
?>

