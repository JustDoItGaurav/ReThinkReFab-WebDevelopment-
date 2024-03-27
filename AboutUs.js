document.addEventListener('DOMContentLoaded', function() {
    // Function to initialize the Leaflet map with static location
    function initMap() {
        // Coordinates for Pillai College of Panvel
        var latitude = 18.9894;
        var longitude = 73.1185;

        // Initialize Leaflet map centered on Pillai College of Panvel
        var map = L.map('map').setView([latitude, longitude], 13);

        // Add a tile layer to the map (you can use different tile layers as per your choice)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a marker to the map at Pillai College of Panvel
        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('Pillai College of Engineering, Panvel')
            .openPopup();
    }

    // Function to handle form submission via AJAX
    function handleFormSubmission(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get form data
        var form = event.target;
        var formData = new FormData(form);

        // Send form data to subscribe.php using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'AboutUs.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Success: Display the response from the server
                alert(xhr.responseText);
                // You can also update the UI here if needed
            } else {
                // Error: Display the status text
                alert('Error: ' + xhr.statusText);
            }
        };
        
        xhr.onerror = function() {
            alert('Request failed');
        };
        xhr.send(formData);
    }

    // Check if geolocation is supported by the browser
    if (navigator.geolocation) {
        // Get user's current position and display it on the map
        navigator.geolocation.getCurrentPosition(initMap, function(error) {
            // If geolocation fails, just initialize the map with static location
            console.error('Error occurred while fetching user location:', error);
            initMap();
        });
    } else {
        console.error('Geolocation is not supported by this browser.');
        // If geolocation is not supported, just initialize the map with static location
        initMap();
    }

    // Attach form submission handler to the newsletter form
    var form = document.getElementById('newsletterForm');
    if (form) {
        form.addEventListener('submit', handleFormSubmission);
    }
});
