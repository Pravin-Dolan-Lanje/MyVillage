
<?php  
require_once '../Admin/auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 20px;
        padding: 20px;
        text-align: center;
    }

    h2, h3 {
        color: #333;
    }

    form {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        display: inline-block;
        margin-bottom: 20px;
    }

    input[type="text"], input[type="file"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        background: #28a745;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #218838;
    }

    table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
        background: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    th {
        background: #28a745;
        color: white;
    }

    td img {
        width: 80px;
        border-radius: 5px;
    }

    .action-buttons button {
        background: #007bff;
        margin: 5px;
    }

    .action-buttons button:hover {
        background: #0056b3;
    }

    .delete-btn {
        background: #dc3545 !important;
    }

    .delete-btn:hover {
        background: #c82333 !important;
    }
</style>

    <script>
        function fetchEvents() {
            fetch('fetch.php')
                .then(response => response.json())
                .then(data => {
                    let eventList = document.getElementById("event-list");
                    eventList.innerHTML = "";
                    data.forEach(event => {
                        eventList.innerHTML += `
                            <tr>
                            
                                <td><img src="uploads/${event.image_url}" width="100"></td>
                                <td>${event.subtitle}</td>
                                <td>
                                    <button onclick="updateEvent(${event.id})">Edit</button>
                                    <button onclick="deleteEvent(${event.id})">Delete</button>
                                </td>
                            </tr>`;
                    });
                });
        }

        function deleteEvent(id) {
            if (confirm("Are you sure?")) {
                fetch('delete_event.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${id}`
                }).then(() => fetchEvents());
            }
        }

        function updateEvent(id) {
            let subtitle = prompt("Enter new subtitle:");
            if (subtitle) {
                fetch('update_event.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${id}&subtitle=${subtitle}`
                }).then(() => fetchEvents());
            }
        }

        window.onload = fetchEvents;
    </script>
</head>
<body>
    <h2>Manage Events</h2>
   
    <h3>Add New Event</h3>
    <form action="add_event.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="subtitle" placeholder="Enter Subtitle" required>
        <input type="file" name="image" required>
        <button type="submit">Add Event</button>
        <button> <a href="../login/dashboard.php" class="add-btn">Administrative panel</a></button>
    </form>

    <h3>Event List</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Image</th>
                <th>Subtitle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="event-list"></tbody>
    </table>
</body>
</html>
