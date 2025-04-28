<?php
   include("database.php");
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
    $phone_number = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO patients(name, age, gender, location, phone_number, email, password) VALUES ('$name', '$age', '$gender', '$location', '$phone_number', '$email', '$hash')";
    mysqli_query($conn, $sql);
    echo "<script>alert('Thanks for reaching us out!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medical Services</title>
  <link rel="stylesheet" href="landing_css.css">
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
        <li><a href="#">Pradhan Mantri Jan Arogya Yojna</a></li>
        <li><a href="#">Info About Ayushman Bharat Yojna</a></li>
        <li><a href="#">Arogya Setu Mobile App Released</a></li>
        <li><a href="#">National Health Authority</a></li>
        <li><a href="#">Central Government Health Scheme</a></li>
        <li><a href="#">National Hepatitis Control Program</a></li>
        <li><a href="#">Healthcare Workforce Mobility</a></li>
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