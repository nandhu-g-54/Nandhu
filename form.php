<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
</head>
<body>

<?php
// Define variables and set to empty values
$name = $age = $gender = $address = $phone = "";
$nameErr = $ageErr = $genderErr = $addressErr = $phoneErr = "";

// Form submission and validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and spaces allowed";
        }
    }

    // Validate age
    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
    } else {
        $age = test_input($_POST["age"]);
        if (!filter_var($age, FILTER_VALIDATE_INT)) {
            $ageErr = "Invalid age format";
        }
    }

    // Validate gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // Validate address
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    // Validate phone number
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneErr = "Invalid phone number format";
        }
    }

    // If no errors, print input
    if (empty($nameErr) && empty($ageErr) && empty($genderErr) && empty($addressErr) && empty($phoneErr)) {
        echo "<h3>Your Input:</h3>";
        echo "Name: $name<br>";
        echo "Age: $age<br>";
        echo "Gender: $gender<br>";
        echo "Address: $address<br>";
        echo "Phone: $phone<br>";
    }
}

// Function to sanitize input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name" value="<?php echo $name;?>">
    <span style="color:red;">* <?php echo $nameErr;?></span>
    <br><br>
    Age: <input type="text" name="age" value="<?php echo $age;?>">
    <span style="color:red;">* <?php echo $ageErr;?></span>
    <br><br>
    Gender:
    <input type="radio" name="gender" value="Male" <?php if (isset($gender) && $gender=="Male") echo "checked";?>> Male
    <input type="radio" name="gender" value="Female" <?php if (isset($gender) && $gender=="Female") echo "checked";?>> Female
    <span style="color:red;">* <?php echo $genderErr;?></span>
    <br><br>
    Address: <textarea name="address"><?php echo $address;?></textarea>
    <span style="color:red;">* <?php echo $addressErr;?></span>
    <br><br>
    Phone: <input type="text" name="phone" value="<?php echo $phone;?>">
    <span style="color:red;">* <?php echo $phoneErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
