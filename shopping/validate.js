


function validate(){
    
 console.log("hi");

    $.ajax({
        url: 'cartsave.php',
        method: 'POST',
        data: {
            functionName: 'checkCookies',
            
            
        },
        
        dataType: 'json',
        
        // When http request is success

        success: function(response){
            if(response.status == "success"){
                console.log(response);
               
                addtocartRequest();
            }
            else{
                
                console.log(response);
               
                alert(" you should log first");
                backToLoging();

            }            
        },

        error: function(error){
            console.log("err");
            console.error(error);
        }
    });
}

function backToHome(){
    window.location.href = "../home.html";
}
function backToLoging(){
    window.location.href = "../login/login.html";
}
function gotocheckout1(){
    console.log("check")
    window.location.href = "Pay.php";
}



function addtocartRequest(){
    
    var quantity = document.getElementById("qut").value;

    $.ajax({
        url: 'cartsave.php',
        method: 'POST',
        data: {
            functionName: 'saveCart',
            qut: quantity ,
            
        },
        
        dataType: 'json',
        
        // When http request is success
        success: function(response){
            if(response.status == "success"){
                alert("Item added to cart");
            }
            else{
                alert("Item not added to cart");
            }            
        },

        error: function(error){
            console.error(error);
        }
    });
}