    <?php
    $conn = mysqli_connect("localhost","root","","grocgo");
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border = 1 cellspacing = 0 cellpadding = 10>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Image</td>
            <td>#</td>
            <td>Name</td>
            <td>Image</td>
        </tr>
            <?php
            $i = 1;
            $rows = mysqli_query($conn," SELECT * FROM products ORDER BY product_id DESC");
            ?>

            <?php foreach($rows as $row): ?>

            <tr>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['price']?></td>
                <td><img src="img/<?php echo $row['image']?>" alt="" width="100px" height="100px"></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['availability']?></td>
                <td>
                <a href="update" class="btn-update">Update</a>
                <a href="delete" class="btn-delete">Delete</a>
                </td>
            </tr>

            <?php endforeach; ?>
    </table>
</body>
</html>