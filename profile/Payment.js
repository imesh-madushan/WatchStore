function RequestAddDeliveryInfor(){
   
    var billingAddress = document.getElementById("txtBillingAddress").value;
    var contactNumberForDelivery = document.getElementById("txtContactNoForDelivery").value;
    var cardNumber = document.getElementById("txtCardNumber").value;
    var cardType = document.getElementById("CardType").value;
    var cardHolderName = document.getElementById("txtCardHolderName").value;
    var expiryDate = document.getElementById("txtExpiryDate").value;
    var cvv = document.getElementById("txtCVV").value;
    var isCardSaved = document.getElementById("SaveCard").checked;

    $a.ajax({
        url:'Profile.php',
        methode:'POST',
        data:{
            functionName:'addDeliveryInfor',
            billingAddress: billingAddress,
        contactNumberForDelivery: contactNumberForDelivery,
        cardNumber: cardNumber,
        cardType: cardType,
        cardHolderName: cardHolderName,
        expiryDate: expiryDate,
        cvv: cvv,
    
        },
        dataType:'json',
    
        success:function(response){
        if(response.status=="success"){
            console.log("saved")
            alert("Your Datails are Saved");
        }
        else{
            alert("Can't Save Your Details");
        }
    },
    
        error:function(error){
            console.error(error);
        }
    });
    
    
    }