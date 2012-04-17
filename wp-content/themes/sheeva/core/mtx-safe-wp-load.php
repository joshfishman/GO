<?php

/**
 * @author Tarchini Maurizio
 * @copyright 2011
 */


$wp_load = '../../wp-load.php';

for($i=0; $i<10; $i++)
{
	if(file_exists($wp_load))
	{
		require_once "$wp_load";
		break;
	}
	else
	{
		$wp_load = '../' . $wp_load;
	}
}

?>