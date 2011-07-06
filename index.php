<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
<SCRIPT LANGUAGE="JavaScript">

var timercount = 0;
var timestart  = null;
var timedifferenceseconds = 0;

function showtimer() {
	if(timercount) {
		clearTimeout(timercount);
		clockID = 0;
	}
	if(!timestart){
		timestart = new Date();
	}
	var timeend = new Date();
	var timedifference = timeend.getTime() - timestart.getTime();
	
	timeend.setTime(timedifference);
	var minutes_passed = timeend.getMinutes();
	if(minutes_passed < 10){
		minutes_passed = "0" + minutes_passed;
	}
	var seconds_passed = timeend.getSeconds();
	if(seconds_passed < 10){
		seconds_passed = "0" + seconds_passed;
	}
	document.timeform.timetextarea.value = minutes_passed + ":" + seconds_passed;
	timedifferenceseconds = timedifference / 1000;
	document.timeform.secondstextarea.value =  timedifferenceseconds;
	var wc=wordcount(document.scribble.value);
	document.timeform.wcarea.value = wc;
	document.timeform.wpmarea.value = wc*60/timedifferenceseconds;
	//document.timeform.secondstextarea.value =  timeend.getSeconds();
	timercount = setTimeout("showtimer()", 1000);
}
 
function sw_start(){
	if(!timercount){
	timestart   = new Date();
	document.timeform.timetextarea.value = "00:00";
	document.timeform.laptime.value = "";
	timercount  = setTimeout("showtimer()", 1000);
	}
	else{
	var timeend = new Date();
		var timedifference = timeend.getTime() - timestart.getTime();
		timeend.setTime(timedifference);
		var minutes_passed = timeend.getMinutes();
		if(minutes_passed < 10){
			minutes_passed = "0" + minutes_passed;
		}
		var seconds_passed = timeend.getSeconds();
		if(seconds_passed < 10){
			seconds_passed = "0" + seconds_passed;
		}
		var milliseconds_passed = timeend.getMilliseconds();
		if(milliseconds_passed < 10){
			milliseconds_passed = "00" + milliseconds_passed;
		}
		else if(milliseconds_passed < 100){
			milliseconds_passed = "0" + milliseconds_passed;
		}
		document.timeform.laptime.value = minutes_passed + ":" + seconds_passed + "." + milliseconds_passed;
//		document.timeform.secondslaptextarea.value = timedifference;
		document.timeform.secondslaptextarea.value = timeend.getSeconds() + "." + milliseconds_passed;
	}
}
 
function Stop() {
	if(timercount) {
		clearTimeout(timercount);
		timercount  = 0;
		var timeend = new Date();
		var timedifference = timeend.getTime() - timestart.getTime();
		timeend.setTime(timedifference);
		var minutes_passed = timeend.getMinutes();
		if(minutes_passed < 10){
			minutes_passed = "0" + minutes_passed;
		}
		var seconds_passed = timeend.getSeconds();
		if(seconds_passed < 10){
			seconds_passed = "0" + seconds_passed;
		}
		var milliseconds_passed = timeend.getMilliseconds();
		if(milliseconds_passed < 10){
			milliseconds_passed = "00" + milliseconds_passed;
		}
		else if(milliseconds_passed < 100){
			milliseconds_passed = "0" + milliseconds_passed;
		}
		document.timeform.timetextarea.value = minutes_passed + ":" + seconds_passed + "." + milliseconds_passed;
	}
	timestart = null;
}
 
function Reset() {
	timestart = null;
	document.timeform.timetextarea.value = "00:00";
	document.timeform.laptime.value = "";
}

function word_count($theString)
      {
        return ereg_replace("/  +/"," ",trim($theString)).split(" ").length;
      }

</SCRIPT>    

</head>
    <body>
        Future home of hugeduel.com
       <form method="post" action="time_accept.php" name="timeform">

Name: <input type=text name="name" size="10" style = "font-size:20px"><p>
<textarea name="scribble" cols="40" rows="5" id="inputfield"  onkeypress="sw_start()">
</textarea><br>
<input type="submit" value="Submit" />

<!-- <form name="timeform"  method="post" action="time_accept.php"> -->
Time: <input type=text name="timetextarea" value="00:00" size="10" style = "font-size:20px"> Lap: <input type=text name="laptime" size="10" style = "font-size:20px"> WC: <input type=text name="wcarea" size="10" style = "font-size:20px"><br> WPM: <input type=text name="wpmarea" size="10" style = "font-size:20px"><br>
<input type=hidden name="secondstextarea" value="0" size="10" style = "font-size:20px">
<input type=hidden name="secondslaptextarea" value="0" size="10" style = "font-size:20px">
<input type=button name="start" value="Start/Lap" onclick="sw_start()"> <input type=button name="stop" value="Stop" onclick="Stop()"> <input type=button name="reset" value="Reset" onclick="Reset()">
</form>
<a href="http://hugeduel.com/time_show.php">Show leaderboard</a>       
 <?php
        
        ?>
    </body>
</html>
