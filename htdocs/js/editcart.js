//load the js script every time the ajax request is sent
function load_js()
{
  var head = document.getElementsByTagName('head')[0];
  head.removeChild(document.getElementsByTagName('SCRIPT')[0]);
  var script= document.createElement('script');
  script.src= 'js/editcart.js';
  head.appendChild(script);
}

//get all forms with .addcart class to a nodelist
var formsNodeList = document.querySelectorAll(".remove-form, .edit-cart-form, .cus-qty-form");
//loop through each element in the nodelist and add event listener
var formsArray = Array.from(formsNodeList);
formsArray.forEach(function(form){
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    let inputs = form.querySelectorAll("input");
    let productId = inputs[0].value;
    let params;
    //To check the source of the quantity
    if(form.className == "cus-qty-form"){
      let cusQuantity = inputs[1].value;
      params = 'productId='+productId+'&cus-quantity='+cusQuantity;
    }else{
      let quantity = inputs[1].value;
      params = 'productId='+productId+'&quantity='+quantity;
    }

    //create a XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    //send the ajax request to the php file
    xhr.open("POST", "includes/addcart.inc.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //The codes below will executed after getting response from the server, state = 4
    xhr.onload = function(){
      let responseText = JSON.parse(this.responseText);
      console.log(responseText[0]);
      if(responseText[0] === "error=addcart"){
        window.location.replace("cart.php?"+responseText);
      }else if(responseText[0] === "error=sqlerror"){
        window.location.replace("cart.php?"+responseText);
      }else{
        let subTotal = document.getElementById("subtotal");
        let tBody = document.getElementById("tbody");
        let html = "";
        let total = 0;
        //refresh the cart table
        if(responseText.length > 1){
          for(let i = 1; i < responseText.length; i++){
            total += responseText[i].totPrice;

            html += '<tr>';
            html +=   '<td>';
            html +=     '<div class="product-data">';
            html +=       '<img src="'+responseText[i].product_image+'">';
            html +=       '<div>'+responseText[i].product_name;
            html +=         '<form class="remove-form" method="POST">';
            html +=           '<input type="hidden" name="productId" value="'+responseText[i].product_id+'">';
            html +=           '<input type="hidden" name="quantity" value="0">';
            html +=           '<button class="remove" name="addcart-submit">Remove</button>';
            html +=         '</form>';
            html +=       '</div>';
            html +=     '</div>';
            html +=   '</td>';
            html +=   '<td class="price-data"<div>'+responseText[i].price+'</div></td>';
            html +=   '<td class="quantity-data">';
            html +=     '<form method="POST" class="edit-cart-form">';
            html +=       '<input type="hidden" name="productId" value="'+responseText[i].product_id+'">';
            html +=       '<input type="hidden" name="quantity" value="-1">';
            html +=       '<button class="edit-cart" name="addcart-submit">-</button>';
            html +=     '</form>';
            html +=     '<form method="POST" class="cus-qty-form">';
            html +=       '<input type="hidden" name="productId" value="'+responseText[i].product_id+'">';
            html +=       '<input type="text" name="cus-quantity" value="'+responseText[i].quantity+'"maxlength="2">';
            html +=       '<button class="invisible" name="addcart-submit"></button>';
            html +=     '</form>';
            html +=     '<form method="POST" class="edit-cart-form">';
            html +=       '<input type="hidden" name="productId" value="'+responseText[i].product_id+'">';
            html +=       '<input type="hidden" name="quantity" value="1">';
            html +=       '<button class="edit-cart" name="addcart-submit">+</button>';
            html +=     '</form>';
            html +=   '</td>';
            html +=   '<td class="total-data"><span>RM '+responseText[i].totPrice+'</div></td>';
            html += '</tr>';
          }
        }
        tbody.innerHTML = html;
        subTotal.textContent = "Subtotal: RM " + total;
        load_js();
      }
    }
    //send data to the php file
    xhr.send(params);
  },true);
});
