document.getElementById('sell-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('/sell', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'submit.html';
        } else {
            alert('Error posting book: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
