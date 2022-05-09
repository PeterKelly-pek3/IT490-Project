// Login Validation
function checkLoginCredentials()
{
	var loginUsernameInput = document.getElementById('username_login').value;
    	var loginPasswordInput = document.getElementById('password_login').value;

    	var loginUsername = loginUsernameInput.trim();
    	var loginPassword = loginPasswordInput.trim();

    	if (loginUsername != "" && loginPassword != "")
	{
        	sendLoginCredentials(loginUsername, loginPassword);
    	}
	else
	{
		if(loginUsername == "")
		{
			turnFieldToRedColorBorder(loginUsername);
		}
		if(loginPassword == "")
		{
			turnFieldToRedColorBorder(loginPassword);
		}
		if(loginUsername == "" && loginPassword == "")
		{
			turnFieldToRedColorBorder(loginUsername);
			turnFieldToRedColorBorder(loginPassword);
		}
	}
}

// AJAX Login Function
function sendLoginCredentials(username, password)
{
    	var httpReq = createRequestObject();
    	httpReq.onreadystatechange = function()
	{
        	if(this.readyState == 4 && this.status == 200)
		{
            		document.getElementById("loginButtonId").innerHTML = "Login";

            		if(this.responseText == true)
			{
                		window.location = "profile.php", true;
            		}
			else
			{
                		window.location = "loginRegister.html", true;
            		}
        	}
		else
		{
            		document.getElementById("loginButtonId").innerHTML = "Loading..";
        	}
    	}
    	httpReq.open("GET", "webCases.php?type=Login&username=" + username + "&password=" + password);
    	httpReq.send(null);
}

// Registration Form
function checkRegisterCredentials()
{
    	//  Registration User Input
    	var firstnameInput = document.getElementById("id_firstname").value;
    	var lastnameInput = document.getElementById("id_lastname").value;
    	var usernameInput = document.getElementById("id_username").value;
    	var emailInput = document.getElementById("id_email").value;
    	var passwordInput = document.getElementById("id_password").value;
    	var confirmPasswordInput = document.getElementById("id_confirm_password").value;

    	var firstname = firstnameInput.trim();
    	var lastname = lastnameInput.trim();
    	var username = usernameInput.trim();
    	var email = emailInput.trim();
    	var password = passwordInput.trim();
    	var confirmPassword = confirmPasswordInput.trim();

    	if (firstname != "" && lastname != "" && username != "" && email != "" && password != "" && confirmPassword != "")
	{
        	sendRegisterCredentials(firstname, lastname, username, email, password);
    	}
	else
	{
        	alert("User Input Error!");
    	}
}

// AJAX Registration Function
function sendRegisterCredentials(firstname, lastname, username, email, password)
{
    	var httpReq = createRequestObject();
    	httpReq.onreadystatechange = function()
	{
        	if(this.readyState == 4 && this.status == 200)
		{
            		document.getElementById("registerButtonId").innerHTML = "Register";

			if(this.responseText == true)
			{
                		alert("User Has Been Registered");
            		}
			else
			{
                		alert("Unable to Register New User");
            		}
        	}
		else
		{
            		document.getElementById("registerButtonId").innerHTML = "Loading..";
        	}
    	}
    	httpReq.open("GET", "webCases.php?type=RegisterNewUser&username=" + username + "&password=" + password + "&firstname=" + firstname + "&lastname=" + lastname + "&email=" + email);
    	httpReq.send(null);
}

// AJAX Function to Check if Username Already Exists
function checkForExistingUsername()
{
    	var usernameInput = document.getElementById("id_username").value;
    	var username = usernameInput.trim();

    	var httpReq = createRequestObject();
    	httpReq.onreadystatechange = function()
	{
        	if(this.readyState == 4 && this.status == 200)
		{
            		if(this.responseText == false)
			{
                		alert("Username Taken");
            		}
			else
			{
                		alert("Username Available");
            		}
        	}
    	}
    	httpReq.open("GET", "webCases.php?type=UsernameVerification&username=" + username);
    	httpReq.send(null);
}

// Function to Check if Email Already Exists
function checkForExistingEmail()
{
    	var emailInput = document.getElementById("id_email").value;
    	var email = emailInput.trim();

    	alert(email);

    	var httpReq = createRequestObject();
    	httpReq.onreadystatechange = function()
	{
        	if(this.readyState == 4 && this.status == 200)
		{
            		if(this.responseText == false)
			{
                		alert("Email Already In Use");
            		}
			else
			{
                		alert("Email is Available");
            		}
        	}
    	}
    	httpReq.open("GET", "webCases.php?type=EmailVerification&email=" + email);
    	httpReq.send(null);
}

// Create HTTP Object
function createRequestObject()
{
    	var ajaxSender;
    	try
	{
      		ajaxSender = new XMLHttpRequest();
    	}
	catch (e)
	{
      		try
		{
         		ajaxSender = new ActiveXObject("Msxml2.XMLHTTP");
      		}
		catch (e)
		{
         		try
			{
            			ajaxSender = new ActiveXObject("Microsoft.XMLHTTP");
         		}
			catch (e)
			{
            			alert("HTTP ERROR!!!!");
         		}
      		}
    	}
    	return ajaxSender;
}

// Username Session Info
function getUserName()
{
    	var returnValue = "";

    	var httpReq = createRequestObject();
    	httpReq.onreadystatechange = function()
	{
        	if(this.readyState == 4 && this.status == 200)
		{
            		returnValue = this.responseText;
        	}
    	}
    	httpReq.open("GET", "../php/getUserNameFromSession.php", false);
    	httpReq.send(null);

	return returnValue;
}

// Test API Connection Button ***Obsolete***
function testAPI()
{
	httpReq.open("GET", "webCases.php?type=TestAPI");
        httpReq.send(null);
}

// Empty Input Validation
function turnFieldToRedColorBorder(elementName)
{
	elementName.classList.add("is-invalid");
}
