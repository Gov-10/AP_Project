<?php
include('database.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $sql = "SELECT * FROM patients WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1) 
    {
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user['email'])) {
            echo "<script>alert('Login Successful! Welcome, " . $user['name'] . "');</script>";
        } 
        else 
        {
            echo "<script>alert('Login successfull');</script>";
        }
    } 
    else 
    {
        echo "<script>alert('login successfull');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medical Services</title>
 <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body {
    font-family: Arial, sans-serif;
    background: url('pexels-photo-8621905.jpeg') center/cover no-repeat, 
                url('pexels-photo-8621905.jpeg') center/cover no-repeat;
    background-attachment: fixed;
    height: 200vh;
    scroll-snap-type: y mandatory;
    overflow-x: hidden;
    scroll-behavior: smooth;
  }
  
  .top-bar {
    width: 100%;
    display: flex;
    justify-content: space-between;
    background: rgba(0, 0, 0, 0.7);
    padding: 15px 80px;
    position: sticky;
    top: 0;
    z-index: 1000;
  }
  
  .top-bar nav {
    display: flex;
    justify-content: space-between;
    flex: 1;
  }
  
  .top-bar a {
    flex: 1;
    text-align: center;
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    transition: color 0.3s;
  }
  
  .top-bar a:hover {
    color: #00bcd4;
  }
  
  .page {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 40px 120px;
    scroll-snap-align: start;
  }
  
  .page1-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 80px;
  }
  
  .intro-content {
    flex: 1;
    width: 600px;
    height: 750px;
    padding: 40px;
    border-radius: 10px;
    color: black;
    font-size: 20px;
    background-color: rgba(0, 0, 0, 0.6);
    text-align: left;
    line-height: 1.8;
  }
  
  .intro-content h1 {
    color: white;
    font-family: 'Times New Roman', serif;
    font-size: 40px;
    margin-bottom: 20px;
  }
  
  .intro-content p {
    color: white;
    font-size: 18px;
    padding: 20px;
    line-height: 1.6;
    margin-bottom: 20px;
  }

  
  .announcement-box {
    width: 350px;
    height: 750px;
    background: rgba(255, 255, 255, 0.95);
    padding: 25px;
    border: 2px solid #0077cc;
    border-radius: 10px;
    color: black;
  }
  
  .announcement-box h3{
    text-align: center;
    font-size: 25px;
  }
  
  .announcement-box ul {
    list-style: none;
  }
  
  .announcement-box li {
    margin-bottom: 10px;
  }
  
  .announcement-box a {
    color: #0077cc;
    text-decoration: none;
  }
  
  .announcement-box a:hover {
    text-decoration: underline;
  }
  
  .slider-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
  }
  
  .arrow {
    background-color: white;
    color: #0077cc;
    font-size: 28px;
    padding: 10px;
    border: 2px solid #0077cc;
    border-radius: 50%;
    cursor: pointer;
  }
  
  .slide {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.9);
    color: black;
    padding: 30px;
    border-radius: 10px;
    width: 1000px;
    height: 500px;
    margin: 0 auto;
  }
  
  .slide-text {
    flex: 1;
    padding-right: 20px;
  }

  .slide-text h2{
    text-align: center;
    padding: 10px;
  }
  
  .slide-image img {
    width: 500px;
    height: auto;
    border-radius: 10px;
  }
  
  .find-btn {
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #0077cc;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    
  }
  
  .popup {
    position: fixed;
    display: none;
    justify-content: center;
    align-items: center;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    z-index: 2000;
  }
  
  .popup-content {
    background: white;
    color: black;
    padding: 25px;
    border-radius: 10px;
    text-align: center;
    position: relative;
  }
  
  .close-btn {
    position: absolute;
    right: 10px;
    top: 5px;
    font-size: 25px;
    cursor: pointer;
  }

  .down-arrow {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 40px;
    color: white;
    text-decoration: none;
    animation: bounce 2s infinite;
  }
  
  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
      transform: translateX(-50%) translateY(0);
    }
    40% {
      transform: translateX(-50%) translateY(-10px);
    }
    60% {
      transform: translateX(-50%) translateY(-5px);
    }
  }
  .element {
    font-size: 18px;
    font-family: 'Orbitron', sans-serif;
    margin: 0 10px;
    text-decoration: none;
    transition: 0.3s ease;
    position: relative;
    padding: 6px 10px;
  }
  .element:hover {
    transform: scale(1.1);
  }
  .element::after {
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    left: 50%;
    bottom: -5px;
    background: cyan;
    transition: width 0.3s ease, left 0.3s ease;
  }
  .element:hover::after {
    width: 100%;
    left: 0;
  }
 </style>
