 <?php
    
    $errors = [];
    
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Hér þarf meira validation

    $dbUsers = new Users($conn);
    $status = $dbUsers->newUser($firstname,$lastname,$email,$username,$password);

    if ($status) {
        $success = "$username has been registered. You may now log in.";
    }else{
        $errors[] = "$username is already in use. Please choose another username.";
    } 