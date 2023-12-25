<?php
include('../includes/navbar.php');
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $tel = $conn->real_escape_string($_POST['tel']);
    $sql = "INSERT INTO contact (name, tel) VALUES ('$name', '$tel')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "錯誤: " . $conn->error;
    }
}
?>

<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>通訊錄 - 新增聯絡資料</title>
    <link href="../vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/styles.css" rel="stylesheet">
</head>
<body class="<?php echo $theme; ?>">
    <div class="container mt-4">
        <h2 class="text-center">新增聯絡人</h2>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="add.php" method="post">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">姓名:</th>
                                <td>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">電話:</th>
                                <td>
                                    <input type="text" class="form-control" id="tel" name="tel" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">新增聯絡資料</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../vendor/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/theme.js"></script>
</body>
</html>