</head>
<body>

<header class="top-bar">
  <nav>
    <a href="Emergency_Form_html.html" class="element">Emergency</a>
    <a href="hospitals_enrolled_html.html" class="element">Find Hospitals</a>
    <a href="patient_info_html.html" class="element">Medical Record</a>
    <a href="about_aima_html.html" class="element">About Us</a>
  </nav>
</header>

<section class="page page1">
    <a href="#page2" class="down-arrow">&#8595;</a>
  <div class="page1-container">
    <div class="intro-content">
      <h1>Introduction</h1>
      <hr>
      <p>The All India Management Association (AIMA) is the national apex body of the management profession in India, a not-for-profit, non-lobbying organization established in 1957, working with industry, government, academia, and students to advance management in India.</p>
    </div>

    <div class="announcement-box">
      <pre>
        <h3>Announcement</h3>
      <hr>
      <ul>
        <li><a href="https://nha.gov.in/PM-JAY">Pradhan Mantri Jan Arogya Yojna</a></li>
        <li><a href="https://abdm.gov.in/">Info About Ayushman Bharat Yojna</a></li>
        <li><a href="https://www.mygov.in/aarogya-setu-app/">Arogya Setu Mobile App Released</a></li>
        <li><a href="https://nha.gov.in/">National Health Authority</a></li>
        <li><a href="https://www.cghs.mohfw.gov.in/AHIMSG5/hissso/Login">Central Government Health Scheme</a></li>
        <li><a href="https://nvhcp.mohfw.gov.in/">National Hepatitis Control Program</a></li>
        <li><a href="https://www.india.gov.in/website-healthcare-workforce-mobility">Healthcare Workforce Mobility</a></li>
      </ul>
      </pre>
    </div>
  </div>
</section>

<section class="page page2" id="page2">
  <div class="slider-container">
    <button class="arrow" id="prevBtn">&#8592;</button>
    <div class="slide" id="slideContent">
      <div class="slide-text">
        <h2>Cardiology</h2>
        <p>Cardiology is a multidimensional subspecialty that deals with disorders of the heart and blood vessels.</p>
        <button class="find-btn" onclick="showHospitals()">Find Hospitals</button>
      </div>
      <div class="slide-image">
        <img id="slideImage" src="https://images.unsplash.com/photo-1588776814546-9e146a1a2f86" alt="Medical Specialty">
      </div>
    </div>
    <button class="arrow" id="nextBtn">&#8594;</button>
  </div>
</section>

<div id="hospitalPopup" class="popup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">&times;</span>
    <h3>Popular Cities:</h3>
    <ul>
      <li>Delhi</li>
      <li>Mumbai</li>
      <li>Bangalore</li>
      <li>Hyderabad</li>
      <li>Chennai</li>
    </ul>
  </div>
</div>

<script>
const specialties = [
  {
    title: "Cardiology",
    desc: "Cardiology is a multidimensional subspecialty that deals with disorders of the heart and blood vessels.",
    img: "cardiology.jpg"
  },
  {
    title: "Ophthalmology",
    desc: "Ophthalmology focuses on the diagnosis and treatment of eye disorders and vision care.",
    img: "Ophthalmology.jpg"
  },
  {
    title: "Orthopaedic",
    desc: "Orthopaedic deals with conditions involving the musculoskeletal system.",
    img: "orthopaedic.jpg"
  },
  {
    title: "Orthodontics",
    desc: "Orthodontics specializes in correcting teeth and jaw alignment.",
    img: "orthodontic.jpg"
  },
  {
    title: "Radiology",
    desc: "Radiology involves the use of imaging to diagnose and treat diseases.",
    img: "radiology.jpg"
  }
];

let currentIndex = 0;

const slideContent = document.getElementById('slideContent');
const slideImage = document.getElementById('slideImage');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

nextBtn.addEventListener('click', () => {
  currentIndex = (currentIndex + 1) % specialties.length;
  updateSlide();
});

prevBtn.addEventListener('click', () => {
  currentIndex = (currentIndex - 1 + specialties.length) % specialties.length;
  updateSlide();
});

function updateSlide() {
  document.querySelector('.slide-text h2').innerText = specialties[currentIndex].title;
  document.querySelector('.slide-text p').innerText = specialties[currentIndex].desc;
  document.getElementById('slideImage').src = specialties[currentIndex].img;
}

function showHospitals() {
  document.getElementById('hospitalPopup').style.display = 'flex';
}

function closePopup() {
  document.getElementById('hospitalPopup').style.display = 'none';
}
</script>

</body>
</html>