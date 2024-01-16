// Use jQuery to wait for the document to be ready
// Get a reference to the users list container
const usersList = document.querySelector(".user-list");

// Function to fetch and display the list of users
function loadUsers() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/user.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  };
  xhr.send();
}

// Call the loadUsers function when the page loads
window.addEventListener('load', loadUsers);
