document.addEventListener('DOMContentLoaded', function () {
    function fetchData() {
        var xhttp = new XMLHttpRequest();
        xhttp.open('GET', 'fetch_penpay.php', true);
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.querySelector('#penpay_container tbody').innerHTML = this.responseText;
                attachStatusChangeListeners(); // Attach listeners after updating the table
                attachRowClickListeners(); // Attach row click listeners
            }
        };
        xhttp.send();
    }

    function attachStatusChangeListeners() {
        var statusSelects = document.querySelectorAll('.status-payselect');
        console.log('Status selects found:', statusSelects.length);

        statusSelects.forEach(function(select) {
            var initialValue = select.value; // Store initial value
            console.log('Initial value:', initialValue);

            select.addEventListener('change', function(event) {
                var newValue = this.value;
                console.log('New value selected:', newValue); // Log the new value

                if (!newValue) {
                    console.error('New value is undefined');
                    return;
                }

                var rowId = this.closest('tr').getAttribute('data-row-id');
                console.log('Row ID:', rowId);

                // Customize confirmation message based on selected option
                var confirmationMessage = '';

                if (newValue === 'Approved') {
                    confirmationMessage = 'Are you sure you want to approve this business request?';
                } else if (newValue === 'Rejected') {
                    confirmationMessage = 'Are you sure you want to reject this business request? This record will be dumped.';
                } else {
                    confirmationMessage = 'Are you sure you want to change the status?';
                }

                console.log('Confirmation message:', confirmationMessage);

                // Confirm status change with the user
                var confirmed = confirm(confirmationMessage);
                if (confirmed) {
                    // Perform AJAX request to update the status
                    updateStatus(rowId, newValue, initialValue);
                } else {
                    // Revert select value if user cancels
                    this.value = initialValue;
                }
            });
        });
    }

    function updateStatus(rowId, newValue, initialValue) {
        // AJAX request to update the status
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'update_pay.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.success) {
                        console.log('Status updated successfully');
                        // If status is approved, show an additional alert about the email
                        if (newValue === 'Approved') {
                            alert('Payment Approved.');
                        }
                        // Reload the data to reflect changes
                        fetchData();
                    } else {
                        console.error('Error updating status:', response.message);
                        // Revert the select value if updating the status fails
                        var selectElement = document.querySelector('tr[data-row-id="' + rowId + '"] .status-select');
                        selectElement.value = initialValue;
                    }
                } else {
                    console.error('Error updating status:', this.status);
                    // Revert the select value if updating the status fails
                    var selectElement = document.querySelector('tr[data-row-id="' + rowId + '"] .status-select');
                    selectElement.value = initialValue;
                }
            }
        };
        xhttp.send('rowId=' + rowId + '&newValue=' + newValue);
    }
    
    

    function attachRowClickListeners() {
        $('#penpay_container').on('click', 'tr.main-row td:not(:last-child)', function(){
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