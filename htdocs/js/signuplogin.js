let fileName = location.href.split("/").slice(-1)[0];

if(/^signup.php.*$/.test(fileName)){
  const signupForm = document.getElementById("signup-form");
  const firstName = document.getElementById("first");
  const lastName = document.getElementById("last");
  const email = document.getElementById("email");
  const pwd = document.getElementById("pwd");
  const repeatPwd = document.getElementById("repeatPwd");
  let namePat = /^[a-zA-Z ,.'-@\/]+$/;
  let emailPat = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
  let pwdPat = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W])[A-Za-z\d\W].{7,}$/;
  signupForm.addEventListener("submit", (e) => {
    let count = 0;
//validation of the form
    if(firstName.value === "" || firstName.value === null){
      count += 1;
      errorInput(firstName, "First name cannot be empty.");
    }else if(!namePat.test(firstName.value)){
      count += 1;
      errorInput(firstName, "First name entered is invalid.");
    }else{
      successInput(firstName);
    }

    if(lastName.value === "" || lastName.value === null){
      count += 1;
      errorInput(lastName, "Last name cannot be empty.");
    }else if(!namePat.test(firstName.value)){
      count += 1;
      errorInput(lastName, "Last name entered is invalid.");
    }else{
      successInput(lastName);
    }

    if(email.value === "" || email.value === null){
      count += 1;
      errorInput(email, "E-mail cannot be empty.");
    }else if(!emailPat.test(email.value)){
      count += 1;
      errorInput(email, "E-mail entered is invalid.");
    }else{
      successInput(email);
    }

    if(pwd.value === "" || pwd.value === null){
      count += 1;
      errorInput(pwd, "Password cannot be empty.");
    }else if(!pwdPat.test(pwd.value)){
      count += 1;
      errorInput(pwd, "Password entered is invalid.");
    }else{
      successInput(pwd);
    }

    if(repeatPwd.value === "" || repeatPwd.value === null){
      count += 1;
      errorInput(repeatPwd, "Password repeat cannot be empty.");
    }else{
      if(pwd.value !== repeatPwd.value){
        count += 1;
        errorInput(repeatPwd, "Passwords do not match.");
      }else{
        successInput(repeatPwd);
      }
    }

    if(count !== 0){
      e.preventDefault();
    }

  });
}else if(/^login.php.*$/.test(fileName)){
  const loginForm = document.getElementById("login-form");
  const email = document.getElementById("email");
  const pwd = document.getElementById("pwd");

  loginForm.addEventListener("submit", (e) => {
    let count = 0;

    if(email.value === "" || email.value === null){
      count += 1;
      errorInput(email, "Email cannot be empty.");
    }else{
      successInput(email);
    }

    if(pwd.value === "" || pwd.value === null){
      count += 1;
      errorInput(pwd, "Password cannot be empty");
    }else{
      successInput(pwd);
    }

    if(count !== 0){
      e.preventDefault();
    }
  });
}

//showing error message
function errorInput(input, message){
  const parentContainer = input.parentElement;
  input.setAttribute("class", "errorInput");
  parentContainer.setAttribute("class", "text-row error");
  parentContainer.nextElementSibling.textContent = message;
  parentContainer.nextElementSibling.setAttribute("class", "errorMessage");
}

//showing success message
function successInput(input){
  const parentContainer = input.parentElement;
  input.setAttribute("class", "successInput");
  parentContainer.setAttribute("class", "text-row success");
  parentContainer.nextElementSibling.setAttribute("class", "successMessage");
}
