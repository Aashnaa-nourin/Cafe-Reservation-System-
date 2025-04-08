function bookTable(tableName) {
    const tableElement = document.getElementById(tableName);
    const availabilityElement = tableElement.querySelector('p: nth-child(3)');

    // Check table availability
    if (availabilityElement.textContent.includes('Available')) {
        // Replace this with your booking logic (e.g., set the table as booked)
        availabilityElement.textContent = 'Availability: Booked';
        tableElement.style.backgroundColor = '#ffcccc'; // Update table color
        alert(`You have booked ${tableName}`);
    } else {
        alert('This table is already booked. Please choose another one.');
    }
}
