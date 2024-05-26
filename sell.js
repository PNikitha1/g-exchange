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
            alert('Book posted successfully!');
            window.location.href = 'buy.html';
        } else {
            alert('Error posting book: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
