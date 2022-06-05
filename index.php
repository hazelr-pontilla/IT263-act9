<?php
    require_once('function.php');
    require_once('validations.php');

    $errors = array();

    if(isset($_POST['save']))
    {
        $fname = validate_required_data($_POST['fname']);
        $lname = validate_required_data($_POST['lname']);
        $email = validate_required_data($_POST['email']);

        if($fname === FALSE)
        {
            $errors['fname'] = 'Please fill out the required form';
        }
        if($lname === FALSE)
        {
            $errors['lname'] = 'Please fill out the required form';
        }
        if($email === FALSE)
        {
            $errors['email'] = 'Please fill out the required form';
        }
        else
        {
            $email = validate_email_data($email);

            if($email === FALSE)
            {
                $errors['email'] = 'Email must contain @ and . to validate.';
            }
        }

        if (count($errors) == 0)
        {
            insertData($fname, $lname, $email);
            header('location: index.php');
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style type="text/css">
        table {
            border-collapse: collapse;
        }
        table, th, td {
            boder: 1px solid #000;
            padding: 5px 10px;
        }
        body {
            padding: 10px 20px;
        }
        .text-error{
            color: red;
        }
    </style>

</head>
<body>
    <h1>Not an Activity in Form Validation</h1>

    <h3>Add User</h3>

    <?php
        if (!empty( $errors))
        {
            foreach ($errors as $key => $msg)
            {
                echo "<span class='text-error'>$msg</span> <br>";
            }
        }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <p>First Name: <span style="color:red;" >*</span> <br> 
        <input type="text" name="fname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
    </p> 
    <p>Last Name: <span style="color:red;" >*</span> <br> 
        <input type="text" name="lname" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>">
    </p>
    <p>Email: <span style="color:red;" >*</span> <br> 
        <input type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
    </p>
    <input type="submit" name="save" value="Save">
    </form>

    <!--  the value in here is the sticky form, para mag stay hiya incase mag sasave hin data pero kulang -->

    <br>
    <hr>
    <h3>List of Users</h3>
    
    <?php
        if(isset($_POST['save']))
        {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
    
            insertData($fname, $lname, $email);
    
            header('location: index.php');
        } 
    ?>
    <hr>    
    <?php
        $result = getAllData();

        if ($result)
        {
            ?>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($result as $key => $row)
                        {
                            echo '<tr>
                                <td>'.$row['first_name'].'</td>
                                <td>'.$row['last_name'].'</td>
                                <td>'.$row['email'].'</td>
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>
            <?php
        }
        else
        {
            echo '<p>No result found</p>';
        }
    ?>

</body>
</html>