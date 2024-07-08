document.addEventListener("DOMContentLoaded", function(){
    //buttons
    var businessbtn = document.getElementById('business');
    var employeebtn = document.getElementById('employee');
    var userbtn = document.getElementById('user');

    //Request Section
    var requestLink = document.getElementById('section_requests');

    //Request Business
    var requestDivSec = document.querySelector('.request-div');
    var requestDiv = document.querySelector('.rq_business');

    //Registered Section
    var registerLink = document.getElementById('section_registered');

    //Payment Section
    var paymentLink = document.getElementById('section_payment');


//Event Listeners
//-------------------------------------------------------------------------------


//Request
    requestLink.addEventListener("click", function(event){
        event.preventDefault();

        requestDivSec.style.display = 'block';
        requestDiv.style.display = 'block';
        



    })

    businessbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'block';
        requestDiv.style.display = 'block';


    })

    employeebtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';
                                                                            
    })

    userbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';
                                                                            
    })


//-------------------------------------------------------------------------------


    
//Registered
    registerLink.addEventListener("click", function(event){
        event.preventDefault();

        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';
                                                                            
    })


//Subscription/Payment
    section_payment.addEventListener("click", function(event){
        event.preventDefault();

        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';
                                                                            

    })











});