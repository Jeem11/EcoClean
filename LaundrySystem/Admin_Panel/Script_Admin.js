document.addEventListener("DOMContentLoaded", function(){
    //buttons
    var b_businessbtn = document.getElementById('b_business');
    var b_employeebtn = document.getElementById('b_employee');
    var b_userbtn = document.getElementById('b_user');

    var e_businessbtn = document.getElementById('e_business');
    var e_employeebtn = document.getElementById('e_employee');
    var e_userbtn = document.getElementById('e_user');

    var u_businessbtn = document.getElementById('u_business');
    var u_employeebtn = document.getElementById('u_employee');
    var u_userbtn = document.getElementById('u_user');

    //Request Section
    var requestLink = document.getElementById('section_requests');

    //Request Business
    var requestDivSec = document.querySelector('.request-div');
    var requestDiv = document.querySelector('.rq_business');

    //Request Employee
    var requestEmpSec = document.querySelector('.requestemp-div');
    var requestEmp = document.querySelector('.rq_employee');

    //Request User
    var requestUserSec = document.querySelector('.requestuse-div');
    var requestuser = document.querySelector('.rq_user');

    //Registered Section
    var registerLink = document.getElementById('section_registered');

    //Payment Section
    var paymentLink = document.getElementById('section_payment');


//Event Listeners
//-------------------------------------------------------------------------------


//Request

//Business btn
    b_businessbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'block';
        requestDiv.style.display = 'block';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';


    })

    b_employeebtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'block';
        requestEmp.style.display = 'block';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';
                                                                            
    })

    b_userbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'block';
        requestuser.style.display = 'block';
                                                                            
    })

//Employee btn
    e_businessbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'block';
        requestDiv.style.display = 'block';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';


    })

    e_employeebtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'block';
        requestEmp.style.display = 'block';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';
                                                                            
    })

    e_userbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'block';
        requestuser.style.display = 'block';
                                                                            
    })

//User button
    u_businessbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'block';
        requestDiv.style.display = 'block';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';


    })

    u_employeebtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'block';
        requestEmp.style.display = 'block';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';
                                                                            
    })

    u_userbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'block';
        requestuser.style.display = 'block';
                                                                            
    })


//Dashboard Links
    requestLink.addEventListener("click", function(event){
        event.preventDefault();

        requestDivSec.style.display = 'block';
        requestDiv.style.display = 'block';
        
        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';



    })

//-------------------------------------------------------------------------------


    
//Registered
    registerLink.addEventListener("click", function(event){
        event.preventDefault();

        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';
                                                                            
    })


//Subscription/Payment
    paymentLink.addEventListener("click", function(event){
        event.preventDefault();

        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';
                                                                            

    })











});