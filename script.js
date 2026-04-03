// Function to handle the booking form on index.html
function handleBooking(event) {
    event.preventDefault(); // Prevents the page from refreshing

    const name = document.getElementById('clientName').value;
    const service = document.getElementById('serviceType').value;
    const date = new Date().toLocaleDateString();

    // 1. Create the inquiry object
    const newInquiry = {
        name: name,
        service: service,
        date: date
    };

    // 2. Get existing inquiries from LocalStorage or start a new list
    let inquiries = JSON.parse(localStorage.getItem('site_inquiries')) || [];

    // 3. Add the new one and save it back
    inquiries.push(newInquiry);
    localStorage.setItem('site_inquiries', JSON.stringify(inquiries));

    // 4. Show success message
    alert(`Thank you, ${name}! Your request for ${service} has been logged. Our engineers in Yaoundé will review it in the Admin Portal.`);
    
    document.getElementById('appointmentForm').reset();
}

// Function for the Store (store.html)
function addToCart(itemName) {
    let inquiries = JSON.parse(localStorage.getItem('site_inquiries')) || [];
    inquiries.push({
        name: "Store Customer",
        service: "Material Interest: " + itemName,
        date: new Date().toLocaleDateString()
    });
    localStorage.setItem('site_inquiries', JSON.stringify(inquiries));
    alert(`${itemName} added to your inquiry list!`);
}