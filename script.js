/**
 * HouseDesign - Engineering Management System
 * Core Frontend Logic
 */

// 1. Handle Booking/Inquiry Form UI
// This function runs when a user submits the inquiry form on index.html
function handleBooking(event) {
    // We do NOT call event.preventDefault() here anymore because 
    // we want the form to naturally submit to send_inquiry.php
    
    const name = document.getElementById('clientName').value;
    const service = document.getElementById('serviceType').value;

    // Optional: Show a quick loading state or local confirmation
    console.log(`Processing inquiry for ${name} regarding ${service}...`);
    
    // The browser will now proceed to send_inquiry.php via the form action
}

// 2. Store Interactions
// Used in store.php to notify users when they express interest in materials
function addToCart(itemName) {
    // Instead of just saving to local storage, we alert the user.
    // In a full production app, this could trigger an AJAX call to a 'cart' table.
    alert(itemName + " has been added to your inquiry list. Please complete the contact form to receive a formal quote from our engineers.");
}

// 3. Vault Security Logic (Refined for portfolio.html)
function checkVault() {
    const pass = document.getElementById('vault-pass').value;
    const errorMsg = document.getElementById('vault-error');
    const overlay = document.getElementById('vault-overlay');

    // Secure Code: DESIGN2026
    if (pass === "DESIGN2026") {
        overlay.style.display = 'none';
        sessionStorage.setItem('vaultUnlocked', 'true');
        
        // If there's a function to load dynamic projects, call it here
        if (typeof loadAdminProjects === "function") {
            loadAdminProjects();
        }
    } else {
        errorMsg.style.display = 'block';
        document.getElementById('vault-pass').value = ""; // Clear field on failure
    }
}

// 4. Persistence Check for the Vault
// Ensures that if a user refreshes the portfolio page, they don't have to re-enter the code
window.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('vault-overlay');
    
    if (overlay && sessionStorage.getItem('vaultUnlocked') === 'true') {
        overlay.style.display = 'none';
        if (typeof loadAdminProjects === "function") {
            loadAdminProjects();
        }
    }
});

// 5. Security: Right-Click Protection
// Re-enforcing the protection of proprietary engineering documents
document.addEventListener('contextmenu', function(e) {
    // This provides a silent block or you can add an alert
    e.preventDefault();
}, false);

// 6. Navigation Scroll Effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.style.height = '100px';
        header.style.transition = '0.3s';
    } else {
        header.style.height = '150px';
    }
});