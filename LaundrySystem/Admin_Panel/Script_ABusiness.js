document.addEventListener('DOMContentLoaded', function () {
    function fetchData() {
        var xhttp = new XMLHttpRequest();
        xhttp.open('GET', 'fetch_business.php', true);
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.querySelector('#business_container tbody').innerHTML = this.responseText;
                attachRowClickListeners(); // Attach row click listeners
            }
        };
        xhttp.send();
    }

    function attachRowClickListeners() {
        $('#business_container').on('click', 'tr.main-row td:not(:last-child)', function(){
            var mainRow = $(this).closest('tr');
            var hiddenRow = mainRow.next('.hidden-row');
            hiddenRow.addClass('hiddenrow');
            hiddenRow.slideToggle(function() {
                if (hiddenRow.is(':visible')) {
                    mainRow.addClass('expanded');
                } else {
                    mainRow.removeClass('expanded');
                }
            });
        });
    }

    fetchData();

});