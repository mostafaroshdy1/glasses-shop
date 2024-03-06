<?php
session_start();
require_once("vendor/autoload.php");
$items = "";
$fields = "";
$page = 0;

$conn = new MainDatabase;

if (!isset($_SESSION["page"]))
    $_SESSION["page"] = 0;

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["prev"]) || isset($_POST["next"]))) {
    $conn->connect();
    if (isset($_POST["prev"]))
        $_SESSION["page"] > 0 ? $_SESSION["page"] -= 5 : 0;
    else if (isset($_POST["next"]))
        if ($conn->get_count_items() - 5 > $_SESSION["page"])
            $_SESSION["page"] += 5;
    $conn->disconnect();
}

if ($conn->connect()) {
    $fields = array("id", "product_name");
    $items = $conn->get_data($fields, $_SESSION["page"]);
}

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["key_search"]))) {
    $column_name = $_POST["key_search"];
    $value = $_POST["search"];
    $items = $conn->search_by_column($column_name, $value);
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
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .button {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .search-container {
            margin-bottom: 10px;
        }

        .search-container input[type=text],
        select {
            padding: 10px;
            margin-top: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .search-container button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #04AA6D;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .btns {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="search-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" placeholder="Search.." name="search">
                <select name="key_search" id="key_search">
                    <?php
                    foreach ($fields as $field) {
                        ?>
                        <option value="<?php echo $field ?>">
                            <?php echo $field ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <button type="submit" class="button">Search</button>
            </form>
            <a class="button" style="float: right;" href=<?php echo "addItems.php" ?>>Add</a>
        </div>
        <table>
            <tr>
                <?php
                foreach ($fields as $field) {
                    ?>
                    <th>
                        <?php echo $field; ?>
                    </th>
                    <?php
                }
                ?>
                <th>More</th>
            </tr>
            <?php
            foreach ($items as $item) {
                ?>
                <tr>
                    <?php
                    foreach ($fields as $field) {
                        ?>
                        <td>
                            <?php echo $item->$field; ?>
                        </td>
                    <?php } ?>
                    <td style="text-align: center;">
                        <a class="button" href=<?php echo "getGlasses.php/?id=" . $item->id ?>>More</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div class="btns">
            <form action="" method="POST">
                <button name="prev" class="button">Prev</button>
                <button name="next" class="button">Next</button>
            </form>
        </div>
    </div>
</body>

</html>