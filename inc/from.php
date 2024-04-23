<?php
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$errors = [
    'firstNameError' => '',
    'lastNameError' => '',
    'emailError' => '',
];

if (isset($_POST['submit'])){

    if (empty($firstName )){
        $errors['firstNameError'] = 'يرجى ادخال الاسم الاول';
    }
    
    elseif (empty($lastName)){
    $errors['lastNameError'] = 'يرجى ادخال الاسم الاخير';   
    } 
    
    
    elseif (empty($email)){
        $errors['emailError'] = 'يرجى ادخال الايميل';
    }

    // تحقق من صحة البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['emailError'] = 'يرجى ادخال ايميل صحيح';
    }

    // تحقق من عدم وجود أخطاء
    if (!array_filter($errors)) {
        $firstName = mysqli_real_escape_string($conn, $firstName = $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $lastName = $_POST['lastName']);
        $email = mysqli_real_escape_string($conn, $email = $_POST['email']);

        $sql = "INSERT INTO users(firstName, lastName, email)
            VALUES('$firstName', '$lastName', '$email')";
        
        if(mysqli_query($conn, $sql)){
            header('Location: ' . $_SERVER['PHP_SELF']);
        }else{
            echo 'Error: ' .  ($conn);
        }
    }
}
?>