<?php
include('../includes/navbar.php');
include('../includes/db.php');

$contacts = [];
$submitted = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    $search = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT * FROM contact WHERE name LIKE '%$search%' OR tel LIKE '%$search%'";
    $result = $conn->query($sql);
    $contacts = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>通訊錄 - 搜尋聯絡資料</title>
    <link href="../vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/styles.css" rel="stylesheet">
</head>
<body class="<?php echo $theme; ?>">
    <div class="container mt-4">
        <h2 class="text-center">搜尋聯絡資料</h2>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="search.php" method="post">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">搜尋:</th>
                                <td>
                                    <input type="text" class="form-control" id="search" name="search" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">搜尋</button>
                    </div>
                </form>
            </div>
        </div>
        <?php if($submitted): ?>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <?php if(count($contacts) > 0): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">編號</th>
                                    <th scope="col">姓名</th>
                                    <th scope="col">電話</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($contacts as $contact): ?>
                                <tr>
                                    <td><?php echo $contact['id']; ?></td>
                                    <td><?php echo $contact['name']; ?></td>
                                    <td><?php echo $contact['tel']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center">找不到任何記錄</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="../vendor/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/theme.js"></script>
</body>
</html>