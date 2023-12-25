<?php
session_start(); // 啟動 session

// 檢查是否有主題設定在 POST 參數中
if (isset($_POST['theme'])) {
    $_SESSION['theme'] = $_POST['theme'];
    exit();
}

// 檢查 session 中是否有主題設定
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light-mode';

$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-dark bg-dark <?php echo $theme; ?>">
    <span class="navbar-text" style="margin-left: 15px; user-select: none;">通訊錄</span>
    <div class="flex-grow-1 d-flex justify-content-center">
        <?php if ($current_page != 'index.php'): ?>
            <a class="navbar-brand" href="../index.php">首頁</a>
        <?php endif; ?>
        <?php if ($current_page != 'add.php'): ?>
            <a class="navbar-brand" href="<?php echo $current_page == 'index.php' ? 'functions/add.php' : 'add.php'; ?>">新增聯絡資料</a>
        <?php endif; ?>
        <?php if ($current_page != 'search.php'): ?>
            <a class="navbar-brand" href="<?php echo $current_page == 'index.php' ? 'functions/search.php' : 'search.php'; ?>">搜尋通訊錄</a>
        <?php endif; ?>
    </div>
    <button class="navbar-brand" id="toggle-dark-mode" style="background-color: transparent; color: white; border: none;">
        <svg id="sun-icon" style="display: <?php echo $theme == 'dark-mode' ? 'none' : 'block'; ?>" fill="none" stroke-width="2" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="hope-icon hope-c-XNyZK hope-c-PJLV hope-c-PJLV-icHSmvX-css" height="1em" width="1em" style="overflow: visible;"><circle cx="12" cy="12" r="5"></circle><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"></path></svg>
        <svg id="moon-icon" style="display: <?php echo $theme == 'dark-mode' ? 'block' : 'none'; ?>" fill="none" stroke-width="2" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="hope-icon hope-c-XNyZK hope-c-PJLV hope-c-PJLV-icHSmvX-css" height="1em" width="1em" style="overflow: visible;"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path></svg>
    </button>
</nav>