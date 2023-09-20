<?php
if(isset($_SESSION['msgs']))
{
	echo '<div style="background-color:#F2F49D; border-bottom:#CCCCCC solid 1px; border-top:#CCCCCC solid 1px; color:#227D22; padding: 10px; margin:10px 0;">';
	foreach($_SESSION['msgs'] as $msg)
	{
	 echo $msg.'<br>';
	}
	echo '</div>';
}
?> 