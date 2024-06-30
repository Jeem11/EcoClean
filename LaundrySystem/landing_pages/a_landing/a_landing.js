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
        const options = ["Pending", "Accepted", "Rejected"];
        
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
            cell.querySelector('.status-form').submit();
        });

        // Append select dropdown to the dropdown content
        cell.querySelector('.dropdown-content').appendChild(selectDropdown);
    });
});
