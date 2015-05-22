<?php

	header("Content-type: application/json; charset=utf-8");

	$query_length = $query->num_rows();
	$i = 0;
	echo '[';
	foreach($query->result() as $row)
	{
		$i++;
		echo '"'.$row->nom_reel.'"';
		if($i < $query_length) echo ',';
	}
	echo ']';

?>
