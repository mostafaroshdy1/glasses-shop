<?php
require_once("vendor/autoload.php");
$items = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $conn = new MainDatabase;
    if ($conn->connect()) {
        $items = $conn->get_record_by_id($_GET["id"], "id");
    }
    $conn->disconnect();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Glasses</title>
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

        img {
            max-width: 100%;
            height: auto;
        }

        h3 {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (!empty($items[0])) { ?>
            <table>
                <tr>
                    <th>Type</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td>
                        <?php echo $items[0]->product_name ?>
                    </td>
                    <td>
                        <?php echo $items[0]->list_price ?>
                    </td>
                </tr>
            </table>
            <div>
                <h3>Details</h3>
                <p>Code:
                    <?php echo $items[0]->PRODUCT_code ?>
                </p>
                <p>Item ID:
                    <?php echo $items[0]->id ?>
                </p>
                <p>Rating:
                    <?php echo $items[0]->Rating ?>
                </p>
            </div>
            <div>
                <img src="/websites/glasses-shop/phpDatabase/images/<?php echo $items[0]->Photo ?>" alt="Glasses Photo">
            </div>
        <?php } ?>
    </div>
</body>

</html>