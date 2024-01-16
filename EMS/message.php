<!-- index.html -->
<form id="messageForm">
    <label for="recipient_id">Recipient ID:</label>
    <input type="text" name="recipient_id" id="recipient_id">
    <br>
    <label for="content">Message:</label>
    <textarea name="content" id="content"></textarea>
    <br>
    <button type="submit">Send Message</button>
</form>

<!-- Display messages -->
<div id="messages"></div>

<script>
    // Function to handle the form submission and send the message
    document.getElementById('messageForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const recipient_id = document.getElementById('recipient_id').value;
        const content = document.getElementById('content').value;

        const data = new FormData();
        data.append('action', 'send_message');
        data.append('sender_id', 1); // Replace with the actual sender ID (logged-in user ID)
        data.append('recipient_id', recipient_id);
        data.append('content', content);

        fetch('api.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Handle the response as needed
        })
        .catch(error => console.error(error));
    });

    // Function to retrieve messages
    function getMessages() {
        fetch('api.php?action=get_messages&recipient_id=1') // Replace '1' with the actual recipient ID (logged-in user ID)
        .then(response => response.json())
        .then(data => {
            const messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML = '';
            data.forEach(message => {
                const messageElement = document.createElement('p');
                messageElement.textContent = message.content;
                messagesDiv.appendChild(messageElement);
            });
        })
        .catch(error => console.error(error));
    }

    // Call the function to retrieve messages initially and then every few seconds (optional)
    getMessages();
    setInterval(getMessages, 5000); // Refresh messages every 5 seconds
</script>
