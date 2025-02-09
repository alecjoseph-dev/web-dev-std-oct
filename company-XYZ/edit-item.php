<?php
session_start();

require "connection.php";


$item_id = $_GET['item_id'];
$item_row = getItem($item_id);

function getItem($item_id){
    $conn = connection();
    $sql = "SELECT * FROM `items` WHERE  `id` = '$item_id'";

    if($result = $conn->query($sql)){
        return $result->fetch_assoc();
    }else{
        die("Error retrieving the item: " . $conn->error);
    }
}

function updateItem($id, $item_name, $item_price, $quantity){
    $conn = connection();
    $sql = "UPDATE `items` SET `item_name` = '$item_name', `item_price` = '$item_price', `quantity` = '$quantity' WHERE `id` = '$id'";

    if($conn->query($sql)){
        header("location: view-items.php");
        exit;
    }else{
        die("Error updating item: " . $conn->error);
    }
}

if(isset($_POST['btn_save'])){
    $id = $_GET['item_id'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $quantity = $_POST['quantity'];

    updateItem($id, $item_name, $item_price, $quantity);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Item</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include "main-nav.php";
    ?>
    <main class="card w-25 mx-auto my-5">
        <div class="card-header bg-info text-white">
            <h2 class="card-title h4 mb-0">Edit Item Details</h2>
        </div>
        <div class="card-body">
            <form method="post">
                <label for="item_name" class="form-label small">Item Name</label>
                <input type="text" name="item_name" id="item_name" class="form-control mb-2" value="<?= $item_row['item_name']?>" required autofocus>

                <label for="item_price" class="form-label small">Item Price</label>
                <div class="input-group mb-2">
                    <div class="input-group-text">$</div>
                    <input type="number" name="item_price" id="item_price" class="form-control" value="<?= $item_row['item_price']?>" required>
                </div>

                <label for="quantity" class="form-label small">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control mb-2" value="<?= $item_row['quantity']?>" required autofocus>

                <div class="row">
                    <div class="col">
                        <a href="view-items.php" class="btn btn-outline-secondary w-100">Cancel</a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-info px-5 w-100 text-white" name="btn_save">Save</button>
                    </div>
                </div>      
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>