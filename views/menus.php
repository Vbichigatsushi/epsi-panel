<nav>
	<ul>
		<li><a href="accueil">Accueil</a></li>
		<li><a href="commander">Commander</a></li>
		<?php
			if (isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] == true)) {
				echo "<li><a href='administrer'>Administration</a></li>
				<script type='text/javascript'>
					imgLogo = document.getElementById('Logo');
					imgLogo.src = 'public/Img/logoAdmin.jpg';
				</script>";
			}
		?>
	</ul>
</nav>