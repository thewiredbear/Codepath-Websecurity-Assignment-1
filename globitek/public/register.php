<?php
  require_once('../private/initialize.php');
  require_once('../private/validation_functions.php');
  require_once('../private/functions.php');
  $db = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
  $requestType=is_post_request();
  if($requestType==1){
    $errors=[];

    if(is_blank($_POST["firstname"])){
      $errors[]="The first name cannot be blank";
      echo has_length($_POST["firstname"],['min' => 2,'max' => 255]);
    }else{
      if(has_length($_POST["firstname"],['min' => 2,'max' => 255])==false){
        $errors[]="Length of first name has to be between 2 and 255";
      }
      if(preg_match("/[^a-zA-Z0-9-'\,\.]/", $_POST["firstname"])){
        $errors[]="First name can only have letters, spaces, symbols:-,.'";
      }
    }

    if(is_blank($_POST["lastname"])){
      $errors[]="The last name cannot be blank";
    }else{
      if(!has_length($_POST["lastname"],['min' => 2,'max' => 255])){
        $errors[]="Length of last name has to be between 2 and 255";
      }
      if(preg_match("/[^a-zA-Z0-9-'\,\.]/", $_POST["firstname"])){
        $errors[]="Last name can only have letters, spaces, symbols:-,.'";
      }
    }

    if(is_blank($_POST["username"])){
      $errors[]="The username cannot be blank";
    }else{
      if(!has_length($_POST["username"],['min' => 8,'max' => 255])){
        $errors[]="Length of username has to be between 8 and 255";
      }
      if(preg_match("/[^a-zA-Z0-9_]/", $_POST["firstname"])){
        $errors[]="First name can only have letters, spaces, symbols:_";
      }
    }

    if(is_blank($_POST["email"])){
      $errors[]="The email cannot be blank";
    }

    $usr = $_POST["username"];
    $checkUSR="SELECT * FROM users WHERE username="."'$usr'";
    mysqli_select_db($db,'users');
    $retrieve = mysqli_query($db,$checkUSR);
    if($retrieve){
      $errors[]="Username: " . $_POST["username"] . " already exists";
    }
    //echo $errors[0];
    echo display_errors($errors);
  

    if(sizeof($errors)==0){
      date_default_timezone_set("UTC");
      

      if(mysqli_connect_errno()){
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " : " . mysqli_connect_errno();
        exit($msg);
      }

      //values
      $firstname=$_POST["firstname"];
      $lastname=$_POST["lastname"];
      $username=$_POST["username"];
      $email=$_POST["email"];
      $created= date("Y-m-d H:i:s");
      $sql= "INSERT INTO users" . " (first_name,last_name,username,email,created_at)" . " VALUES('$firstname','$lastname','$username','$email','$created')";

      mysqli_select_db($db,'users');

      $retval = mysqli_query( $db, $sql );
   
      if(! $retval ) {
        die('Could not enter data: ' . mysqli_error($db));
      }
   
      echo "Entered data successfully\n";
      header("Location: registration_success.php");
      exit;
      //mysqli_close($db);
    }
  }

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database

      // Write SQL INSERT statement
      // $sql = "";

      // For INSERT statments, $result is just true/false
      // $result = db_query($db, $sql);
      // if($result) {
      //   db_close($db);

      //   TODO redirect user to success page

      // } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
      //   echo db_error($db);
      //   db_close($db);
      //   exit;
      // }

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <form action = "<?php $_PHP_SELF?>" method="POST">
    First Name:<br>
    <input type="text" name="firstname" value="<?php echo $_POST["firstname"]; ?>"><br>
    Last Name:<br>
    <input type="text" name="lastname" value="<?php echo $_POST["lastname"]; ?>"><br>
    Email:<br>
    <input type="email" name="email" value="<?php echo $_POST["email"]; ?>"><br>
    Username:<br>
    <input type="text" name="username" value="<?php echo $_POST["username"]; ?>"><br>
    <input type="submit" value="Submit" name="submit" ><br>
  </form>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
  ?>

  <!-- TODO: HTML form goes here -->

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
