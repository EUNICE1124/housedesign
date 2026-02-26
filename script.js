// 1. SECURITY & ACCESS LOGIC
function accessVault() {
    const authorizedKeys = ["CIVIL-WW-2026", "PARTNER_77", "CLIENT_ABC"];
    let userInput = prompt("SECURITY PROTOCOL: Enter your Client Access Token:");

    if (authorizedKeys.includes(userInput)) {
        document.getElementById('vault-content').style.display = 'block';
        document.getElementById('vault-lock').style.display = 'none';
    } else {
        alert("Access Denied. Unauthorized Token.");
    }
}

// 2. APPOINTMENT FORM HANDLING
async function handleBooking(event) {
    event.preventDefault(); // Prevents the page from refreshing
    
    // Selecting the form element from index.html
    const form = document.getElementById('appointmentForm');
    if (!form) return;

    const formData = new FormData(form);

    try {
        // Sending the data to your PHP bridge
        const response = await fetch('submit_appointment.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            alert("Success! Your engineering request has been secured in our database and the admin has been notified.");
            form.reset(); // Clears the form after successful submission
        } else {
            alert("System Error: Could not record the appointment. Please try again later.");
        }
    } catch (error) {
        console.error("Booking Error:", error);
        alert("Connection Error: Please check your internet and try again.");
    }
}

// 3. CALCULATOR LOGIC (For Services & Store)
let total = 0;
function addToQuote(price) {
    total += price;
    const totalDisplay = document.getElementById('total-cost');
    if (totalDisplay) {
        totalDisplay.innerText = total.toLocaleString(undefined, {minimumFractionDigits: 2});
    }

    // Visual feedback for the button
    if (event && event.target) {
        const btn = event.target;
        const originalText = btn.innerText;
        btn.innerText = "Added ✓";
        btn.style.background = "#28a745";
        setTimeout(() => { 
            btn.innerText = originalText; 
            btn.style.background = ""; // Returns to CSS default
        }, 2000);
    }
}

// 4. PREVENT CONTENT THEFT (Global)
document.addEventListener('contextmenu', event => event.preventDefault());