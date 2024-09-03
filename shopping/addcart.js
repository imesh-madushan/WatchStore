// document.addEventListener('DOMContentLoaded', function(){

    // if (window.location.pathname === 'Cart.php') {
    //     var btnBack = document.getElementById("btnBack");
    //     btnBack.addEventListener('click', function(){
    //         window.location.href = "../home.html";
    //     });
    // }

// });



function backToHome(){
    window.location.href = "../home.html";
}
function gotocheckout(){
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



//remove item from cart

function removeCartRequest(){
    var id = document.getElementById("remove").value;
    console.log(id);
    

    $.ajax({
        url: 'cartsave.php',
        method: 'POST',
        data: {
            functionName: 'removeCart',
            id: id ,
            
        },
        
        dataType: 'json',
        
        // When http request is success
        success: function(response){
            console.log(response);
            // refresh the page
            alert("Item removed from cart");
            location.reload();
        },

        error: function(error){
            console.error(error);
        }
    });
}



//remove all items from cart

function removeCart(){
    
    $.ajax({
        url: 'cartsave.php',
        method: 'POST',
        data: {
            functionName: 'cardCheckout',            
        },
        
        dataType: 'json',
        
        // When http request is success
        success: function(response){
            console.log(response);
            alert("Checkout successful\n Thank You for shopping with us!");
            location.reload();
            window.location.href = "../home.html";
        },

        error: function(error){
            console.error(error);
        }
    });
}

function updateCartRequest(){
    var id = document.getElementById("update").value;
    var quantity = document.getElementById("qut").value;
    console.log(id);
    console.log(quantity);

    $.ajax({
        url: 'cartsave.php',
        method: 'POST',
        data: {
            functionName: 'updateCart',
            id: id ,
            qut: quantity ,
            
        },
        
        dataType: 'json',
        
        // When http request is success
        success: function(response){
            console.log(response);
           
        },

        error: function(error){
            console.error(error);
        }
    });
}

function checkout(){
    console.log("checkout");
    $.ajax({
        url: 'cartsave.php',
        method: 'POST',
        data: {
            functionName: 'checkout',
            
        },
        
        dataType: 'json',
        
        // When http request is success
        success: function(response){
            console.log(response);
           
        },

        error: function(error){
            console.error(error);
        }
    });
}