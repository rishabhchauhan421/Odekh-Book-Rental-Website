//Password Validation
function checkPass()
{
    //Store the password field objects into variables ...
    var password = document.getElementById('password');
    var confirm_password = document.getElementById('confirm_password');
    
	//Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(password.value == confirm_password.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        confirm_password.style.backgroundColor = goodColor;
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        confirm_password.style.backgroundColor = badColor;
    }
	ButtonSubmit();
} 

// validate email
function email_validate(email)
{
var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

    if(regMail.test(email) == false){
		document.getElementById("email_error").innerHTML    = "<span class='warning'>Email address is not valid yet.</span>";
    }
    else{
		//Email is working good
		document.getElementById("email_error").innerHTML    = "";
	}
	ButtonSubmit();
}

// validates text only
function Validate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r.]+/g, '');
	ButtonSubmit();
}

//Activate Submit Button
function ButtonSubmit(){
	
	var firstname = document.getElementById('firstname');
	var lastname = document.getElementById('lastname');
	var email = document.getElementById('email');
	var password = document.getElementById('password');
    var confirm_password = document.getElementById('confirm_password');

	var registerButton=document.getElementById('register');
	
	if(($("#firstname").val().length>0)&&$($("#lastname").val().length>0)&&($("#password").val().length>0)&&($("#password").val()==$("#confirm_password").val())&&($("#email").val().length>0)){
		registerButton.disabled=false;
	}else{
		registerButton.disabled=true;
	}
}