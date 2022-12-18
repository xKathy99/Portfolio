const hide_details=(id)=>{
    document.getElementById(id).style.height="0px";
    document.getElementById(id).style.display="none";
    document.getElementById("show"+id).style.display="block"
    document.getElementById("hide"+id).style.display="none"
    
}
const show_details=(id)=>{
    document.getElementById(id).style.height="auto";
    document.getElementById(id).style.display="block";
    document.getElementById("show"+id).style.display="none"
    document.getElementById("hide"+id).style.display="block"

}
const mark_as_read=(id)=>{
    document.getElementById('context'+id).style.fontWeight="normal"
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      console.log(this.responseText);
    }
  xmlhttp.open("GET", "mark_as_read.php?id="+id);
  xmlhttp.send();
}