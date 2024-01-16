<!DOCTYPE html>
<html>
<head>
    <title>Submit Event Form</title>
</head>
<body>
    <form action="submit_event.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>

        <label for="start_date">Start Date and Time:</label>
        <input type="datetime-local" id="start_date" name="start_date" required><br>

        <label for="end_date">End Date and Time:</label>
        <input type="datetime-local" id="end_date" name="end_date" required><br>

        <!-- Picture input with validation for PNG, JPEG, and JPG files -->
        <label for="picture">Picture (PNG, JPEG, JPG only):</label>
        <input type="file" id="picture" name="picture" accept=".png, .jpeg, .jpg" required><br>

        <label for="organizer_name">Organizer Name:</label>
        <input type="text" id="organizer_name" name="organizer_name" required><br>

        <!-- Description input using a textarea element -->
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>

        <!-- City dropdown populated with fetched cities -->
        <label for="city">City:</label>
        <select id="userForm-citySelect" name="city" required></select><br>

        <!-- Hidden input to store the submission time -->
        <input type="hidden" id="submissionTime" name="submissionTime" value="">

        <input type="submit" value="Submit Event">
    </form>

    <script>
        const fields = document.querySelectorAll(".sn-field input, .sn-field select");
        fields.forEach(field => {
          field.addEventListener("input", updatePlaceholderStyles);
        });

        function fetchCities() {
          // Fetch JSON data from the local file 'cities.json'
          fetch('https://gist.githubusercontent.com/immujahidkhan/014fb1629ddc931e6f6d4a3a4d31abaa/raw/8f5cc4f88b9dc4efc5058c5354b9f955e4bda16f/cities.json')
            .then(response => {
              if (!response.ok) {
                throw new Error('Error loading cities.json');
              }
              return response.json();
            })
            .then(data => {
              populateCityDropdown('userForm', data);
              populateCityDropdown('OrganizerForm', data);
            })
            .catch(error => {
              console.error('Error fetching cities:', error);
            });
        }

        function populateCityDropdown(formName, data) {
          // Get the select element based on the form name
          const citySelect = document.getElementById(`${formName}-citySelect`);

          // Clear the select element to avoid duplicate entries if this function is called multiple times
          citySelect.innerHTML = "";

          // Add the "Select city" default option
          const defaultOption = document.createElement('option');
          defaultOption.value = ""; // Set an empty value for the default option
          defaultOption.textContent = "Select city";
          citySelect.appendChild(defaultOption);

          // Loop through the cities and create option elements
          data.forEach(city => {
            const option = document.createElement('option');
            option.value = city.name;
            option.textContent = city.name;
            citySelect.appendChild(option);
          });
        }

        // Add an event listener to trigger the fetchCities function when the page loads
        window.addEventListener('load', fetchCities);

        // Form validation function
        function validateForm() {
            const startDateInput = document.getElementById("start_date");
            const endDateInput = document.getElementById("end_date");
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            const currentDate = new Date();
            if (startDate <= currentDate) {
                alert("Start date must be after the current date.");
                return false;
            }

            if (endDate <= startDate) {
                alert("End date must be after the start date.");
                return false;
            }

            return true; // Form submission proceeds if validation passes
        }
    </script>
</body>
</html>
