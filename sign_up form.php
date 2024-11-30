<?php 


require 'db_con.php';





if(isset($_POST['insertUser'])){
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phonenum = $_POST['phone'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = 'INSERT INTO customer_info(first_name, last_name, address, email, phone_num, password) VALUES(:fname,:lname,:address,:email,:phone_num,:pass)';
    $stmt = $pdo->prepare($sql);

    $data = [
        'fname'=> $fname,
        'lname' => $lname,
        'address' => $address,
        'phone_num' => $phonenum,
        'email' => $email,
        'pass' => $pass    
    ];
    try {
        $stmt->execute($data);
        // echo 'success!';
        header('Location: login.php');
    } catch (PDOException $e) {
        echo 'Error:'. $e->getMessage();
    }

}
?>