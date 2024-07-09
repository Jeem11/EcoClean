document.addEventListener('DOMContentLoaded', function () {
    function fetchData() {
        var xhttp = new XMLHttpRequest();
        xhttp.open('GET', 'fetch_paid.php', true);
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.querySelector('#paid_container tbody').innerHTML = this.responseText;
            }
        };
        xhttp.send();
    }

    fetchData();

});