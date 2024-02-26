document.addEventListener('DOMContentLoaded', function(){

    var btnCheckout = document.getElementById("btn-checkout");
    btnCheckout.addEventListener('click', function(event){
        event.preventDefault();
        removeCart();
    });

    // var btnAddToCart = document.getElementById("btnAddToCart");
    // btnAddToCart.addEventListener('click', function(){
    //     addtocartRequest();
    // });

});

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
            functionName: 'remove',
            id: id ,
            
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