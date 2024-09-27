function displayTickets(tickets) {
  const tableBody = document.querySelector("#tickets-table tbody");
  tableBody.innerHTML = "";

  tickets.forEach((ticket) => {
    const row = document.createElement("tr");

    row.innerHTML = `
      <td>${ticket.user}</td>
      <td>${ticket.description}</td>
      <td>${ticket.date || "N/A"}</td>
      <td>${ticket.localisation}</td>
    `;

    tableBody.appendChild(row);
  });
}

displayTickets(tickets);

// Interactiv Map

// Initialization
let southWest = L.latLng(47.82127905957212, 3.584344545288675);
let northEast = L.latLng(47.82259734329673, 3.586951652334025);
let bounds = L.latLngBounds(southWest, northEast);

let map = L.map("map", {
  maxBounds: bounds,
  maxZoom: 100,
}).setView([47.8219, 3.5855], 18);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

// Icons creation
let cookiesIcon = L.icon({
  iconUrl: "./icon/cookies.png",
  iconSize: [16, 16],
  popupAnchor: [1, -34],
});

let forkIcon = L.icon({
  iconUrl: "./icon/fork.png",
  iconSize: [30, 30],
  popupAnchor: [1, -34],
});

let microwaveIcon = L.icon({
  iconUrl: "./icon/microwave.png",
  iconSize: [18, 18],
  popupAnchor: [1, -34],
});

let kickIcon = L.icon({
  iconUrl: "./icon/kick.png",
  iconSize: [20, 20],
  popupAnchor: [1, -34],
});

let cycleIcon = L.icon({
  iconUrl: "./icon/cycle.png",
  iconSize: [20, 20],
  popupAnchor: [1, -34],
});
let coffeeIcon = L.icon({
  iconUrl: "./icon/coffee.png",
  iconSize: [20, 20],
  popupAnchor: [1, -34],
});
let waterIcon = L.icon({
  iconUrl: "./icon/water.png",
  iconSize: [20, 20],
  popupAnchor: [1, -34],
});
let wcIcon = L.icon({
  iconUrl: "./icon/wc.png",
  iconSize: [16, 16],
  popupAnchor: [1, -34],
});

// Admin Markers
let markersData = [
  {
    position: [47.82209957480534, 3.586385841055004],
    icon: forkIcon,
    type: "Cafeteria/Cantine",
    etat: "En service 🟢",
  },
  {
    position: [47.82227993592374, 3.585133508506113],
    icon: cookiesIcon,
    type: "Distributeur de snacks",
    etat: "En service 🟢",
  },
  {
    position: [47.82186280142682, 3.5848930276330915],
    icon: microwaveIcon,
    type: "Micro-ondes",
    etat: "En service 🟢",
  },
  {
    position: [47.82227658387531, 3.584988040898942],
    icon: microwaveIcon,
    type: "Micro-ondes",
    etat: "En service 🟢",
  },
  {
    position: [47.82190962575891, 3.5848916865286555],
    icon: coffeeIcon,
    type: "Machine à café",
    etat: "En service 🟢",
  },
  {
    position: [47.82222028613087, 3.5851505197217013],
    icon: coffeeIcon,
    type: "Machine à café",
    etat: "En service 🟢",
  },
  {
    position: [47.82219400789597, 3.585577857200315],
    icon: kickIcon,
    type: "Parking à trottinettes",
    etat: "En service 🟢",
  },
  {
    position: [47.82178459722393, 3.584506491412235],
    icon: cycleIcon,
    type: "Parking à Vélo",
    etat: "En service 🟢",
  },
  {
    position: [47.82234274883862, 3.585182706219976],
    icon: wcIcon,
    type: "Toilettes Garçons",
    etat: "En service 🟢",
  },
  {
    position: [47.82234545021857, 3.585389236303071],
    icon: wcIcon,
    type: "Toilettes Filles",
    etat: "En service 🟢",
  },
];

// Add marker to the map with informations
markersData.forEach(function (marker) {
  let newMarker = L.marker(marker.position, { icon: marker.icon }).addTo(map);
  newMarker.bindPopup(
    `<b>Type:</b> ${marker.type} <br> <b>Etat:</b> ${marker.etat}`
  );
});

// Map configuration
map.doubleClickZoom.disable();
map.keyboard.disable();

let userIcon = L.icon({
  iconUrl: "./icon/warning.png",
  iconSize: [18, 18],
});

