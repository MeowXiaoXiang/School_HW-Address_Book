<?php
include('includes/navbar.php');
include('includes/db.php');

// 取得當前頁碼
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 3; // 每頁顯示數量
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

// 取得資料和總數
$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM contact LIMIT {$start}, {$perPage}";
$result = $conn->query($sql);
$contacts = $result->fetch_all(MYSQLI_ASSOC);

$totalResult = $conn->query("SELECT FOUND_ROWS() as total");
$total = $totalResult->fetch_assoc()['total'];
$pages = ceil($total / $perPage);

if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM contact WHERE id = $id";
        $conn->query($sql);
        header("Location: index.php"); // 重新導向到 contacts.php 頁面
        exit();
}
?>

<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>通訊錄 - 首頁</title>
    <link href="./vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body class="<?php echo $theme; ?>">
    <div class="container mt-4">
        <h2 class="text-center">通訊錄列表</h2>
        <p class="text-center">記錄總數: <?php echo $total; ?></p>
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">編號</th>
                        <th scope="col">姓名</th>
                        <th scope="col">電話</th>
                        <th scope="col">功能</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contacts as $contact): ?>
                    <tr>
                        <th scope="row"><?php echo $contact['id']; ?></th>
                        <td><?php echo $contact['name']; ?></td>
                        <td><?php echo $contact['tel']; ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="functions/edit.php?id=<?php echo $contact['id']; ?>">編輯</a>
                            <a class="btn btn-danger btn-sm" href="?delete=<?php echo $contact['id']; ?>">刪除</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <nav>
        <ul class="pagination justify-content-center">
            <?php if($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">&larr;</a>
                </li>
            <?php endif; ?>
            <?php for($i = 1 ; $i <= $pages; $i++): ?>
                <?php if($i == 1 || $i == $pages || ($i >= $page - 1 && $i <= $page + 1)): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php elseif($i == $page - 2 || $i == $page + 2): ?>
                    <li class="page-item">
                        <input type="number" class="form-control page-input" id="page-input-<?php echo $i; ?>" min="1" max="<?php echo $pages; ?>" style="display: none;">
                        <span class="page-link page-input-trigger" data-input="page-input-<?php echo $i; ?>">...</span>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if($page < $pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">&rarr;</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <hr></div>
    <script src="vendor/bootstrap/bootstrap.min.js"></script>
    <script src="assets/theme.js"></script>
    <script>
        document.querySelectorAll('.page-input-trigger').forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var inputId = this.dataset.input;
                document.getElementById(inputId).style.display = 'inline-block';
                this.style.display = 'none';
            });
        });

        document.querySelectorAll('.page-input').forEach(function(input) {
            input.addEventListener('change', function() {
                var page = this.value;
                if(page >= 1 && page <= <?php echo $pages; ?>) {
                    location.href = '?page=' + page;
                }
            });
        });
    </script>
</body>
</html>