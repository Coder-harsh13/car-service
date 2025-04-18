
function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
}

// Modal functions
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// Form handlers
function handleLogin(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    console.log('Login attempt:', Object.fromEntries(formData));
    closeModal('loginModal');
    alert('Login functionality will be implemented soon!');
}

function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
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

function handleContact(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    console.log('Contact form:', Object.fromEntries(formData));
    event.target.reset();
    alert('Thank you for your message! We will get back to you soon.');
}

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

//service details
const scriptURL = 'https://script.google.com/macros/s/AKfycbxik8VY-OyZbTW9HCsNF5-fADs-IRX82WERhBme0xN3MYEbfTmRCxbRTB_qyvrMTmot/exec'
  const form = document.forms['submit-to-google-sheet']

  form.addEventListener('submit', e => {
    e.preventDefault()
    fetch(scriptURL, { method: 'POST', body: new FormData(form)})
      .then(response => console.log('Success!', response))
      .catch(error => console.error('Error!', error.message))
  });
