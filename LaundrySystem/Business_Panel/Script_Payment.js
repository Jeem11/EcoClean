document.addEventListener('DOMContentLoaded', function() {
    const pay_pic = document.getElementById('F_Pay');
    const p_form = document.getElementById('payment_page');
    const sub = document.querySelector('.sub-btn');
    const back = document.querySelector('.back-btn');

    function validateFileSize(file, maxSizeMB) {
        const maxSizeBytes = maxSizeMB * 1024 * 1024;
        return file.size <= maxSizeBytes;
    }

    function validateFileType(file, validTypes) {
        if (!file || !file.type) {
            return false;
        }
        return validTypes.includes(file.type);
    }

    pay_pic.addEventListener('change', function() {
        const file = this.files[0];
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
        if (validateFileType(file, validImageTypes)) {
            // Valid file type
            pay_pic.classList.remove('invalid');
        } else {
            // Invalid file type
            alert('Please upload a valid image (JPEG, PNG, GIF) or PDF file.');
            pay_pic.classList.add('invalid');
            pay_pic.value = ''; // Clear the input
        }
    });

    p_form.addEventListener('submit', function(event) {
        const file = pay_pic.files[0];
        const maxSizeMB = 2; // 2 MB
        if (file && !validateFileSize(file, maxSizeMB)) {
            alert('File size exceeds 2 MB. Please upload a smaller file.');
            event.preventDefault();
        }
    });

    back.addEventListener('click', function(event) {
        window.history.back();
    });
});
