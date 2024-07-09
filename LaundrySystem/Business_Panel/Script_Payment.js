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
            pay_pic.classList.remove('invalid-input');
        } else {
            // Invalid file type
            pay_pic.classList.add('invalid-input');
            alert('Invalid file type. Please select a JPEG, PNG, GIF, or PDF file.');
        }
    });

    back.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = 'Subscription.php';
    });

    sub.addEventListener('click', function(event) {
        event.preventDefault();
        let valid = false;
        if (!pay_pic.files || pay_pic.files.length === 0) {
            pay_pic.classList.add('invalid-input');
            alert('Please upload proof of payment.');
        } else {
            const file = pay_pic.files[0];
            if (!validateFileSize(file, 5)) {
                pay_pic.classList.add('invalid-input');
                alert('Please upload an image file that is less than 5MB.');
            } else if (!validateFileType(file, ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'])) {
                pay_pic.classList.add('invalid-input');
                alert('Please upload an image file of type: JPEG, PNG, GIF, or PDF.');
            } else {
                pay_pic.classList.remove('invalid-input');
                valid = true;
            }
        }

        if (valid) {
            const payData = new FormData(p_form); // Use the form element to construct FormData

            $.ajax({
                type: 'POST',
                url: 'payment_process.php',
                data: payData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('AJAX success. Response:', response);
                    if (response.status === 'success') {
                        alert(response.message);
                        p_form.reset();
                        window.location.href = 'ologin.php';
                        const payID = response.PayID;
                        console.log('PayID:', payID);
                    } else {
                        alert(response.message);
                        console.error('Server returned error status:', response.status);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error. Status:', textStatus, 'Error:', errorThrown);
                    alert('An error occurred while processing your request.');
                }
            });
        }
    });
});
