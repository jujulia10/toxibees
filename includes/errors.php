<?php
if(isset($_SESSION['errors']))
{
	echo '<div style="border:#E72C3A solid 1px;color:#E72C3A; padding: 10px; margin:10px 0;">
	<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
	Certains champs n\'ont pas été remplis correctement. <br>
Merci de corriger les erreurs dans le formulaire.
	</div>';
}
?>