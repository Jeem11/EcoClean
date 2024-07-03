$(document).ready(function() {
    // Toggle dropdown content on button click
    $('.dropdown-btn').click(function() {
        $(this).next('.dropdown-content').toggle(); // Toggle visibility of dropdown content
    });

    // Create select element for status dropdowns
    const statusDropdowns = document.querySelectorAll('.status-cell');

    statusDropdowns.forEach(cell => {
        const statusInput = cell.querySelector('.status-input');
        const selectDropdown = document.createElement("select");
        selectDropdown.classList.add('status-dropdown');
        
        // Options for the dropdown
        const options = ["Waiting", "Under Wash", "Drying", "Folding", "Ready for Pick-up"];
        
        options.forEach(option => {
            const optionElement = document.createElement("option");
            optionElement.textContent = option;
            optionElement.value = option;
            if (option === statusInput.value) {
                optionElement.selected = true;
            }
            selectDropdown.appendChild(optionElement);
        });

        selectDropdown.addEventListener('change', function() {
            statusInput.value = this.value;
            // Submit the form using AJAX
            $.ajax({
                type: 'POST',
                url: '', // Current page URL
                data: {
                    customer_id: cell.querySelector('input[name="customer_id"]').value,
                    status: this.value
                },
                success: function(response) {
                    alert('Status updated successfully');
                },
                error: function(response) {
                    alert('Error updating status');
                }
            });
        });

        // Append select dropdown to the dropdown content
        cell.querySelector('.dropdown-content').appendChild(selectDropdown);
    });
});
