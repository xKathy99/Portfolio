function toggleBookingTimes()
{
  var timeslots = document.getElementById("div_timeslots");
  
  var x = document.getElementById("choose_date").value;
  var y = "Showing available slots for ";
  document.getElementById("p_show_date").innerHTML = y+x;
  
	if (x != "")
	{
		if (timeslots.style.display === "none")
		{
			timeslots.style.display = "block";
		}
	}
	
	else
	{
		timeslots.style.display = "none";

	}
} 

function addNewSlot()
{	
	
	var newslot = document.getElementById("div_new_slot").innerHTML;
    console.log(newslot)
	
	//Add to contents
	//newslot.innerHTML += label_fromtime+input_fromtime+label_totime+input_totime+"<br>";
	document.getElementById("div_addnewslot").innerHTML+=newslot;
	
}


function hideField()
{
  var custid_field = document.getElementById("div_tohide");
  
  custid_field.style.display = "none";
} 

/*
function deleteUnbookedSlot()
{	
	//let unbookedslots = document.getElementsByTagName("li");
	//unbookedslots.innerHTML = elements[];
	
	/*
	const nodes = document.getElementsByTagName("li");
	const nodesArr = [...nodes]
	const index = nodesArr.indexOf(document.body)
	console.log(index)
	
	
	
	//var elementindex = getindex(this);
	
	//let unbookedslots = document.getElementsByName("button_deleteunbookedslot");
	*/
	
	/*
	var delete_slotbutton = document.getElementById("button_deleteunbookedslot");
	
	if (delete_slotbutton.innerHTML == "DELETE SLOT")
	{
		document.getElementById("div_unbookedslot").style.backgroundColor = "rgba(255, 0, 0, 0.10)";
		delete_slotbutton.innerHTML = "UNDO DELETE";
		console.log("Delete unbooked slot");

	}
	else
	{
		document.getElementById("div_unbookedslot").style.backgroundColor = "white";
		delete_slotbutton.innerHTML = "DELETE SLOT";
		console.log("Undo unbooked slot");
	}
	
	
}
*/



/* Get element by id
function getId(id) {
  return document.getElementById(id);
}
*/

// On Load of the window
window.onload = function()
{
	// Initially hide item (time slots)
	var availtime_section = document.getElementById("div_timeslots");
	availtime_section.style.display = "none";
	
	var customer_reply_id = document.getElementById("div_tohide");
	customer_reply_id.style.display = "none";
}