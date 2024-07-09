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

    var bb_businessbtn = document.getElementById('bb_business');
    var bb_userbtn = document.getElementById('bb_user');

    var unpaid = document.getElementById('p_unpaid');
    var paid = document.getElementById('p_paid');

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

    ///Registered Business
    var businessSec = document.querySelector('.business-div');
    var business = document.querySelector('.business');

    //Payment Section
    var paymentLink = document.getElementById('section_payment');

    //Pending Payments
    var  PendingSec = document.querySelector('.penpay-div');
    var pending = document.querySelector('.pendingpay');


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

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';


    })

    b_employeebtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'block';
        requestEmp.style.display = 'block';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';
                                                                            
    })

    b_userbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'block';
        requestuser.style.display = 'block';

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';
                                                                            
    })

//Employee btn
    e_businessbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'block';
        requestDiv.style.display = 'block';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';


    })

    e_employeebtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'block';
        requestEmp.style.display = 'block';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';
                                                                            
    })

    e_userbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'block';
        requestuser.style.display = 'block';

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';
                                                                            
    })

//User button
    u_businessbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'block';
        requestDiv.style.display = 'block';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';


    })

    u_employeebtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'block';
        requestEmp.style.display = 'block';

        requestUserSec.style.display = 'none';
        requestuser.style.display = 'none';

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';
                                                                            
    })

    u_userbtn.addEventListener("click", function(){
        requestDivSec.style.display = 'none';
        requestDiv.style.display = 'none';

        requestEmpSec.style.display = 'none';
        requestEmp.style.display = 'none';

        requestUserSec.style.display = 'block';
        requestuser.style.display = 'block';

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';
                                                                            
    })


//Registered Button

//Business Button
bb_businessbtn.addEventListener("click", function(){
    requestDivSec.style.display = 'none';
    requestDiv.style.display = 'none';

    requestEmpSec.style.display = 'none';
    requestEmp.style.display = 'none';

    requestUserSec.style.display = 'none';
    requestuser.style.display = 'none';

    businessSec.style.display = 'block';
    business.style.display = 'block';

    PendingSec.style.display = 'none';
    pending.style.display = 'none';


})

bb_userbtn.addEventListener("click", function(){
    requestDivSec.style.display = 'none';
    requestDiv.style.display = 'none';

    requestEmpSec.style.display = 'none';
    requestEmp.style.display = 'none';

    requestUserSec.style.display = 'none';
    requestuser.style.display = 'none';

    businessSec.style.display = 'none';
    business.style.display = 'none';

    PendingSec.style.display = 'none';
    pending.style.display = 'none';
                                                                        
})

//Payment Button
unpaid.addEventListener("click", function(){
    requestDivSec.style.display = 'none';
    requestDiv.style.display = 'none';

    requestEmpSec.style.display = 'none';
    requestEmp.style.display = 'none';

    requestUserSec.style.display = 'none';
    requestuser.style.display = 'none';

    businessSec.style.display = 'none';
    business.style.display = 'none';

    PendingSec.style.display = 'block';
    pending.style.display = 'block';


})

paid.addEventListener("click", function(){
    requestDivSec.style.display = 'none';
    requestDiv.style.display = 'none';

    requestEmpSec.style.display = 'none';
    requestEmp.style.display = 'none';

    requestUserSec.style.display = 'none';
    requestuser.style.display = 'none';

    businessSec.style.display = 'none';
    business.style.display = 'none';

    PendingSec.style.display = 'none';
    pending.style.display = 'none';
                                                                        
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

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';



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

        businessSec.style.display = 'block';
        business.style.display = 'block';

        PendingSec.style.display = 'none';
        pending.style.display = 'none';
                                                                            
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

        businessSec.style.display = 'none';
        business.style.display = 'none';

        PendingSec.style.display = 'block';
        pending.style.display = 'block';
                                                                            

    })











});