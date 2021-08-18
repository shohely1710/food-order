 <?php

    //Include Constants File
    include('../config/constants.php');

    // echo "Delete Page"; 
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and Delete

        // echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if available
        if($image_name != "")
        {
            //Image is AVailable. So remove it
            $path = "../images/category/".$image_name;
            //Remove the Image
            $remove = unlink($path);
            
            //If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the Session Message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                //Redirect to Manage Category Page
                header('location:'.SITEURL. 'admin/manage-category.php');

                //Stop the Process
                die();
            }
        }

        ///Delete Data from Database
        //SQL Query to Delete Data from Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from database or not
        if($res==true)
        {
            //SET Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";

            //Redirect to Manage Category
            header('location:' .SITEURL. 'admin/manage-category.php');

        }
        else
        {
            //SET fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";

            //Redirect to Manage Category
            header('location:' .SITEURL. 'admin/manage-category.php');

        }

        //Redirect to Manage Category Page With Message
    }

    else
    {
        //redirect to Manage Category Page
        header('location:' .SITEURL. 'admin/manage-category.php');
    }

?>