<?php 
	if(!require("dbControl.php")){
		echo "problème lors de l'import de la classe BDD";
	}
	$Db = new Db();
	$cafeteriaCount = $Db->getCafeteriaCount();
	$tickets = $Db->getTickets();
	$markers = $Db->getMarkers();
	ob_start();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />

    <title>EPSI PANEL</title>
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""
    />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  </head>
  <body>
    <nav>
      <div class="nav-wrapper">
        <img src="./img/epsi-logo.png" width="70px" />
        <a href="#" class="brand-logo">EPSI PANEL</a>
        <ul class="logout">
          <li><a href="login.html">Déconnexion</a></li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <div class="angry-grid">
        <div class="bento-box" id="item-0">
          <h3>EPSI</h3>
          <ul class="equipment-list">
            <li>Micro-onde <span class="status green"></span></li>
            <li>Distributeur de Snacks <span class="status red"></span></li>
            <li>Machine à café <span class="status green"></span></li>
            <li>Fontaine à eau <span class="status red"></span></li>
          </ul>
        </div>
        <div class="bento-box" id="item-1">
          <h3>IUMM</h3>
          <ul class="equipment-list">
            <li>Micro-onde <span class="status red"></span></li>
            <li>Machine à café <span class="status green"></span></li>
            <li>Fontaine à eau <span class="status green"></span></li>
          </ul>
        </div>
        <div class="bento-box" id="item-2">
          <h3>
            <span class="indicator" id="ind-park">🟢 </span>Taux d'occupation du
            parking
          </h3>
          <div class="bento-content">
            <p><span id="parking-occupancy">- %</span> occupé</p>
          </div>
        </div>
        <div class="bento-box" id="item-3">
          <h3>
            <span class="indicator" id="ind-cafeteria">🟢 </span>Taux
            d'occupation de la cantine
          </h3>
          <div class="bento-content">
            <p><span id="cafetaria-occupancy">- %</span> occupé</p>
          </div>
        </div>
        <div class="bento-box" id="item-4">
          <h3>
            <span class="indicator" id="ind-work">🟢 </span>Taux d'occupation de
            l'espace Co-Working
          </h3>
          <div class="bento-content">
            <p><span id="work-space-occupancy">- %</span> occupé</p>
          </div>
        </div>
        <div class="bento-box" id="item-5">
          <h3>Tickets</h3>
          <table id="tickets-table">
            <thead>
              <tr>
                <th>User</th>
                <th>Description</th>
                <th>Date</th>
                <th>Localisation</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <div
      class="containerMap"
      style="display: flex; flex-direction: column; justify-content: center"
    >
      <h1 style="text-align: center">Carte intéractive du campus</h1>
      <div
        style="
          display: flex;
          flex-direction: row;
          justify-content: space-evenly;
        "
      >
        <div id="sidebar" class="sidebar"></div>
        <div id="map"></div>
      </div>
    </div>

    
    <script type="text/javascript">
    	let parkPlace = 250;
		let parkPlaceNow = 173;

		let cafetariaPlace = 100;
		let cafetariaPlaceNow = <?php echo (int) $cafeteriaCount; ?>;

		let coWorkingPlace = 25;
		let coWorkingPlaceNow = 12;

		function calculateOccupation(current, total) {
		  if (total == 0) return 0;
		  return (current / total) * 100;
		}

		let parkOccupation = calculateOccupation(parkPlaceNow, parkPlace);
		let cafeteriaOccupation = calculateOccupation(
		  cafetariaPlaceNow,
		  cafetariaPlace
		);
		let coWorkingOccupation = calculateOccupation(
		  coWorkingPlaceNow,
		  coWorkingPlace
		);

		parkOccupancy = document.getElementById("parking-occupancy");
		parkOccupancy.textContent = `${parkOccupation.toFixed(2)} %`;

		cafetariaOccupancy = document.getElementById("cafetaria-occupancy");
		cafetariaOccupancy.textContent = `${cafeteriaOccupation.toFixed(2)} %`;

		workSpaceOccupancy = document.getElementById("work-space-occupancy");
		workSpaceOccupancy.textContent = `${coWorkingOccupation.toFixed(2)} %`;

		let indicatorPark = document.getElementById("ind-park");
		let indicatorCafeteria = document.getElementById("ind-cafeteria");
		let indicatorWorkSpace = document.getElementById("ind-work");

		if (parkOccupation > 70) {
		  indicatorPark.textContent = "🔴";
		} else if (parkOccupation >= 50) {
		  indicatorPark.textContent = "🟠";
		}

		if (cafeteriaOccupation > 70) {
		  indicatorCafeteria.textContent = "🔴";
		} else if (cafeteriaOccupation >= 50) {
		  indicatorCafeteria.textContent = "🟠";
		}

		if (coWorkingOccupation > 70) {
		  indicatorWorkSpace.textContent = "🔴";
		} else if (coWorkingOccupation >= 50) {
		  indicatorWorkSpace.textContent = "🟠";
		}

		let tickets = [
			<?php 
				foreach ($tickets as $ticket) {
					echo '{
							user: "'.$ticket['pseudo'].'",
						    description: "'.$ticket['description'].'",
						    date: "'.$ticket['date_created'].'",
						    localisation: "'.$ticket['name'].'",
						  },';
				}
			?>
		  
		];
    </script>
    <script src="app.js"></script>
    <script type="text/javascript">
    	<?php
	    	foreach ($markers as $key => $marker) {
				echo "let newMarker".$key." = L.marker([".$marker['coordy'].", ".$marker['coordx']."], { icon: userIcon }).addTo(map);
		  		newMarker".$key.".bindPopup(`<b>".$marker['titre']."</b><br>Date: ".$marker['date_created']."<br>".$marker['description']."`);";
			}
		?>
    </script>
  </body>
</html>



<?php
	$outputHTML = ob_get_clean();
	echo $outputHTML;
?>