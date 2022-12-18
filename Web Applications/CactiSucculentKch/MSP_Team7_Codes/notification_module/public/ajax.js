console.log("hello")
function getDataUsingAjax(){
  console.log("hello")
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        console.log(this.responseText)
        const data=JSON.parse(this.responseText);
      console.log(data);


     
      if(data.data==false){
        console.log("no data found");
      }
      else{
            let timediff;
            function getMinDiff(startDate, endDate) {
            const msInMinute = 60 * 1000;

                return Math.round((startDate - endDate)/msInMinute);
                
                }

                data.data.map(d=>{
                    timediff=getMinDiff(new Date(d.date+"T"+d.time),new Date())
                console.log(timediff)
                
                if(timediff>=30 && timediff<=31)
                conn.send(JSON.stringify(data))
                })
                
      }
      
    }
  xmlhttp.open("GET", "http://localhost/SWE20001_Sprint-main/notification_module/public/getData.php");
  xmlhttp.send();
}
const startTimer=()=>{
const timer=setInterval(getDataUsingAjax,1000*60)
}