let eventMarker = L.layerGroup().addTo(map);

/// Event ticket Form
function createEventForm(latlng) {
  return `
    <div class="event-form">
      <h3>Ajouter un événement</h3>
      <form onsubmit="return handleSubmit(event, ${latlng.lat}, ${latlng.lng})" method="post" action="traitementTicket.php">
        <label for="title">Titre :</label>
        <input type="text" id="title" required>

        <label for="localisation">Localisation :</label>
        <select name="localisation" id="localisation" required>
          <option value="">sélectionner</option>
          <option value="5">Cafétéria</option>
          <option value="4">EPSI RDC</option>
          <option value="3">EPSI étage</option>
          <option value="2">UIMM RDC</option>
          <option value="1">UIMM étage</option>
        </select>
        
        <label for="description">Description:</label>
        <textarea id="description" rows="4" required></textarea>
        
        <button type="submit">Valider</button>
        <button type="button" class="cancel-button" onclick="cancelEvent()">Annuler</button>
      </form>
    </div>
  `;
}

// Handle event user marker
function handleSubmit(event, lat, lng) {
  event.preventDefault();
  let title = document.getElementById("title").value;
  let localisation = parseInt(document.getElementById("localisation").value);
  let description = document.getElementById("description").value;
  // Charger la timezone de Paris
  const options = { timeZone: 'Europe/Paris', year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' };

  // Créer une date dans la timezone de Paris
  const datetemp = new Date().toLocaleString('fr-FR', options);

  // Formater la date pour correspondre à 'Y-m-d H:i:s'
  const formattedDate = datetemp.replace(/(\d{2})\/(\d{2})\/(\d{4}), (\d{2}):(\d{2}):(\d{2})/, '$3-$2-$1 $4:$5:$6');
  let date = formattedDate;

  // Add marker
  let marker = L.marker([lat, lng], {icon:userIcon}).addTo(eventMarker);
  marker.bindPopup(`<b>${title}</b><br>Date: ${date}<br>${description}`);

  // Close popup (ferme automatiquement la popup après validation)
  map.closePopup();
  let localisationText;

  switch (localisation) {
    case 5:
      localisationText = "Cafétéria"
      break;
    case 4:
      localisationText = "EPSI rez de chaussée"
      break;
    case 3:
      localisationText = "EPSI étage"
      break;
    case 2:
      localisationText = "UIMM rez de chaussée"
      break;
    case 1:
      localisationText = "UIMM étage"
      break;
  }

  // Add event to the table
  const newTicket = {
    user: "vbichigatsushi",
    description: description,
    date: date,
    localisation: localisationText,
  };

  // Add ticket to the table
  tickets.push(newTicket);

  // Update tickets
  displayTickets(tickets);

  // Close form (ferme le formulaire)
  closeSidebar();

  fetch('traitementTicket.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      title: title,
      description: description,
      coordx: lng,
      coordy: lat,
      localisation: localisation,
    }),
  })
  .then(response => response.json())
  .then(data => {
    console.log('Success:', data);
    location.reload();
  })
  .catch((error) => {
    console.error('Error:', error);
  });

  return false;
}

// Cancel event marker
function cancelEvent() {
  // Close popup (ferme automatiquement la popup après annulation)
  map.closePopup();

  // Close form (ferme le formulaire)
  closeSidebar();
}

// Function to close the sidebar
function closeSidebar() {
  document.getElementById("sidebar").classList.remove("active");
  document.getElementById("sidebar").style.display = "none";
}

// Popup to add event ticket
map.on("click", async function (e) {
  map.closePopup();
  await sleep(200);
  let content = `<label>Evènement</label><br>
  <div id="modalEvent">
    <button id="addEventBtn">+</button>
  </div>`;

  let popup = L.popup().setLatLng(e.latlng).setContent(content).openOn(map);

  document
    .getElementById("addEventBtn")
    .addEventListener("click", function (event) {
      document.getElementById("sidebar").innerHTML = createEventForm(e.latlng);
      document.getElementById("sidebar").classList.add("active");
      document.getElementById("sidebar").style.display = "block";
    });
});

// Close sidebar when a new popup is opened
map.on("popupopen", function () {
  // This will trigger every time a new popup is opened
  closeSidebar();
});

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

window.handleSubmit = handleSubmit;
window.createEventForm = createEventForm;
window.cancelEvent = cancelEvent;
