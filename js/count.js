
window.onload = function()
{
  var pierd;
  var seconds = 0;
  var sec = 0;
  var el = document.getElementById("seconds-counter");
  var retur = document.getElementById("toReturn");
  var btnascuns = document.getElementById("clicker");
  var poza = document.getElementById("poza");
  var img = document.getElementById("pic");
  pierd = setInterval(secundePierdute, 1250);

  function incrementSeconds() {
      seconds += 1;
      el.innerHTML = "Upvoted for " + seconds;
      if(seconds >= 10){
        retur.value = seconds;
        btnascuns.click();
      }
  }

  function secundePierdute(){
    sec += 1;
    if(sec >= 1.5){
      retur.value = seconds;
      btnascuns.click();
    }
  }

  document.getElementById("pic").addEventListener("mouseover", mouseOver);
  document.getElementById("pic").addEventListener("mouseout", mouseOut);
  var cancel;
  function mouseOver(){
    cancel = setInterval(incrementSeconds, 1250);
    clearInterval(pierd);
  }

  function mouseOut(){
    clearInterval(cancel);
    pierd = setInterval(secundePierdute, 1250);
    /*var save = seconds;
    el.innerHTML = "Upvoted for " + save + " seconds.";*/
  }

}
