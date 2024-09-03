document.addEventListener('DOMContentLoaded', function () {
    var productContainer = document.getElementById('products-container');
    var leftBarCatUl = document.getElementById('c-list');
    var leftBarPriceUl = document.getElementById('p-list');
    var currentDisplayItems = {};

    var allItemsNeverCreated = true;
    var itemCreatedSuccess = false;
    loadItemsRequest('none', 'none');

    // Filter Items using Category, or Price
    function loadItemsRequest(category, price) { // called from leftBarCatUl.addEventListener()
        $.ajax({
            url: 'main.php',
            method: 'POST',
            data: {
                functionName: 'loadItems',
                category: category,
                price: price
            },

            dataType: 'json',

            // When http request is success
            success: function (response) {
                currentDisplayItems = response; //not used
                console.log(response);
                response.forEach(item => {
                    // Get details from
                    var itemId = item.Item_ID;
                    var itemName = item.Item_Name;
                    var itemQty = item.Item_Qty;
                    var itemCat = item.Cat_ID;
                    var itemPrice = item.Item_Price;

                    createItems(itemId, itemQty, itemCat, itemPrice, itemName);
                });

                if (allItemsNeverCreated == true) {
                    createCatListRequest();
                }

                allItemsNeverCreated = false;
                console.log("Item Data fetch success");
            },

            error: function (error) {
                console.error(error);
            }
        });
    }


    // Create ITEM and display
    function createItems(itemId, itemQty, ItemCat, itemPrice, itemName) {
        try {
            var itemDiv = document.createElement('div');
            itemDiv.className = 'item ' + ItemCat + ' ' + itemPrice;
            itemDiv.id = itemId;

            var containerDiv = document.createElement('div');
            containerDiv.className = 'container';


            var imageDiv = document.createElement('div');
            imageDiv.className = 'image';

            var image = document.createElement('img');
            image.src = 'products/' + itemId + '.jpg';
            image.alt = itemId + 'watch image';

            var textDiv = document.createElement('div');
            textDiv.className = 'text';

            var paraP = document.createElement('p');
            paraP.textContent = itemName;

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
            // console.log("items "+itemId+" created success");
        }

        catch (error) {
            console.log("Error craeting items", error);
        }
    }


    // Get CATEGORY data from php to update left-bar ul
    // Only will be executed after all Items were created
    function createCatListRequest() { // called within the createItemsRequest()
        $.ajax({
            url: 'main.php',
            method: 'POST',
            data: {
                functionName: 'getCategoryList',
                filterMethod: 'default',
            },
            success: function (response) {
                response.forEach(cat => {
                    var catId = cat.Cat_ID;
                    var catName = cat.Cat_Name;

                    updateLeftBar(catId, catName);
                });
            },

            error: function (error) {
                console.log(error);
            }
        });
    }
    // Update left-bar CATEGORY list
    function updateLeftBar(catId, catName) {
        var input = document.createElement('input');
        var li = document.createElement('li');

        input.type = 'checkbox';
        input.className = 'cat-checkbox';
        input.id = catId;
        input.value = catName;

        li.appendChild(input);

        var textNode = document.createTextNode(catName);
        li.appendChild(textNode);

        leftBarCatUl.appendChild(li);
    }


    // When a checkbox is checked that genarated,
    // Filter Items using CATEGORY 
    leftBarCatUl.addEventListener('click', function (event) { //Listening for every area in that ul
        if (event.target.type === 'checkbox') { // if checkbox clicked

            var priceCheckBoxes = Array.from(document.getElementsByClassName('price-radio')); // Uncheck proce radio buttons
            priceCheckBoxes.forEach(radio => {
                if (radio.checked) {
                    radio.checked = false;
                }
            });

            var atleastOneChecked = false;
            var catListCheckboxes = [...document.getElementsByClassName('cat-checkbox')]; // Another method of declaring array

            var prdcon = document.getElementById('products-container');
            var its = Array.from(prdcon.getElementsByClassName('item')); // Another method of declaring array
            its.forEach(item => {
                prdcon.removeChild(item); // Removing all items that currently diplaying
            });

            catListCheckboxes.forEach(checkbox => { // Create items for each checked CATEGORY
                if (checkbox.checked) {
                    var catItems = [...document.getElementsByClassName(checkbox.id)];
                    loadItemsRequest(checkbox.id, 'none');
                    atleastOneChecked = true;
                }
            });

            if (atleastOneChecked == false) { // If all checkboxs was unchecked again,
                console.log("No category selected ");
                loadItemsRequest('none', 'none');
            }
        }
    });



    // Filter Items using price list
    leftBarPriceUl.addEventListener('click', function (event) {
        if (event.target.type === 'radio') {
            var selectedRadioValue = event.target.value;
            atleastOneChecked = false;

            var prdcon = document.getElementById('products-container');
            var its = Array.from(prdcon.getElementsByClassName('item'));
            its.forEach(item => {
                // console.log('removedddd '+parseInt(item.classList[2]));
                prdcon.removeChild(item); // Removing all items that currently diplaying
            });

            var catListCheckboxes = Array.from(document.getElementsByClassName('cat-checkbox'));
            catListCheckboxes.forEach(checkbox => { // Create items for each checked CATEGORY
                if (checkbox.checked) {
                    var catItems = [...document.getElementsByClassName(checkbox.id)];
                    console.log("chekbox in pircelist filter is " + parseInt(event.target.value));

                    loadItemsRequest(checkbox.id, parseInt(event.target.value));
                    atleastOneChecked = true;
                }
            });
            if (atleastOneChecked == false) { // If all checkboxs was unchecked again,
                console.log("No category selected ");
                loadItemsRequest('none', event.target.value);
            }
        }
    });



    // Event listener to listen every click ON creatd items and CREATE SESSION
    productContainer.addEventListener('click', function (event) {
        var clickedElement = event.target;
        if (clickedElement.closest('.container')) { //
            var itemContainer = clickedElement.closest('.container');
            var clickedItemId = itemContainer.parentElement.id;
            console.log("clicked item id is " + clickedItemId);

            $.ajax({ // request to create new session to send sleceted item id
                url: 'main.php',
                method: 'POST',
                data: {
                    functionName: 'createSession',
                    itemId: clickedItemId
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status == "success") {
                        console.log(response);
                        window.location.href = "shopping/Single.php"; // Redirect to single.php
                    }
                    else {
                        console.log(response + 'failed to create session');
                    }
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }
    });











})
