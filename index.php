<?php
$con = mysqli_connect("localhost","root","","practice") or (die("connection failed"));

$nameerror = "";
$emailerror = "";
$passerror = "";
$imageerror = "";
$success = ""; 
// print_r($_FILES['image']) ;
// print_r($_FILES['image']['name']) ;
// print_r($_FILES['image']['tmp_name']) ;

// print_r($_FILES['image']['error']) ;
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];

    if (empty($name)) {
        $nameerror = "Please Enter Your Name";
    } elseif (empty($email)) {
        $emailerror = "Please Enter Your Email";
    } elseif (empty($pass)) {
        $passerror = "Please Enter Your Password";
    }  elseif ($_FILES['image']['error'] != 0) {
        $imageerror = "Please Select Your Image";
    } else {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $exp = explode(".", $img_name);
        $ext = strtolower(end($exp));

        $allowed_ext = ["jpg", "jpeg", "png", "gif", "bmp", "tiff", "webp", "svg", "ico", "heic", "heif", "raw", "cr2", "nef", "arw", "dng", "raf", "rw2", "orw", "sr2", "svgz"];

        if (in_array($ext, $allowed_ext)){

            $new_name = $img_name.microtime().rand(1,9999999);

            $move = "./Image/" . $new_name;
            if(move_uploaded_file($tmp_name, $move)){
                
                $sql = "INSERT INTO `practice_tb`(`name`, `email`, `password`, `image`) VALUES ('$name','$email','$pass','$move')";
                $result = mysqli_query($con, $sql);

                $success = "Data submitted successfully";
                header('location: show.php');
            }
        } else{
            $imageerror = "Invalid Image";
        }

    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</head>

<body>

    <h1>Practice form</h1>

    <div class="container mt-5">

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control form-control-lg" type="text" name="name" placeholder="Enter your name" />
            <p name="nameerror">
                <?php echo $nameerror ?>
            </p>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
            <p name="emailerror">
                <?php echo $emailerror ?>
            </p>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control form-control-lg" type="password" name="password"
                placeholder="Enter your password" />
            <p name="passerror">
                <?php echo $passerror ?>
            </p>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input class="form-control form-control-lg" type="file" name="image"
                placeholder="Enter your image" />
            <p name="imageerror">
                <?php echo $imageerror ?>
            </p>
        </div>

        <div class="text-center mt-3">
            <button type="submit" name="submit" class="btn btn-lg btn-primary">Submit</button>
            <p name="success">
                <?php echo $success ?>
            </p>
        </div>

        
    </form>

    </div>

</body>

</html>