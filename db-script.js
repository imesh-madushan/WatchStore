document.addEventListener('DOMContentLoaded', function(){

    var productContainer = document.getElementById('products-container');    
    var leftBarCatUl = document.getElementById('c-list');

    // Get ITEM data from php using ajax, ajax has imported in home.html as script
    $.ajax({
        url: 'main.php',
        method: 'POST',
        data: {
            functionName: 'getAllItems',
        },
        
        dataType: 'json',
        
        // When http request is success
        success: function(response){
            response.forEach(item => {
                // Get details from
                var itemId = item.Item_ID;
                var itemQty = item.Item_Qty;
                var itemCat = item.Cat_ID;
                var itemPrice = item.Item_Price;
                var itemDes = item.Item_Des;
                var imgLink = item.Img_Link;
                
                console.log("Item "+itemId+" data fetch success");
                createItems(itemId, itemQty, itemCat, itemPrice, itemDes);
            });
        },

        error: function(error){
            console.error(error);
        }
    });

    // Create ITEM and display
    function createItems(itemId, itemQty, ItemCat, itemPrice, itemDes){
        
        try{
            var itemDiv = document.createElement('div');
            itemDiv.className = 'item';
            itemDiv.id = itemId;

            var containerDiv = document.createElement('div');
            containerDiv.className = 'container';
            

            var imageDiv = document.createElement('div');
            imageDiv.className = 'image';

            var image = document.createElement('img');
            image.src = 'products/I001.jpg';


            var textDiv = document.createElement('div');
            textDiv.className = 'text';

            var paraP = document.createElement('p');
            paraP.textContent = itemDes;

            var priceH2 = document.createElement('h2');
            priceH2.textContent = itemPrice + ' LKR';

            //Adding children divs'
            imageDiv.appendChild(image);
            textDiv.appendChild(paraP);
            textDiv.appendChild(priceH2);
            containerDiv.appendChild(imageDiv);
            containerDiv.appendChild(textDiv);
            itemDiv.appendChild(containerDiv);

            //Finally add created item to display in 'products-container'
            productContainer.appendChild(itemDiv);
            console.log("items "+itemId+" created success");


        }

        catch(error){
            console.log("Error craeting items", error);
        }        
    }


    // Get CATEGORY data from php
    $.ajax({
        url: 'main.php',
        method: 'POST',
        data: {
            functionName: 'getCategoryList',
        },
        success: function(response){
            response.forEach(cat => {
                var catId = cat.Cat_ID;
                var catName = cat.Cat_Name;

                updateLeftBar(catId, catName);
            });
        },

        error: function(error){
            console.log(error);
        }
    });

    // Update left-bar CATEGORY list
    function updateLeftBar(catId, catName){
        var input = document.createElement('input');
        var li = document.createElement('li');

        input.type = 'checkbox';
        input.name = 'cat';
        input.id = catId;
        input.value = catName;

        li.appendChild(input);

        var textNode = document.createTextNode(catName);
        li.appendChild(textNode);

        leftBarCatUl.appendChild(li);

    }
    

    
    // When a checkbox checked from above genarated checkboxList,
    leftBarCatUl.addEventListener('click', function checkboxClick(event) { //Listening for category checkboxes
        if (event.target.type === 'checkbox' && event.target.checked) {
            var checkboxID = event.target.id;
            console.log(checkboxID);
        }
    });
    

    
})

