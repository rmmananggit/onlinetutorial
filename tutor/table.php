<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Messaging System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>User Messaging System</h2>

    <!-- User List -->
    <div class="row">
        <div class="col-md-4">
            <h5>Users</h5>
            <ul class="list-group" id="userList"></ul>
        </div>

        <!-- Messaging Section -->
        <div class="col-md-8">
            <h5>Messages</h5>
            <div id="messageContainer"></div>

            <!-- Message Form -->
            <form action="process.php" method="post" id="messageForm">
                <input type="hidden" name="recipient_id" id="recipientId">
                <div class="form-group">
                    <label for="message">Type your message:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Refresh users and messages using jQuery -->
<script>
    function refreshUsers() {
        $.get("get_users.php", function (data) {
            $("#userList").html(data);
        });
    }

    function refreshMessages(userId) {
        $.get("get_messages.php?user_id=" + userId, function (data) {
            $("#messageContainer").html(data);
        });
    }

    // Refresh users on page load
    $(document).ready(function () {
        refreshUsers();
    });

    // Load messages when a user is selected
    $(document).on("click", ".list-group-item", function () {
        var userId = $(this).data("user-id");
        $("#recipientId").val(userId);
        refreshMessages(userId);
    });

    // Auto-refresh messages every 5 seconds
    setInterval(function () {
        var userId = $("#recipientId").val();
        if (userId) {
            refreshMessages(userId);
        }
    }, 5000);
</script>

</body>
</html>
