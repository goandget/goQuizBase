<?php 

header("Content-Type: application/vnd.ms-excel"); 

if (is_array($users))
{ 
	$count = 1;
	$headerline = 'Name'."\t";

	 foreach($users as $user)
	 {

		$row = $user[0]->forename.' '.$user[0]->surname."\t";

		for ($i=0;$i < count($user); $i++)
		{
			$headerline.= 'Q'.($i+1)."\t";
			if ($user[$i]->correct)
			{
				$row.= $user[$i]->level."\t";
			}
			else
			{
				$row.= '0'."\t";
			}
		}
			$row.= $user[0]->total.' out of '.$i."\t".$user[0]->attempts."\n";

		if ($count == 1)
		{
			echo $headerline.'Result'."\t".'Attempts'."\n";
			$count++;
		}

		echo $row;
	 }
}

header("Content-disposition: attachment; filename=results.xls"); 

?>