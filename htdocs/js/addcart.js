// get the file name of the current file
let fileName = location.href.split("/").slice(-1)[0];
//get all forms with .addcart class to a nodelist
let formsArray = document.querySelectorAll(".addcart");
//loop through each element in the nodelist and add event listener
formsArray.forEach(function(form){
  form.addEventListener("submit", (e) => {
    //Codes below will be executed when the form is submitted
    //This prevent the data to directly send to php file
    e.preventDefault();
    //Variable below is used for the animation when user add item to cart
    let intervalId = 0;
    //get all input text fields inside the form to a nodelist
    let inputs = form.querySelectorAll("input");
    let productId = inputs[0].value;
    let quantity = inputs[1].value;
    //writing the parameter to be sent to the php file
    let params = "productId="+productId+"&quantity="+quantity;

    //create a XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    //to check the file
    if(/^(.*cat.php.*)?(.*dog.php.*)?$/.test(fileName)){
      //send the ajax request to the php file
      xhr.open("POST", "../includes/addcart.inc.php", true);
    }else{
      xhr.open("POST", "includes/addcart.inc.php", true);
    }

    //transfer file using POST method
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //The codes below will executed after getting response from the server, state = 4
    xhr.onload = function(){
      let responseText = JSON.parse(this.responseText);
      //print the first message, it will either a error message or a successful message
      console.log(responseText[0]);
      //if there is error, the browser will redirect there to correct webpage
      if(responseText[0] === "error=login"){
        window.location.replace("login.php?"+responseText);
      }else if(responseText[0] === "error=addcart"){
        window.location.replace("index.php?"+responseText);
      }else if(responseText[0] === "error=sqlerror"){
        window.location.replace("index.php?"+responseText);
      }else{
        fadeIn();
      }
    }

    //send data to the php file
    xhr.send(params);
  },true);
});

//show the div
function show(){
  let div = document.querySelector(".notification");
  let opacity = Number(window.getComputedStyle(div).getPropertyValue("opacity"));
  if(opacity<0.9){
    opacity += 0.1;
    div.style.opacity = opacity;
  }else{
    clearInterval(intervalId);
  }
}

//hide the div after showing
function hide(){
  let div = document.querySelector(".notification");
  let opacity = Number(window.getComputedStyle(div).getPropertyValue("opacity"));
  if(opacity>0){
    opacity -= 0.1;
    div.style.opacity = opacity;
  }else{
    clearInterval(intervalId);
    div.style.display = "none";
  }
}

//function that triggers animation
function fadeIn(){
  let div = document.querySelector(".notification");
  div.style.display = "flex";
  intervalId = setInterval(show, 10);
  setTimeout(function(){
    intervalId = setInterval(hide, 10);
  }, 1000);
}
