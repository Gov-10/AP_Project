const hospitalData = {
    mumbai: [
      "Fortis Hospital",
      "Jaslok Hospital",
      "Lilavati Hospital",
      "Hinduja Hospital",
      "Kokilaben Dhirubhai Ambani Hospital"
    ],
    delhi: [
      "AIIMS Delhi",
      "Max Super Specialty Hospital",
      "Apollo Hospitals",
      "Fortis Escorts Heart Institute",
      "Sir Ganga Ram Hospital"
    ],
    bangalore: [
      "Manipal Hospital",
      "Narayana Health",
      "Columbia Asia Hospital",
      "Sakra World Hospital",
      "Fortis Hospital, Bannerghatta Road"
    ],
    chennai: [
      "Apollo Hospitals",
      "MIOT International",
      "Fortis Malar Hospital",
      "Sri Ramachandra Medical Centre",
      "Global Hospitals"
    ],
    kolkata: [
      "AMRI Hospital",
      "Fortis Hospital, Anandapur",
      "Apollo Gleneagles Hospital",
      "Peerless Hospital",
      "Medica Superspecialty Hospital"
    ]
  };
  
  function updateHospitals() {
    const city = document.getElementById("citySelector").value;
    const hospitalList = document.getElementById("hospitalList");
    hospitalList.innerHTML = "";
  
    if (hospitalData[city]) {
      hospitalData[city].forEach(hospital => {
        const li = document.createElement("li");
        li.textContent = hospital;
        hospitalList.appendChild(li);
      });
    }
  }