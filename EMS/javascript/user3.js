// Get a reference to the users list container
const usersList = document.querySelector(".user3-list");

// Function to fetch and display the list of users
function loadUsers() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/user3.php", true);
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
