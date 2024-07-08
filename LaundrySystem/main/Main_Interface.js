document.getElementById('login-button').addEventListener('click', function() {
    var dropdown = document.getElementById('login-options');
    if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
    } else {
        dropdown.style.display = 'block';
    }
});
