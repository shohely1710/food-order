<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>

        <?php

            if(isset($_SESSION['add']))//checking  whether the session is set or not
            {
                echo $_SESSION['add'];//Display Session Message if set
                unset($_SESSION['add']);//Removing Session Message
            }


        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Password"></td>
                </tr>

                <tr>
                    <td colspan="2">

                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>

<?php

    //Process the Value from form and save it in Database

    //Check whether the button is clicked or not

    if(isset($_POST['submit']))
    {
        //Button Clicked

        // echo "Button Clicked";

        //Get the data from form

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);//Password Encryption with MD5

        //2. SQL Query to save the data into database
        $sql = "INSERT INTO tbl_admin SET

            full_name='$full_name',
            username='$username',
            password='$password'


        ";


        //Executing query and saving data into database
        
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4.Check whether the (Query is executed)data is inserted or not and display approriate message

        if($res==TRUE)
        {
            //Data Inserted
            // echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Seccessfullly.</div>";

            //Redirect Page TO Manage Admin
            header("location:" .SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to INsert Data
            // echo "Failed to insert data";

            $_SESSION['add'] = "<div class='error'>Failed to Add Admin. </div>";

            //Redirect Page TO ADD Admin
            header("location:" .SITEURL.'admin/add-admin.php');
        }



    }
   




?>