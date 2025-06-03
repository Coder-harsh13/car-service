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

//Email Invalid

document.addEventListener('DOMContentLoaded', () => {
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', () => {
        const email = emailInput.value.trim();
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|org|net|in)$/;
        const extraAfterDomain = email.replace(/.*\.(com|org|net|in)/i, '');

        if (!emailPattern.test(email) || extraAfterDomain.length > 0) {
            emailInput.setCustomValidity('Invalid email format (e.g., user@example.com)');
        } else {
            emailInput.setCustomValidity('');
        }
    });
});


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



// Handle Review Submit
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent normal form submit

    var formData = new FormData(this);

    fetch('save_review.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === 'success') {
            // Get input values
            var name = document.querySelector('#reviewForm input[name="name"]').value;
            var rating = document.querySelector('#reviewForm select[name="rating"]').value;
            var reviewText = document.querySelector('#reviewForm textarea[name="review"]').value;

            // Create new review card
            var newReview = `
                <div class="review-card">
                    <img src="https://randomuser.me/api/portraits/lego/${Math.floor(Math.random() * 10)}.jpg" alt="Customer">
                    <h4>${name}</h4>
                    <div class="stars">${'★'.repeat(rating)}${'☆'.repeat(5 - rating)}</div>
                    <p>${reviewText}</p>
                </div>
            `;

            // Add it to the reviews wrapper
            document.querySelector('.reviews-wrapper').innerHTML += newReview;

            // Reset form
            document.getElementById('reviewForm').reset();

            // Close modal
            closeModal('reviewModal');
        } else {
            alert('Error saving review. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Server error.');
    });
});


//Get user location and share it
function shareLocationBtn(callback) {
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

function handleEmergencyBooking(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    shareLocationBtn(location => {
        if (location) {
            formData.set('latitude', location.latitude);
            formData.set('longitude', location.longitude);
        }

        fetch('save_emergency.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                closeModal('emergencyModel');
                alert('Thank you! Our agent will call you shortly.');
                form.reset();
            } else {
                alert('Failed to book emergency service.');
            }
        })
        .catch(error => {
            console.error('Booking error:', error);
            alert('Error submitting form.');
        });
    });
}

function handleLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
                document.getElementById('emergencyMap').style.display = 'block';
                document.getElementById('emergencyMap').innerHTML = `
                    <iframe width="100%" height="100" frameborder="0"
                        src="https://maps.google.com/maps?q=${position.coords.latitude},${position.coords.longitude}&z=15&output=embed">
                    </iframe>`;
            },
            error => {
                alert('Could not get your location.');
            }
        );
    } else {
        alert('Geolocation is not supported by this browser.');
    }
}
