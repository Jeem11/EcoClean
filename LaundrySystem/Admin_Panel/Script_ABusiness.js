document.addEventListener('DOMContentLoaded', function () {
    function fetchData() {
        var xhttp = new XMLHttpRequest();
        xhttp.open('GET', 'fetch_business.php', true);
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.querySelector('#business_container tbody').innerHTML = this.responseText;
                attachStatusChangeListeners(); // Attach listeners after updating the table
                attachRowClickListeners(); // Attach row click listeners
            }
        };
        xhttp.send();
    }

    fetchData();

});