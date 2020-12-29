<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', 'mysql', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        // pre_r($result);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) :
                ?>
                    <tr>
                        <td>
                            <?php echo $row['name']; ?></td>
                        </td>
                        <td>
                            <?php echo $row['location']; ?></td>
                        </td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php
        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>
        <div class="row justify-content-center">
            <form action="process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" value="<?php echo $location; ?>" name="location" placeholder="Enter your location">
                </div>
                <div class="form-group">
                    <?php if($update == true): 
                        ?>
                            <button class="btn btn-info" type="submit" name="update">Update</button>
                        <?php else: ?>
                    <button class="btn btn-primary" type="submit" name="save">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>