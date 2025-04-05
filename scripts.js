// Get buttons and sections
const updateTimingsBtn = document.getElementById('updateTimingsBtn');
const viewPatientsBtn = document.getElementById('viewPatientsBtn');
const timingsSection = document.getElementById('timingsSection');
const patientsSection = document.getElementById('patientsSection');
const timingForm = document.getElementById('timingForm');

// Function to show and hide sections
updateTimingsBtn.addEventListener('click', function() {
    timingsSection.classList.remove('hidden');
    patientsSection.classList.add('hidden');
});

viewPatientsBtn.addEventListener('click', function() {
    patientsSection.classList.remove('hidden');
    timingsSection.classList.add('hidden');
});

// Handle form submission for updating timings
timingForm.addEventListener('submit', function(event) {
    event.preventDefault();
    alert("Timings updated successfully!");
});
