
<?php
$time=htmlspecialchars($_POST["secondstextarea"]);
$laptime=htmlspecialchars($_POST["secondslaptextarea"]);
$scribble=htmlspecialchars($_POST["scribble"]);
$name=htmlspecialchars($_POST["name"]);
?>
<html>
<body>
<?php 
//echo "$scribble <br>";
//echo "$time <br>";
//echo "$laptime <br>";

$wordcount=word_count($scribble);
$wpm = ($wordcount / $time) * 60;
                $wpm = number_format($wpm, 2, '.', '');
$insert=insert_time($time, $laptime, $name, $scribble, $wordcount, $wpm);
$show=show_times();


        function insert_time($time, $laptime, $name, $scribble, $wordcount, $wpm) {
            $db = "hugeduel";
            $link = mysql_connect("localhost", "hugeduel", "10qpalzm");
            if (!$link)
                die("Couldn't connect to MySQL");
            mysql_select_db($db, $link)
                    or die("Couldn't open $db: " . mysql_error());
            $query = "INSERT INTO scribble (time, laptime, name, scribble, wordcount, wpm) VALUES ('$time', '$laptime', '$name', '$scribble', '$wordcount', '$wpm')";
            $result = mysql_query($query);
            mysql_close($link);
            return; 
	}

        function show_times() {
            $db = "hugeduel";
            $link = mysql_connect("localhost", "hugeduel", "10qpalzm");
            if (!$link)
                die("Couldn't connect to MySQL");
            mysql_select_db($db, $link)
                    or die("Couldn't open $db: " . mysql_error());
            $query = "select * from scribble order by wpm DESC";
            $result = mysql_query($query);
            mysql_close($link);
            while ($row = mysql_fetch_assoc($result)) {
                $resultsarray[current($row)] = $row;
		$rname = $row["name"];
		$rid = $row["id"];
		$rtime = $row["time"];
		$rlaptime = $row["laptime"];
		$rscribble = $row["scribble"];
		$rwordcount = $row["wordcount"];
		$rwpm	= $row["wpm"];
		echo "$rid : $rname  -  $rtime / $rlaptime - $rwordcount words - $rwpm wpm => $rscribble<p>"; 	
            
	    }

            foreach ($resultarray as $scribble) {
		$name = $scribble["scribble"];
		echo "scribble = $name"; 
		}
		return $resultsarray;
        }
function word_count($theString)
      {
        $theString = trim($theString);
        $char_count = strlen($theString);
        $fullStr = $theString." ";
        $initial_whitespace_rExp = "^[[:alnum:]]$";
        $left_trimmedStr = ereg_replace($initial_whitespace_rExp,"",$fullStr);
        $non_alphanumerics_rExp = "^[[:alnum:]]$";
        $cleanedStr = ereg_replace($non_alphanumerics_rExp," ",$left_trimmedStr);
        $splitString = explode(" ",$cleanedStr);

        $word_count = count($splitString)-1;

        if(strlen($fullStr)<2)
        { 
          $word_count=0;
        }
        return $word_count;
      }

?>
<a href="http://hugeduel.com/time_show.php">Show leaderboard</a>
<a href="http://hugeduel.com/">HugeDuel.coms</a>
</body>
</html>
