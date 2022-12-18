var gErrorMsg = "";

function checkFirstName()
{
	var firstNameValid = false;
	var firstName = document.getElementById("firstName").value;
	var pattern = /[a-zA-Z]*$/;
	
	
	if (!pattern.test(firstName))
	{
		gErrorMsg += "Please enter a valid first name.\n";
		firstNameValid = false;
	}
	else
	{
		if (firstName.length > 25)
		{
			gErrorMsg += "Your first name should contain less than 25 characters.\n";
			firstNameValid = false;
		}
		else
		{
			firstNameValid = true;
		}
	}
	
	if (!firstNameValid)
	{
		document.getElementById("firstName").style.borderBottom = "2px solid red";
	}
	
	return firstNameValid;
}

function checkLastName()
{
	var lastNameValid = false;
	var lastName = document.getElementById("lastName").value;
	var pattern = /[a-zA-Z]/;
	
	if (!pattern.test(lastName))
	{
		gErrorMsg += "Please enter a valid last name.\n";
		lastNameValid = false;
	}
	else
	{
		if (lastName.length > 25)
		{
			gErrorMsg += "Your last name should contain less than 25 characters.\n";
			firstNameValid = false;
		}
		else
		{
			lastNameValid = true;
		}
	}
	
	if (!lastNameValid)
	{
		document.getElementById("lastName").style.borderBottom = "2px solid red";
	}
	
	return lastNameValid;
}

function checkEmail()
{
	var emailValid = true;
	var email = document.getElementById("email").value;
	// Email needs to contain '@' between two strings with a '.' after that that follows with a one to four length string
	var pattern = /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-za-zA-Z0-9.-]{1,4}$/;
	
	if (pattern.test(email))
	{
		emailValid = true;
	}
	else
	{
		gErrorMsg += "Please enter a valid email address.\n";	
		emailValid = false;
	}
	
	if (!emailValid)
	{
		document.getElementById("email").style.borderBottom = "2px solid red";
	}
	
	return emailValid;
}	

function checkSubject()
{
	var subjectValid = true;
	var subject = document.getElementById("subject").value;
	
	if (subject == "")
	{
		gErrorMsg += "Please enter the subject of enquiry.\n";
		subjectValid = false;
	}
	else
	{
		subjectValid = true;
	}
	
	if (!subjectValid)
	{
		document.getElementById("subject").style.borderBottom = "2px solid red";
	}
	
	return subjectValid;
}

function checkStreetAddress()
{
	var stAddValid = true;
	var streetAddress = document.getElementById("streetAddress").value;
	
	if (streetAddress == "")
	{
		gErrorMsg += "Please enter your street address.\n";
		stAddValid = false;
	}
	else
	{
		if (streetAddress.length > 40)
		{
			gErrorMsg += "Your street address should contain less than 40 characters.\n";
			stAddValid = false;
		}
		else
		{
			stAddValid = true;
		}
	}
	
	if (!stAddValid)
	{
		document.getElementById("streetAddress").style.borderBottom = "2px solid red";
	}
	
	return stAddValid;
}

function checkCityTown()
{
	var cityTownValid = true;
	var cityTown = document.getElementById("cityTown").value;
	
	if (cityTown == "")
	{
		gErrorMsg += "Please enter your city/town.\n";
		cityTownValid = false;
	}
	else
	{
		if (cityTown.length > 20)
		{
			gErrorMsg += "Your city/town should contain less than 20 characters.\n";
			cityTownValid = false;
		}
		else
		{
			cityTownValid = true;
		}
	}
	
	if (!cityTownValid)
	{
		document.getElementById("cityTown").style.borderBottom = "2px solid red";
	}
	
	return cityTownValid;
}

function checkState()
{
	var stateValid = true;
	var state = document.getElementById("state").value;
	
	if (state == "none")
	{
		gErrorMsg += "Please select a state.\n";
		stateValid = false;
	}
	else
	{
		stateValid = true;
	}
	
	if (!stateValid)
	{
		document.getElementById("state").style.color = "red";
	}
	
	return stateValid;
}

function checkPostcode()
{
	var postcodeValid = true;
	var postcode = document.getElementById("postcode").value;
	var pattern = /[0-9]{5}/;
	
	if (!pattern.test(postcode))
	{
		gErrorMsg += "Please enter a valid postcode.\n";
		postcodeValid = false;
	}
	else
	{
		postcodeValid = true;
	}
	
	if (!postcodeValid)
	{
		document.getElementById("postcode").style.borderBottom = "2px solid red";
	}
	
	return postcodeValid;
}

