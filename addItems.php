<?php
require_once("vendor/autoload.php");
$table_columns_items = array();
$conn = new MainDatabase;
if ($conn->connect()) {
    $table_columns_items = (new Items())->getTableColumns();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $item = new Items();
    $res_upload_img = upload_image("Photo");
    echo $res_upload_img;
    if (!empty($res_upload_img)) {
        foreach ($table_columns_items as $new_item) {
            if ($new_item == "Photo") {
                $item->$new_item = $res_upload_img;
            } else {
                $item->$new_item = $_POST["$new_item"];
            }
        }
        $item->save();
    }
}

function upload_image($name_column)
{
    $file_name = "";
    $target_dir = "phpDatabase/images/";
    $target_file = $target_dir . basename($_FILES[$name_column]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($_FILES[$name_column]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES[$name_column]["tmp_name"], $target_file)) {
            $file_name = htmlspecialchars(basename($_FILES[$name_column]["name"]));
            echo "The file " . $file_name . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return $file_name;
}

$conn->disconnect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Glasses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"] {
            width: calc(100% - 12px);
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #058e5f;
        }

        .error {
            color: #ff0000;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Shop Glasses</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <?php foreach ($table_columns_items as $item): ?>
                <?php if ($item != "Photo" && $item != "date"): ?>
                    <div>
                        <label for="<?php echo $item ?>">
                            <?php echo ucfirst($item) ?>
                        </label>
                        <input type="text" name="<?php echo $item ?>" id="<?php echo $item ?>">
                    </div>
                <?php elseif ($item == "date"): ?>
                    <div>
                        <label for="<?php echo $item ?>">
                            <?php echo ucfirst($item) ?>
                        </label>
                        <input type="date" name="<?php echo $item ?>" id="<?php echo $item ?>">
                    </div>
                <?php else: ?>
                    <div>
                        <label for="<?php echo $item ?>">
                            <?php echo ucfirst($item) ?>
                        </label>
                        <input type="file" name="<?php echo $item ?>" id="<?php echo $item ?>">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>
</body>

</html>