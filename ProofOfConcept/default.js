function SEND_VALS(file, data) {
  console.log(data);
  let values;
  fetch(file, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)  // Variablen hier als JSON im Request-Body
  })
    .then(response => response.json())
    .then(result => {
      console.log(result)
    })
    .catch(error => {
      console.error('Fehler:', error)
    });
}
function GET_CONTENT(file, target) {
  // Container im HTML, in den das Formular geladen werden soll
  const container = document.getElementById(target);

// Formular laden
  fetch(file)
    .then(response => response.text()) // Als Text, nicht JSON
    .then(html => {
      container.innerHTML = html; // HTML einfügen
    })
    .catch(err => {
      console.error('Fehler beim Laden des Formulars:', err);
    });
}
function LinkGenerieren() {
  fetch('link_generieren.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'  // Wir schicken JSON
    },
  })
    .then(response => response.text())
    .then(text => {
      document.getElementById('link-location').innerText = text;
    })
    .catch(error => console.error('Fehler:', error));
}
function CHECK_PW() {
  const usr = document.getElementById('c_user').value;
  const pw1 = document.getElementById('pw1').value;
  const pw2 = document.getElementById('pw2').value;
  let output;
  if(pw1 === pw2) {
     output = SEND_VALS('/manage_accounts.php', [usr, pw1, 'create']);
  }
  console.log(output);
}