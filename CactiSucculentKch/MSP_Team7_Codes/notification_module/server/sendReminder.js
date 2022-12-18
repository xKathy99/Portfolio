function diff_minutes(dt2, dt1) 
 {

  var diff =(dt2.getTime() - dt1.getTime()) / 1000;
  diff /= 60;
  return diff;
 }

dt1 = new Date();
dt2 = new Date(2014,9,3,11,30);
mindiff=diff_minutes(dt1, dt2);
console.log("hello")
var conn = new WebSocket('ws://localhost:8080');
conn.onopen = function(e)
{
console.log("Connection established!");
};
function sendMessage(){
conn.send("You have a booking in 30 minutes")
}