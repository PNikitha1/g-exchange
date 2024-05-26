document.getElementById('search-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const query = document.getElementById('search-query').value;

    fetch(`/search?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            const resultsContainer = document.getElementById('search-results');
            resultsContainer.innerHTML = '';

            if (data.length === 0) {
                resultsContainer.innerHTML = '<p>No books found.</p>';
            } else {
                const list = document.createElement('ul');
                data.forEach(book => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${book.title} - ${book.subjectCode} - ₹${book.price}`;
                    list.appendChild(listItem);
                });
                resultsContainer.appendChild(list);
            }
        })
        .catch(error => console.error('Error:', error));
});