function checkPhoneNum()
{
	var phoneNumValid = true;
	var phoneNumber = document.getElementById("phoneNumber").value;
	var pattern = /[0-9]/;
	
	if (!pattern.test(phoneNumber))
	{
		gErrorMsg += "Please enter a valid phone number.\n";
		phoneNumValid = false;
	}
	else
	{
		if (phoneNumber.length > 10)
		{
			gErrorMsg += "Please enter a valid phone number.\n";
			phoneNumValid = false;
		}
		else
		{
			phoneNumValid = true;
		}
	}
	
	if (!phoneNumValid)
	{
		document.getElementById("phoneNumber").style.borderBottom = "2px solid red";
	}
	
	return phoneNumValid;
}

function checkProduct()
{
	var product = document.getElementById("product").value;
	var productSelected = false;
	
	if (product == "none")
	{
		gErrorMsg += "Please select a product.\n";
		productSelected = false;
	}
	else
	{
		productSelected = true;
	}
	
	if (!productSelected)
	{
		document.getElementById("product").style.color = "red";
	}
	
	return productSelected;
}

function validateForm()
{
	var allValid = false;
	var firstNameValid = checkFirstName();
	var lastNameValid = checkLastName();
	var emailValid = checkEmail();
	var subjectValid = checkSubject();
	var stAddValid = checkStreetAddress();
	var cityTownValid = checkCityTown();
	var stateValid = checkState();
	var postcodeValid = checkPostcode();
	var phoneNumValid = checkPhoneNum();
	var productSelected = checkProduct();
	var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var email = document.getElementById("email").value;
	var subject = document.getElementById("subject").value;
	var stAdd = document.getElementById("streetAddress").value;
	var cityTown = document.getElementById("cityTown").value;
	var state = document.getElementById("state").value;
	var postcode = document.getElementById("postcode").value;
	var phoneNum = document.getElementById("phoneNumber").value;
	var product = document.getElementById("product").value;
	var comment = document.getElementById("comment").value;
	
	
	if (firstNameValid && lastNameValid && emailValid && subjectValid && stAddValid && cityTownValid && stateValid && phoneNumValid && productSelected)
	{
		sessionStorage.firstname = firstName;
		sessionStorage.lastname = lastName;
		sessionStorage.email = email;
		sessionStorage.subject = subject;
		sessionStorage.staddress = stAdd;
		sessionStorage.citytown = cityTown;
		sessionStorage.state = state;
		sessionStorage.postcode = postcode;
		sessionStorage.phonenum = phoneNum;
		sessionStorage.product = product;
		sessionStorage.comment = comment;
		allValid = true;
	}
	else
	{
		allValid = false;
		alert(gErrorMsg);
		gErrorMsg =  "";
	}
	
	return allValid;
}

function selectFocus(x)
{
	x.style.color = "black";
}

function inputFocus(x)
{
	x.style.borderBottom = "2px solid black";
}

function inputBlur(x)
{
	x.style.border = "none";
}

function init()
{	
	getProductName();
	
	sessionStorage.clear();
}

function subjectChange()
{
	var product = document.getElementById("product").value;
	var subject = document.getElementById("subject");
	var subjectText = "RE: Enquiry on ";
	
	if (product != "none")
	{
		subject.value = subjectText + product;
	}
}

//When the button on the navigation bar is clicked 
//The dropdown content will be shown or unshown
//When the button on the navigation bar is clicked 
//The dropdown content will be shown or unshown
/*function showProductsNav() {
  document.getElementById("prodDropdown").classList.toggle("show");
}

function showMembersNav() {
  document.getElementById("membDropdown").classList.toggle("show");
}*/

function dropNav(x)
{
	document.getElementById(x).classList.toggle("show");
}

function hide()
{
	//If the user clicks anywhere outside the navigation bar
//The dropdown content will be unshown
window.onclick = function(event) {
  if (!event.target.matches('.navButton')) {
    var dropdowns = document.getElementsByClassName("dropContent");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
        openDropdown.classList.remove('show');
    }
  }
}

}

function transferProductName(index) {
	var product = document.getElementsByClassName("productName")[index].textContent;
	
	sessionStorage.productname = product;
	
	window.location = "enquiry.php";
}

function getProductName()
{
	var subjectText = "RE: Enquiry on ";
	var subject = document.getElementById("subject");
	
	
	if (sessionStorage.productname != undefined)
	{
		subject.value = subjectText + sessionStorage.productname;
	}
}

function returnToHome()
{
	window.location = "index.php";
}
