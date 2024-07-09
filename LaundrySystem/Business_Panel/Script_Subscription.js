document.querySelectorAll('.subscribe-button').forEach(button => {
    button.addEventListener('click', function() {
        const plan = this.value;

        // Make an AJAX request to QR_payment.php
        fetch(`QR_payment.php?plan=${plan}`)
            .then(response => {
                if (response.ok) {
                    // Redirect to Payment.php with the selected plan
                    window.location.href = `Payment.php?plan=${plan}`;
                } else {
                    alert('Error generating QR code. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error generating QR code. Please try again.');
            });
    });
});
