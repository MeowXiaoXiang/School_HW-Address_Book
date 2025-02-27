document.getElementById('toggle-dark-mode').addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
    var sunIcon = document.getElementById('sun-icon');
    var moonIcon = document.getElementById('moon-icon');
    var theme;
    if (document.body.classList.contains('dark-mode')) {
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'inline';
        theme = 'dark-mode';
    } else {
        sunIcon.style.display = 'inline';
        moonIcon.style.display = 'none';
        theme = 'light-mode';
    }

    // 使用 AJAX 發送請求給目前的頁面
    var xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.pathname, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('theme=' + encodeURIComponent(theme));
});