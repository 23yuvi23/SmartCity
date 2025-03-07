// login page
// function login() {
//     const email = document.getElementById('email').value;
//     const password = document.getElementById('password').value;
  
//     if (email === '' || password === '') {
//       alert('Please fill in all fields');
//       return;
//     }
  
//     // Store login status in local storage
//     localStorage.setItem('isLoggedIn', 'true');
//     alert(`Login successful for ${email}`);
//     window.location.href = 'HomePage.html'; // Redirect to homepage after login
//   }


// Static Login Credentials (Only for Frontend Checking Purpose)
const users = [
  { email: "admin@gmail.com", password: "admin123" },
  { email: "user@gmail.com", password: "user123" }
];

function login() {
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();

  if (email === '' || password === '') {
    alert('Please fill in all fields');
    return;
  }

  // Find user from static array
  const user = users.find(user => user.email === email && user.password === password);

  if (user) {
    localStorage.setItem('isLoggedIn', 'true');
    alert(`Login successful for ${email}`);
    window.location.href = 'HomePage.html'; // Redirect to homepage after login
  } else {
    alert('Invalid Email or Password!');
  }
}

  
  //signup page 
  function signup() {
    const email = document.getElementById('email').value;
    const username = document.getElementById('username').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;
  
    if (email === '' || username === '' || phone === '' || password === '') {
      alert('Please fill in all fields');
      return;
    }
  
    alert(`Signup successful for ${username}`);
    window.location.href = 'login.html'; // Redirect to login page after signup
  }
  
  // connection bw signup and login page 
  function goToSignup() {
    window.location.href = "signup.html"; // Page ko signup pr le jayega
  }
  
  function goToLogin() {
    window.location.href = "login.html"; // Page ko login pr le jayega
  }
  
  //carousel
  let currentIndex = 0;
  const slides = document.querySelector('.carousel');
  const totalSlides = slides ? slides.children.length : 0;
  
  function showSlide(index) {
    if (totalSlides === 0) return;
    if (index >= totalSlides) {
      currentIndex = 0;
    } else if (index < 0) {
      currentIndex = totalSlides - 1;
    } else {
      currentIndex = index;
    }
    slides.style.transform = `translateX(-${currentIndex * 100}%)`;
  }
  
  function nextSlide() {
    showSlide(currentIndex + 1);
  }
  
  function prevSlide() {
    showSlide(currentIndex - 1);
  }
  
  //forms
  function RegisterComplaint() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    if (isLoggedIn === 'true') {
      window.location.href = "complaint_form.html";
    } else {
      alert('Please login to register a complaint');
      window.location.href = "login.html";
    }
  }
  
  function TaskComplaint() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    if (isLoggedIn === 'true') {
      trackComplaint();
    } else {
      alert('Please login to track your complaint');
      window.location.href = "login.html";
    }
  }
  
  // Complaint Tracking System
  function trackComplaint() {
    const statusArray = [
      'Complaint Submitted',
      'Complaint Assigned',
      'In Progress',
      'Resolved'
    ];
    let currentStatusIndex = 0;
  
    const interval = setInterval(() => {
      alert(`Current Status: ${statusArray[currentStatusIndex]}`);
      currentStatusIndex++;
  
      if (currentStatusIndex >= statusArray.length) {
        clearInterval(interval);
        setTimeout(() => {
          alert('Complaint Resolved');
          window.location.href = 'feedback_form.html'; // Redirect to feedback form
        }, 1000);
      }
    }, 3000); // Simulates status update every 3 seconds
  }
  
  // Logout Function
  function logout() {
    localStorage.removeItem('isLoggedIn');
    alert('You have been logged out');
    window.location.href = 'login.html';
  }
  

  //admin
  function adminLogin() {
    const adminUsername = prompt('Enter Admin Username:');
    const adminPassword = prompt('Enter Admin Password:');

    if (adminUsername === 'admin' && adminPassword === 'admin123') {
      localStorage.setItem('isAdmin', 'true');
      alert('Welcome Admin!');
      window.location.href = 'admin_dashboard.html';
    } else {
      alert('Access Denied! Invalid Credentials');
    }
  }

  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
  }


  // <!-- JavaScript for Star Ratings -->
  
      function setupStarRating(starClass, inputId) {
          const stars = document.querySelectorAll(`.${starClass}`);
          const ratingInput = document.getElementById(inputId);

          stars.forEach(star => {
              star.addEventListener('click', () => {
                  const value = star.getAttribute('data-value');
                  ratingInput.value = value;

                  // Reset all stars
                  stars.forEach(s => s.classList.remove('active'));

                  // Highlight selected stars
                  stars.forEach((s, index) => {
                      if (index < value) {
                          s.classList.add('active');
                      }
                  });
              });
          });
      }

      // Initialize star ratings
      setupStarRating('satisfaction-star', 'satisfactionRatingValue');
      setupStarRating('service-star', 'serviceRatingValue');


     

    //random complaint number generator 

    document.addEventListener("DOMContentLoaded", function () {
      const form = document.querySelector("form");
      const complaintID = document.querySelector("#complaintID");
    
      function generateComplaintID() {
        let date = new Date();
        let timestamp = date.getTime();
        let randomNum = Math.floor(Math.random() * 1000);
        complaintID.value = `SC${timestamp}${randomNum}`;
      }
      
      generateComplaintID();
    
      function generateDocFile(data) {
        let content = `
        Complaint ID: ${data.id}
        Name: ${data.name}
        Email: ${data.email}
        Contact: ${data.contact}
        Issue Type: ${data.issueType}
        Location: ${data.location}
        Description: ${data.description}
        Date: ${data.date}
        `;
    
        const blob = new Blob([content], { type: "application/msword" });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = `${data.id}.docx`;
        a.click();
        window.URL.revokeObjectURL(url);
      }
    
      form.addEventListener("submit", function (e) {
        e.preventDefault();
    
        const data = {
          id: complaintID.value,
          name: document.getElementById("name").value,
          email: document.getElementById("email").value,
          contact: document.getElementById("contact").value,
          issueType: document.getElementById("issueType").value,
          location: document.getElementById("location").value,
          description: document.getElementById("description").value,
          date: document.getElementById("date").value,
        };
    
        if (data.name && data.email && data.contact && data.issueType !== "Select Issue") {
          generateDocFile(data);
          alert(`Complaint Submitted Successfully!\nYour Complaint ID is: ${data.id}`);
          form.reset();
          generateComplaintID(); // Generate new ID on reset
        } else {
          alert("Please fill all the required fields!");
        }
      });
    });
    
    // map wala jhamela 
    // Initialize the map and set the initial view (latitude, longitude, zoom level)
    var map = L.map('map').setView([51.505, -0.09], 13);  // Coordinates for your location

    // Add OpenStreetMap tile layer to the map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add a marker on the map (you can customize the coordinates)
    L.marker([30.2724, 78.0010])
    .addTo(map)
      .bindPopup("<b>Our Office</b><br>123 Smart Street, Tech City")
      .openPopup();


  // popup that show after contact us is submitted successfully 
  function handleSubmit(event) {
    event.preventDefault(); // Prevents the form from submitting the default way (refreshing the page)
    
    // Show a popup message
    alert("Your complaint has been registered.");
    
    // You can add further code here to process the form or reset it, if needed
  }