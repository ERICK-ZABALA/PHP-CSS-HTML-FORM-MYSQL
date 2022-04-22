
<?php
//------------VARIABLES SEARCH ----------------
$fname = "";
$lname= "";
//$male= "";
$gender="";
//$female= "";
$hobbies= "";
$departament= "";
$uname= "";
$pwd= "";
$pwd1= "";
$email= "";
$phone= "";
$message= "";

$male_status = 'unchecked';
$female_status = 'unchecked';
//--------------------------------------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resume";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


if(isset($_POST['Add']))
{
    getData();
    dataInsert();
}

if (isset($_POST ['Delete']))
{
    getDataa();
    dataDelete ();
}
if (isset($_POST ['Update']))
{
    getData();
    dataUpdate();
}

if (isset($_POST ['Find']))
{

    dataFind();
}


function getData () {
    $data = array();
    $data [0] = $_POST['fname'];
    $data [1] = $_POST ['lname'];
    $data [2] = $_POST ['gender'];
    //$data [3] = $_POST ['female'];
    $data [3] = $_POST ['hobbies'];
    $data [4] = $_POST ['departament'];
    $data [5] = $_POST ['uname'];
    $data [6] = $_POST ['pwd'];
    $data [7] = $_POST ['pwd1'];
    $data [8] = $_POST ['email'];
    $data [9] = $_POST ['phone'];
    $data [10] = $_POST ['message'];
    return $data;
}

function getDataa () {
    $data = array();

    $data [0] = $_POST ['email'];

    return $data;
}

function dataInsert() {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resume";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


$info = getData();
$sql = "INSERT INTO form (Name, Last, Gender, Hobbies, Departament, Username, Password, Password1, Email, Phone, Message) 
VALUES ('$info[0]','$info[1]', '$info[2]', '$info[3]', '$info[4]', '$info[5]', '$info[6]', '$info[7]', '$info[8]', '$info[9]', '$info[10]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

function dataDelete () {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "resume";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);


    $info = getDataa();

    $sql = "DELETE FROM form WHERE Email='$info[0]'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

}

function dataUpdate() {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resume";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


$info = getData();
$sql = "UPDATE form SET Name='$info[0]' , Last='$info[1]', Gender='$info[2]', Hobbies='$info[3]', Departament='$info[4]', 
                   Username='$info[5]', Password='$info[6]', Password1='$info[7]', Email='$info[8]', Phone='$info[9]', Message='$info[10]' WHERE Email='$info[8]'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


function dataFind(){


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "resume";

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);



    $info = getDataa();
    $search_Query = "SELECT * FROM form WHERE Email = '$info[0]'";
    echo json_encode($search_Query);

    $search_Result = mysqli_query($conn, $search_Query);
    echo json_encode($search_Result);

    $row = mysqli_fetch_assoc($search_Result);
    echo json_encode($row);
    global $fname, $lname, $gender, $hobbies, $departament, $uname, $pwd, $pwd1, $email, $phone, $message;

    $fname = $row['Name'];
    $lname = $row['Last'];
    $gender= $row['Gender'];
    $hobbies = $row['Hobbies'] ;
    $departament = $row['Departament'];
    $uname = $row['Username'];
    $pwd = $row['Password'];
    $pwd1 = $row['Password1'];
    $email = $row['Email'];
    $phone =$row['Phone'];
    $message = $row['Message'];
}




?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="main.css">
    <title>PHP INSERT UPDATE DELETE SEARCH</title>
</head>

<body>
<form action="index.php" method="post">

    <h2>Registration Form</h2><br>
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" placeholder="Name" value="<?php echo $fname;?>"><br><br>
    <label for="fname">Last Name:</label>
    <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo $lname;?>"><br><br>


    <label for="">Gender:</label>
    <input type="radio" id="male" name="gender" value="Male" <?php if ($gender == "Male") echo "checked";?>>
    <label for="male">Male</label><br><br>
    <input type="radio" id ="female" name="gender" value="Female" <?php if ($gender == "Female") echo "checked";?>>
    <label for="female">Female</label><br><br>

    <label for="hobbies">Hobbies:</label>
    <select id="hobbies" name="hobbies" value="">
        <option value="reading" <?php if ($hobbies == "reading") echo "selected";?> >Reading</option>
        <option value="singing" <?php if ($hobbies == "singing") echo "selected";?> >Singing</option>
        <option value="swiming" <?php if ($hobbies == "swiming") echo "selected";?> >Swiming</option>
        <option value="running" <?php if ($hobbies == "running") echo "selected";?>>Runnning</option>
    </select><br><br>

    <label for="departament">Departament / Office:</label>
    <select id="departament" name="departament" value="">
        <option value="none">--Select Your Departament Office--</option>
        <option value="Administration" <?php if ($departament == "Administration") echo "selected";?> >Administration</option>
        <option value="Human Resource" <?php if ($departament == "Human Resource") echo "selected";?> >Human Resource</option>
        <option value="Education" <?php if ($departament == "Education") echo "selected";?> >Education</option>
    </select><br><br>

    <label for="uname">Username:</label>
    <input type="text" id="uname" name="uname" placeholder="Username" value="<?php echo $uname;?>"><br><br>

    <label for="pwd1">Password:</label>
    <input type="password" id="pwd1" name="pwd1" placeholder="" value="<?php echo $pwd;?>"><br><br>

    <label for="pwd">Password:</label>
    <input type="password" id="pwd" name="pwd" placeholder="Confirm Password" value="<?php echo $pwd1;?>"><br><br>

    <label for="email">Enter your email:</label>
    <input type="email" id="email" name="email" placeholder="E-Mail Address" value="<?php echo $email;?>"><br><br>

    <label for="phone">Contact No:</label>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{3}" placeholder="514" value="<?php echo $phone;?>"><br><br>


    <label for="message">Additional Information.:</label>
    <textarea name="message" rows="6" cols="50" ><?php echo $message;?></textarea>
    <br><br>

    <input type="submit" value="Add" name="Add" >
    <input type="submit" value="Update" name="Update">
    <input type="submit" value="Delete" name="Delete">
    <input type="submit" value="Find" name="Find">



</form>

</body>
</html>

