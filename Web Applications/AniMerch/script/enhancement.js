// getEnquiry and cancelEnquiry are for preview page (confirm.html)
function getEnquiry()
{
	if (sessionStorage.firstname != undefined)
	{
		document.getElementById("confirm_fname").textContent = sessionStorage.firstname;
		document.getElementById("confirm_lname").textContent = sessionStorage.lastname;
		document.getElementById("confirm_email").textContent = sessionStorage.email;
		document.getElementById("confirm_subject").textContent = sessionStorage.subject;
		document.getElementById("confirm_stAdd").textContent = sessionStorage.staddress;
		document.getElementById("confirm_cityTown").textContent = sessionStorage.citytown;
		document.getElementById("confirm_state").textContent = sessionStorage.state;
		document.getElementById("confirm_postcode").textContent = sessionStorage.postcode;
		document.getElementById("confirm_phoneNum").textContent = sessionStorage.phonenum;
		document.getElementById("confirm_product").textContent = sessionStorage.product;
		document.getElementById("confirm_comment").textContent = sessionStorage.comment;
	}
	else
	{	
		window.location = "enquiry.php";
	}
}

function cancelEnquiry()
{
	window.location = "enquiry.php";
}

//Below here are the functions that allow for the enhancement
//To highlight the current page on the navigation bar
function extractPageName(hrefString)
{
	var arr = hrefString.split('/');
	
	return  (arr.length<2) ? hrefString : arr[arr.length-2].toLowerCase() + arr[arr.length-1].toLowerCase();               
}

function setActiveMenu(arr, crtPage)
{
	for (var i=0; i<arr.length; i++)
	{
		if(extractPageName(arr[i].href) == crtPage)
		{
			if (arr[i].parentNode.tagName == "LI")
			{
				arr[i].className = "current";
				arr[i].parentNode.className = "current";
			}
		}
	}
}

function highlightCurrentPage()
{
	hrefString = document.location.href ? document.location.href : document.location;

	if (document.getElementById("navmenu")!=null)
		setActiveMenu(document.getElementById("navmenu").getElementsByTagName("a"), extractPageName(hrefString));
}

// Slideshow, Author: Raymond Ngo
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("banner");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}