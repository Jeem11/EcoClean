document.addEventListener('DOMContentLoaded', function () {
    function fetchData() {
        var xhttp = new XMLHttpRequest();
        xhttp.open('GET', 'fetch_user.php', true);
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.querySelector('#user_container tbody').innerHTML = this.responseText;
                console.log('data successfully loaded');
            }
        };
        xhttp.send();
    }

    fetchData();

});