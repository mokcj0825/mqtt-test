<!DOCTYPE html>
<html>
<head>
    <title>MQTT Publish</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<h1>MQTT Publish</h1>
<button id="publishButton">Publish Hello World</button>

<script>
    document.getElementById('publishButton').addEventListener('click', function() {
        axios.post('/send-hello')
            .then(function(response) {
                alert(response.data.status);
            })
            .catch(function(error) {
                console.error('Error publishing message:', error);
            });
    });
</script>
</body>
</html>
