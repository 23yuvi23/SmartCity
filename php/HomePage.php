<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Citizen Complaint Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
  
  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #5e72c8, #9a47f2);
    }
  </style>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="gradient-bg p-4 shadow-lg">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-white text-2xl font-bold">Citizen Complaint Portal</h1>
    <div class="space-x-4">
      <a href="index.html" class="text-white hover:underline">Home</a>
      <a href="signup.html" class="text-white hover:underline">Signup</a>
      <a href="login.html" class="text-white hover:underline">Login</a>
    </div>
  </div>
</nav>


<!-- carousel -->
 
 <div id="carouselExampleFade" class="carousel slide carousel-fade">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="Assets/1.png" class="d-block w-100" alt="First slide">
      </div>
      <div class="carousel-item">
        <img src="Assets/2.png" class="d-block w-100" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img src="Assets/3.png" class="d-block w-100" alt="Third slide">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

<!-- Hero Section -->
<section class="text-center py-20">
  <h2 class="text-4xl font-bold text-black">Empowering Citizens, Simplifying Solutions</h2>
  <p class="mt-4 text-lg text-black">Report your civic issues and track your complaint anytime, anywhere.</p>
  <div class="mt-6">
    <button onclick="RegisterComplaint()" class="bg-white text-purple-600 px-6 py-2 rounded-lg hover:bg-gray-200">Register Complaint</button>
    <button onclick="window.location.href='tracking_system.html'" class="ml-4 bg-white text-pink-600 px-6 py-2 rounded-lg hover:bg-gray-200">Track Complaint</button>
  </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-10">
  <h3 class="text-3xl text-center font-bold text-purple-600">Why Choose Us?</h3>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6 px-10">
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
      <h4 class="font-bold text-xl">Secure Platform</h4>
      <p class="text-gray-600">Your data is fully encrypted and secure.</p>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
      <h4 class="font-bold text-xl">Real-time Tracking</h4>
      <p class="text-gray-600">Track complaint status anytime.</p>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
      <h4 class="font-bold text-xl">Transparent Process</h4>
      <p class="text-gray-600">No hidden steps, fully visible process.</p>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
      <h4 class="font-bold text-xl">Feedback System</h4>
      <p class="text-gray-600">Share your experience easily.</p>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="gradient-bg p-4 text-center text-white">
  © 2025 Citizen Complaint Portal | All Rights Reserved
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="app.js"></script>
</body>
</html>
