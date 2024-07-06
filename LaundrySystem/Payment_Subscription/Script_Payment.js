document.addEventListener('DOMContentLoaded', function(){
    const pic = document.getElementById('F_Pay');
    const p_form = document.getElementById('payment_page');
    const sub = document.querySelector('.sub-btn');

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

    pic.addEventListener('change', function(){
        const file = this.files[0];
        const validImageTypes = ['image/jpeg', 'image/png'];
        if (validateFileType(file, validImageTypes)) {
            alert('VALID.');
        } else {
            alert('Invalid file type. Please select a JPEG or PNG image.');
        }
    })

    sub.addEventListener('click', function(){
        const payData = new FormData(p_form);

                $.ajax({
                    type: 'POST',
                    url: 'QR_payment.php',
                    data: payData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('AJAX success. Response:', response);
                        if (response.status === 'success') {
                            alert(response.message);
                            E_form.reset();
                            window.location.href = 'Subscription.php';
                            const payID = response.PayID;
                            console.log('EmpID:', payID);
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
    })


})