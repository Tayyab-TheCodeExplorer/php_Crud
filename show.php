<?php
$con = mysqli_connect("localhost", "root", "", "practice") or die("connection failed");






?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

            <div class="row">
                <div class="col-xl-6 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                        <a href="./index.php"  class="btn btn-primary">Add++</a>
                        </div>
                    </div>
                </div>


            </div>


            <div class="row">
                <div class="col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Latest Updates</h5>
                        </div>



                        <?php
                        $sql = "SELECT * FROM `practice_tb`";
                        $res = mysqli_query($con, $sql);
                        // print_r($result);

                        if (mysqli_num_rows($res) > 0) {

                            ?>

                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th class="d-none d-xl-table-cell">Name</th>
                                        <th class="d-none d-xl-table-cell">Email</th>
                                        <th>Password</th>
                                        <th class="d-none d-md-table-cell">Images</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($result = mysqli_fetch_assoc($res)) {

                                        ?>
                                        <tr>
                                            <td><?php echo $result['id']?></td>
                                            <td><?php echo $result['name']?></td>
                                            <td><?php echo $result['email']?></td>
                                            <td><?php echo $result['password']?></td>
                                            <td><img src="<?php echo $result['image']?>" height="50px" width="50px" alt="not found"></td>
                                            <td><?php echo $result['created_at']?></td>
                                            <td><a href="./edit.php?edid=<?php echo $result['id']?>" class="btn btn-primary">Edit</a></td>
													<td><a href="./delete.php?delid=<?php echo $result['id']?>" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                        <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo "No Data Found";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>

</html>