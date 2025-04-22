function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
}

// Modal functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
};

// Form handlers
function handleLogin(event) {
    event.preventDefault(); // Prevent the default form submission

    const form = event.target;
    const formData = new FormData(form);

    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === 'Login successful!') {
            // Close the login modal
            closeModal('loginModal');

            // Update the UI to show the user's profile
            document.querySelector('.login-btn').style.display = 'none';
            document.querySelector('.profile-btn').style.display = 'inline-block';

            // Redirect to the homepage
            window.location.href = 'index.html';
        } else {
            alert(data); // Show error message
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


// Switch from login to signup
function switchToSignup() {
    closeModal('loginModal');
    openModal('signupModal');
}

function handleBooking(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    console.log('Booking:', Object.fromEntries(formData));
    closeModal('bookingModal');
    alert('Thank you for your booking! We will contact you shortly.');
}
/*
function handleContact(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    console.log('Contact form:', Object.fromEntries(formData));
    event.target.reset();
    alert('Thank you for your message! We will get back to you soon.');
}
    */

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Add scroll animation for elements
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
        }
    });
}, observerOptions);

// Observe all sections
document.querySelectorAll('section').forEach(section => {
    observer.observe(section);
});

// Service details (Google Sheets integration)
/*const serviceForm = document.forms['submit-to-google-sheet'];
if (serviceForm) {
    const scriptURL = 'https://script.google.com/macros/s/AKfycbxik8VY-OyZbTW9HCsNF5-fADs-IRX82WERhBme0xN3MYEbfTmRCxbRTB_qyvrMTmot/exec';
    serviceForm.addEventListener('submit', e => {
        e.preventDefault();
        fetch(scriptURL, { method: 'POST', body: new FormData(serviceForm) })
            .then(response => console.log('Success!', response))
            .catch(error => console.error('Error!', error.message));
    });
}*/


// Get user's location

function getUserLocation(callback) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                const coords = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };
                console.log('User location:', coords);
                callback(coords);
            },
            error => {
                console.error('Error getting location:', error.message);
                alert('Unable to retrieve location. Please allow location access.');
                callback(null);
            }
        );
    } else {
        alert('Geolocation is not supported by this browser.');
        callback(null);
    }
}

// Emergency booking with location
function handleEmergencyBooking(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    getUserLocation(location => {
        if (location) {
            data.latitude = location.latitude;
            data.longitude = location.longitude;
        } else {
            data.latitude = 'Not available';
            data.longitude = 'Not available';
        }

        console.log('Emergency booking with location:', data);
        closeModal('emergencyModel');
        //alert('Thank you! Our agent will call you shortly.');
    });
}
