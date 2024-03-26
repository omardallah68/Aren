<script>
/*
const header = document.querySelector("header");
const first = document.querySelector(".first");
const aboutMe = document.querySelector(".aboutMe");
const turn = document.querySelector(".turn");

document.addEventListener("scroll", () => {
    const vh = window.pageYOffset;
    if (vh >= 100) {
        header.style.transform = "translateY(0px)";
    }
    if (vh < 100) {
        header.style.transform = "translateY(-100px)";
    }
    if (vh >= 300) {
        first.style.transform = "translateY(300px)";
        /!*first.style.textShadow= "#f0c31f 0px 1px 3px"*!/
        first.style.textShadow =
            "0px 0px #888, 0px 0px #666, 0px 0px #444, 0px 0px #222";
        first.style.backgroundColor = "#000000cc";
    }
    if (vh < 300) {
        first.style.transform = "rotateX(315deg) rotateZ(45deg)";
        first.style.textShadow =
            "1px 1px #888, 2px 2px #666, 3px 3px #444, 4px 4px #222";
        first.style.backgroundColor = "transparent";
    }
});

const card = document.querySelectorAll(".card");
const turnIcon = document.querySelector(".turn span");

turn.addEventListener("click", () => {
    card.forEach((i) => {
        const cardDetails = i.querySelectorAll(".cardDetails");
        const cardTitle = i.querySelectorAll(".cardTitle");
        cardDetails.forEach((f) => {
            cardTitle.forEach((x) => {
                if (f.style.display === "flex") {
                    f.style.display = "none";
                    x.style.display = "flex";
                    i.style.boxShadow = "inset 0px 0px 1px 0px #f0c31f";
                    /!*turnIcon.className="fa-regular fa-face-flushed"*!/
                } else {
                    f.style.display = "flex";
                    x.style.display = "flex";
                    i.style.boxShadow = "inset 0px 0px 50px -10px #f0c31f";
                    /!*turnIcon.className="fa-solid fa-face-flushed"*!/
                }
            });
        });
    });
});

card.forEach((elem) => {
    const cardDetails = elem.querySelectorAll(".cardDetails");
    const cardTitle = elem.querySelectorAll(".cardTitle");
    elem.addEventListener("click", () => {
        cardDetails.forEach((elm) => {
            cardTitle.forEach((el) => {
                if (elm.style.display === "flex") {
                    elm.style.display = "none";
                    el.style.display = "flex";
                    elem.style.boxShadow = "inset 0px 0px 1px 0px #f0c31f";
                } else {
                    elm.style.display = "flex";
                    el.style.display = "none";
                    elem.style.boxShadow = "inset 0px 0px 50px -10px #f0c31f";
                }
            });
        });
    });
});



*/


/*

const flipCard = document.querySelectorAll(".flip-card-inner")
flipCard.forEach((er) =>{
  const flipCardBack = er.querySelector(".flip-card-back")
  const fCA= er.querySelector(".back")
  const btnO= er.querySelector(".show")

  er.addEventListener("mouseover",()=>{
    er.style.display="flex"
    flipCardBack.style.display="flex"
  })

  flipCardBack.addEventListener("mouseout",()=>{
      fCA.style.display="none"
      fCA.style.transform="rotate3D(0, 1, 0, 0deg)"
      flipCardBack.style.transform="rotate3D(0, 1, 0, 180deg)"
  })

  btnO.addEventListener("click", ()=>{
    console.log(flipCardBack)
    if(fCA.style.display=== "flex"){
      fCA.style.display="none"
      fCA.style.transform="rotate3D(0, 1, 0, 0deg)"
      flipCardBack.style.transform="rotate3D(0, 1, 0, 180deg)"
   }
    else{
       fCA.style.display = "flex";
    fCA.style.transform="rotate3D(0, 1, 0, 180deg) rotate3d(0, 1, 0, 315deg) translate3d(-163px, 0px, -70px)";
      flipCardBack.style.transform="rotate3D(0, 1, 0, 180deg) rotate3d(0, 1, 0, 45deg)"
    }
  })



})*/








/*

/*
const flipCard = document.querySelectorAll(".flip-card-back")

flipCard.forEach(e => {
  const flipCardInner = document.querySelectorAll(".flip-card-front")
  flipCardInner.forEach(o =>{
    e.addEventListener("mouseover", () => {
      e.style.filter="blur(0px)"
      o.style.filter="blur(5px)"
    })
    e.addEventListener("mouseout", () => {
      e.style.filter="blur(0px)"
      o.style.filter="blur(0px)"
    })
  })
})
*/

/*

/*
document.querySelectorAll(".card").forEach(elem =>
elem.addEventListener("click",() => {
   const det = elem.querySelectorAll(".cardDetails").forEach(elm =>
    elm.style.display = "none")
  })
)*/

/*
for (i = 0; i < card.length; i++) {


      console.log(card.item(i))
      for (f = 0; f < cardDetails.length; f++) {
        console.log(f)
        card.item(i).addEventListener('mouseover',()=>{
        return cardDetails.item(f).style.display="flex"
        })

      console.log(cardDetails.item(f))
      }
}*/
/*
card.item().forEach(item=>{
  /*cardTitle.forEach((title)=>{*//*
    cardDetails.forEach(details=>{
      item.addEventListener('mouseover',()=>{
        details.style.display="flex"
      })
    })
  })
/*})
*/

</script>

<template>
    <div>
        <header id="header">
            <a href="#" class="headerName">Omar Dallah</a>
            <nav>
                <a href="#aboutMe">Über mich</a>
                <a href="#timeLine">Zeitachse</a>
                <a href="#projects">Projekte</a>
                <a href="#contactMe">Kontakt</a>
            </nav>
        </header>
        <section class="home">
            <div id="particles-js">
                <p class="first">
                    Hallo, mein Name ist <span>Omar Dallah, </span>ich mache gerade eine Einstiegsqualifizierungsjahr
                    bei Firma axaris software & systeme GmbH
                </p>
            </div>
        </section>
        <section class="aboutMe" id="aboutMe">
            <h1 class="title">Über mich</h1>
            <button class="turn">
                <span title="Klicken Sie hier">**</span>
            </button>
            <div class="cards">
                <div class="card">
                    <h3 class="cardTitle">Geburt</h3>
                    <p class="cardDetails">am 06.08.2002</p>
                    <p class="cardDetails">in Damaskus, Syrien</p>
                </div>

                <div class="card">
                    <h3 class="cardTitle">Anschrift</h3>
                    <p class="cardDetails">Untere Sonnenbühlstr. 2</p>
                    <p class="cardDetails">89173 Lonsee</p>
                </div>

                <div class="card">
                    <h3 class="cardTitle">Sprachkenntnisse</h3>
                    <p class="cardDetails">Arabisch (Muttersprache),</p>
                    <p class="cardDetails">Deutsch (C1)</p>
                    <p class="cardDetails">und Englisch</p>
                </div>

                <div class="card">
                    <h3 class="cardTitle">EDV-Kenntnisse</h3>
                    <p class="cardDetails">Microsoft Office Programme,</p>
                    <p class="cardDetails">Adobe Programme,</p>
                    <p class="cardDetails">Blender,</p>
                    <p class="cardDetails">HTML,</p>
                    <p class="cardDetails">CSS,</p>
                    <p class="cardDetails">JavaScript,</p>
                    <p class="cardDetails">Node.js,</p>
                    <p class="cardDetails">MongoDB,</p>
                    <p class="cardDetails">C#,</p>
                    <p class="cardDetails">My SQL,</p>
                    <p class="cardDetails">PHP</p>
                    <p class="cardDetails">Laravel</p>
                    <p class="cardDetails">Vue.js</p>
                    <p class="cardDetails">und Inertia.js</p>
                </div>

                <div class="card">
                    <h3 class="cardTitle">Hobbys</h3>
                    <p class="cardDetails">Zeichnen,</p>
                    <p class="cardDetails">Fußball spielen</p>
                    <p class="cardDetails">und Musik hören</p>
                </div>

                <div class="card">
                    <h3 class="cardTitle">Führerschein</h3>
                    <p class="cardDetails">Klasse B</p>
                </div>
            </div>
        </section>

        <section class="timeLine" id="timeLine">
            <h1 class="title">Zeitachse</h1>
            <div class="timeline">
                <div class="container left">
                    <div class="content">
                        <h2>09.2022 - aktuell</h2>
                        <p>Einstiegsqualifizierung (EQ), axaris software & systeme GmbH</p>
                        <p class="infoo">
                            Robert Bosch Schule-Berufsschule, Ulm, erstes Jahr als FISI
                        </p>
                    </div>
                </div>

                <div class="container right">
                    <div class="content">
                        <h2>03.2022 - 07.2022</h2>
                        <p>C1 - Deutschkurs, vh Ulm</p>
                    </div>
                </div>

                <div class="container left">
                    <div class="content">
                        <h2>01.2022 - 06.2022</h2>
                        <p>Projekt Explorer, Institut Faktori, Ulm</p>
                    </div>
                </div>

                <div class="container right">
                    <div class="content">
                        <h2>04.2021 - 09.2021</h2>
                        <p>B2 - Deutschkurs, VHS Künzelsau</p>
                    </div>
                </div>

                <div class="container left">
                    <div class="content">
                        <h2>02.2020 - 03.2021</h2>
                        <p>Integrationskurs, VHS Künzelsau</p>
                    </div>
                </div>

                <div class="container right">
                    <div class="content">
                        <h2>09.2017 - 06.2019</h2>
                        <p>Wahbe Wahbe-Oberstufe, Damaskus</p>
                        <p class="infoo">
                            Anerkannter Abschluss der Mittleren Reife durch das
                            Regierungspräsidium Stuttgart
                        </p>
                    </div>
                </div>

                <div class="container left">
                    <div class="content">
                        <h2>08.2018 - 11.2018</h2>
                        <p>Motion Grafik Kurs, Damaskus Universität</p>
                    </div>
                </div>

                <div class="container right">
                    <div class="content">
                        <h2>09.2014 - 06.2017</h2>
                        <p>Al-Aksa-Mittelschule, Damaskus</p>
                    </div>
                </div>
                <div class="container left">
                    <div class="content">
                        <h2>09.2008 - 06.2014</h2>
                        <p>Al-Nakab-Grundschule, Damaskus</p>
                    </div>
                </div>

                <div class="container right">
                    <div class="content">
                        <h2>06.08.2002</h2>
                        <p>Ich bin geboren</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="projects" id="projects">
            <h1 class="title">Projekte</h1>
            <div class="cards">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <p class="title">Allgemeine Praxis</p>
                            <p>Webseite</p>
                        </div>
                        <div class="flip-card-back">


                            <p class="title">Allgemeine Praxis</p>
                            <a href="https://allgemeine-praxis-update.omar-dallah.repl.co/"
                            >Visit it</a
                            >
                        </div>
                        <div class="back">
                            <p class="title">Allgemeine Praxis</p>
                            <img
                                class="praxisPhoto"
                                src="./allgemeinePraxisScreenShot.jpg"
                                alt="ScreenShot"
                            />
                        </div>


                    </div>
                </div>

                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <p class="title">Portfolio</p>
                            <p>Webseite</p>
                        </div>
                        <div class="flip-card-back">
                            <p class="title">Portfolio</p>
                        </div>
                        <div class="back">
                            <p class="title">Portfolio</p>

                        </div>
                    </div>
                </div>

                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <p class="title">Donat</p>
                            <p>build</p>
                        </div>
                        <div class="flip-card-back">
                            <p class="title">Donat</p>
                        </div>
                        <div class="back">
                            <p class="title">Donat</p>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contactMe" id="contactMe">
            <h1 class="title">Kontakt</h1>
            <div class="cards">
                <a href="mailto:omardallah68@gmail.com">
                    <div class="card email">E-Mail</div>
                </a>
                <a href="tel:+491779576859">
                    <div class="card telefonnummer">Telefonnummer</div>
                </a>
            </div>
        </section>


        <footer>
            <a class="footerName">Copy Right @ 2023</a>
            <nav>
                <a href="#aboutMe">Über mich</a>
                <a href="#timeLine">Zeitachse</a>
                <a href="#projects">Projekte</a>
                <a href="#contactMe">Kontakt</a>
            </nav>
        </footer>
    </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap");
:root {
    --color1: #f0c31f;

    --color2: #8eb920;
}

* {
    padding: 0px;
    margin: 0px;
    font-family: "Changa", "Poppins", "Josefin Sans", "Kdam Thmor Pro",
    "Patrick Hand", "cursive";
    scroll-behavior: smooth;
    box-sizing: border-box;

    -webkit-user-select: none; /* Safari */
    -ms-user-select: none; /* IE 10 and IE 11 */
    user-select: none; /* Standard syntax */
}

* a {
    text-decoration: none;
    color: #fff;
}

body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

body::-webkit-scrollbar {
    width: 10px;
}
body::-webkit-scrollbar-track {
    background: #161616;
}

body::-webkit-scrollbar-thumb {
    background-color: #f0c31f;
    border-radius: 50px;
    border: 2px solid #161616;
}

header {
    display: flex;
    width: 100%;
    z-index: 10;
    justify-content: space-between;
    color: #161616;
    background-color: #f0c31f;
    transition: 0.5s ease-in-out;
}

footer {
    display: flex;
    justify-content: space-around;
    height: 100px;
    background-color: #666666;
    padding: 0px 100px;
}

.headerName {
    margin-left: 200px;
    padding: 10px;
    font-size: 30px;
    align-items: center;
    margin-top: 15px;
    margin-bottom: 15px;
    letter-spacing: 2px;
    text-decoration: none;
    color: #161616;
}

.footerName {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffffa6;
}

nav {
    display: flex;
    margin-right: 200px;
    margin-top: 15px;
    margin-bottom: 15px;
}

nav a {
    display: flex;
    padding: 10px;
    align-items: center;
    letter-spacing: 1px;
    text-decoration: none;
    color: #161616;
}

footer nav{
    margin-right: 0;
}

footer nav a{
    color: #ffffffa6;
}

.home {
    padding-bottom: 0px;
    padding-top: 0px;
}

section {
    padding-bottom: 100px;
    padding-top: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 100%;
    min-height: 100vh;
}

.first {
    display: flex;
    align-items: flex-start;
    font-size: 30px;
    flex-direction: column;
    transform: rotateX(315deg) rotateZ(45deg);
    text-shadow: 1px 1px #888, 2px 2px #666, 3px 3px #444, 4px 4px #222;
    letter-spacing: 3px;
    transition: 0.5s ease-in-out;
    color: #fff;
    position: absolute;
    cursor: default;
    pointer-events: none;
    z-index: 0;
    padding: 30px;
    max-width: 815px;
}

.first:hover {
    transform: scale(1.1) rotateX(315deg) rotateZ(45deg);
    text-shadow: 1px 1px #888, 2px 2px #666, 3px 3px #444, 4px 4px #222;
}

.title {
    color: #f0c31f;
    letter-spacing: 3px;
    margin: 50px;
}

.projects .title{
    margin-bottom: 200px;
}

.turn {
    width: 250px;
    height: 100px;
    border: none;
    background: linear-gradient(
        120deg,
        #161616 30%,
        #f0c31f 38%,
        #f0c31f 40%,
        #161616 48%
    );
    color: #161616;
    background-size: 200% 100%;
    background-position: 100% 0;
    animation: load89234 1s infinite;
}

.turn i {
    font-size: 30px;
    color: #f0c31f;
}

#particles-js {
    width: 100%;
    height: 100%;
    display: contents;
}

.particles-js-canvas-el {
    height: 1150px !important;
}

.aboutMe {
}

.cards {
    display: flex;
    align-items: flex-start;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    transition: 0.4s ease-in-out;
}

.card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 50px;
    margin: 50px;
    width: 500px;
    height: 500px;
    box-shadow: inset 0px 0px 1px 0px #f0c31f;
    color: #f0c31f;
    letter-spacing: 3px;
    /*border-radius: 500px;
      background-color: #fff;
      box-shadow: inset 0px 20px 10px 0px rgb(0 0 0 / 50%);*/
}

.card h3 {
    padding: 10px;
}

.cardDetails {
    display: flex;
}
/*
.card:hover{
  width: 500px;
  height: 500px;
}

.card:hover .cardDetails{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}*/

/* The actual timeline (the vertical ruler) */
.timeline {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
}

/* The actual timeline (the vertical ruler) */
.timeline::after {
    content: "";
    position: absolute;
    width: 6px;
    background-color: white;
    top: 0;
    bottom: 80px;
    left: 50%;
    margin-left: -3px;
    border-radius: 10px;
}

/* Container around content */
.container {
    padding: 10px 40px;
    position: relative;
    background-color: inherit;
    width: 50%;
}

/* The circles on the timeline */
.container::after {
    content: "";
    position: absolute;
    width: 25px;
    height: 25px;
    right: -17px;
    background-color: white;
    border: 4px solid #f0c31f;
    top: 15px;
    border-radius: 50%;
    z-index: 1;
}

/* Place the container to the left */
.left {
    left: 0;
}

.left .content {
    right: 138%;
}
/* Place the container to the right */
.right {
    left: 50%;
}

/* Add arrows to the left container (pointing right) */
.left::before {
    content: " ";
    height: 0;
    position: absolute;
    top: 22px;
    width: 0;
    z-index: 1;
    right: 30px;
    border: medium solid white;
    border-width: 10px 0 10px 10px;
    border-color: transparent transparent transparent white;
}

/* Add arrows to the right container (pointing left) */
.right::before {
    content: " ";
    height: 0;
    position: absolute;
    top: 22px;
    width: 0;
    z-index: 1;
    left: 30px;
    border: medium solid white;
    border-width: 10px 10px 10px 0;
    border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right::after {
    left: -16px;
}

/* The actual content */
.content {
    width: 500px;
    padding: 20px 20px;
    background-color: white;
    position: relative;
    border-radius: 6px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    flex-wrap: nowrap;
    justify-content: center;
}

.infoo {
    color: #16161666;
}

button {
    border: none;
    position: relative;
    width: 200px;
    height: 73px;
    padding: 0;
    z-index: 2;
    -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='868' width='2500' viewBox='0 0 726 252.17'%3E%3Cpath d='M483.92 0S481.38 24.71 466 40.11c-11.74 11.74-24.09 12.66-40.26 15.07-9.42 1.41-29.7 3.77-34.81-.79-2.37-2.11-3-21-3.22-27.62-.21-6.92-1.36-16.52-2.82-18-.75 3.06-2.49 11.53-3.09 13.61S378.49 34.3 378 36a85.13 85.13 0 0 0-30.09 0c-.46-1.67-3.17-11.48-3.77-13.56s-2.34-10.55-3.09-13.61c-1.45 1.45-2.61 11.05-2.82 18-.21 6.67-.84 25.51-3.22 27.62-5.11 4.56-25.38 2.2-34.8.79-16.16-2.47-28.51-3.39-40.21-15.13C244.57 24.71 242 0 242 0H0s69.52 22.74 97.52 68.59c16.56 27.11 14.14 58.49 9.92 74.73C170 140 221.46 140 273 158.57c69.23 24.93 83.2 76.19 90 93.6 6.77-17.41 20.75-68.67 90-93.6 51.54-18.56 103-18.59 165.56-15.25-4.21-16.24-6.63-47.62 9.93-74.73C656.43 22.74 726 0 726 0z'/%3E%3C/svg%3E")
    no-repeat 50% 50%;
    mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='868' width='2500' viewBox='0 0 726 252.17'%3E%3Cpath d='M483.92 0S481.38 24.71 466 40.11c-11.74 11.74-24.09 12.66-40.26 15.07-9.42 1.41-29.7 3.77-34.81-.79-2.37-2.11-3-21-3.22-27.62-.21-6.92-1.36-16.52-2.82-18-.75 3.06-2.49 11.53-3.09 13.61S378.49 34.3 378 36a85.13 85.13 0 0 0-30.09 0c-.46-1.67-3.17-11.48-3.77-13.56s-2.34-10.55-3.09-13.61c-1.45 1.45-2.61 11.05-2.82 18-.21 6.67-.84 25.51-3.22 27.62-5.11 4.56-25.38 2.2-34.8.79-16.16-2.47-28.51-3.39-40.21-15.13C244.57 24.71 242 0 242 0H0s69.52 22.74 97.52 68.59c16.56 27.11 14.14 58.49 9.92 74.73C170 140 221.46 140 273 158.57c69.23 24.93 83.2 76.19 90 93.6 6.77-17.41 20.75-68.67 90-93.6 51.54-18.56 103-18.59 165.56-15.25-4.21-16.24-6.63-47.62 9.93-74.73C656.43 22.74 726 0 726 0z'/%3E%3C/svg%3E")
    no-repeat 50% 50%;
    -webkit-mask-size: 100%;
    cursor: pointer;
    background-color: transparent;
    transform: translateY(8px);
}

button:after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    box-shadow: 0px 0 0 0 white;
    transition: all 2s ease;
}

button:hover:after {
    box-shadow: 0px -13px 56px 12px #ffffffa6;
}

button span {
    position: absolute;
    width: 100%;
    font-size: 15px;
    font-weight: 100;
    left: 0%;
    top: 30%;
    letter-spacing: 3px;
    text-align: center;
    color: #fff;
    transition: all 2s ease;
    animation: innerPulse934 1200ms ease-in-out;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    -webkit-animation-delay: 600ms;
    animation-delay: 600ms;
}

button:hover span {
    color: #161616;
}

button:before {
    content: "";
    position: absolute;
    width: 0;
    height: 100%;
    background-color: #f0c31f;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    transition: all 1s ease;
}

button:hover:before {
    width: 100%;
}

@keyframes innerPulse934 {
    0% {
        height: 250px;
        width: 250px;
    }

    50% {
        height: 258px;
        width: 258px;
    }

    100% {
        height: 250px;
        width: 250px;
    }
}

.flip-card {
    background-color: transparent;
    width: 450px;
    height: 500px;
    perspective: 1500px;
    font-family: sans-serif;
    margin: -110px;
    margin-top: 0;
    transition: 0.4s ease-in-out;
}

.flip-card .title {
    font-size: 1.5em;
    font-weight: 900;
    text-align: center;
    margin: 0px;
}

.flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.8s;
    transform-style: preserve-3d;
    z-index: 1;
    transform: rotate3D(0, 1, 0, 55deg);
    perspective: 3500px;
}

.flip-card:hover .flip-card-inner {
    transform: rotate3D(0, 180, 0, 180deg);
}

.flip-card-front,
.flip-card-back {
    box-shadow: 0 8px 14px 0 rgba(0, 0, 0, 0.2);
    position: absolute;
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: 1rem;
}

.flip-card-front {
    color: #f0c31f;
    background: linear-gradient(
        120deg,
        #080808 30%,
        #f0c31f 38%,
        #f0c31f 40%,
        #080808 48%
    );
    background-size: 200% 100%;
    background-position: 100% 0;
    animation: load89234 2s infinite;
}

.flip-card-back {
    background: linear-gradient(
        120deg,
        #f0c31f 30%,
        #080808 38%,
        #080808 40%,
        #f0c31f 48%
    );
    color: #080808;
    transform: rotate3D(0, 195, 0, 195deg);
    background-size: 200% 100%;
    background-position: 100% 0;
    animation: load89234 2s infinite;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    align-items: center;
    transition: 0.4s ease-in-out;
    perspective: 3500px;
}

.flip-card-back .title {
    color: #080808;
}

.cards:hover .flip-card:not(:hover) {
    filter: blur(2px);
    opacity: 0.9;
}

.cards:hover .flip-card-front:not(:hover) {
    background: #080808;
}

.cards:hover .flip-card:hover {
    filter: blur(0px);
    opacity: 1;
    z-index: 2;
    transform: scale(1.1);
}

.flip-card:hover .flip-card-back {
    border-radius: 1rem 0  0 1rem;
    transform: rotate3D(0, 1, 0, 180deg) rotate3d(0, 1, 0, 45deg);
}

.flip-card:not(:hover) .flip-card-back {
    transform:rotate3D(0, 1, 0, 180deg);
}

.show{

    background: linear-gradient( 120deg, #f0c31f 30%, #161616 38%, #161616 40%, var(---color1) 48% );
    background-size: 200% 100%;
    background-position: 100% 0;
    animation: load89234 1s infinite;
}

.praxisPhoto {
    width: 350px;
    height: 200px;
    border-radius: 1rem;
}

.back{
    box-shadow: 0 8px 14px 0 rgb(0 0 0 / 20%);
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: 0 1rem 1rem 0;
    background: linear-gradient( 120deg, #080808 30%, #f0c31f 38%, #f0c31f 40%, #080808 48% );
    color: #080808;
    transform-origin: 0% 100%;
    transform: rotate3D(0, 1, 0, 0deg);
    overflow: visible;
    background-size: 200% 100%;
    background-position: 100% 0;
    animation: load89234 2s infinite;
    display: none;
    flex-direction: column;
    justify-content: space-evenly;
    align-items: center;
    transition: 0.4s ease-in-out;
    perspective: 3500px;
}
.flip-card-inner:hover .back {

    transform: rotate3D(0, 1, 0, 180deg) rotate3d(0, 1, 0, 315deg) translate3d(-163px, 0px, -70px);
    display: flex;
}

/*
.flip-card-back::after{
  content: "";
    color: #f0c31f;
    background:#080808;
    width: 1900px;
    display: flex;
    backface-visibility: hidden;
    height: 2114px;
    position: absolute;
    transform-origin: 0% 50%;
    transform: scale(0.237) rotate3D(0, 180, 0, 180deg);
    left: 450px;
    border-radius: 0px 50px 50px 0px;
    align-items: center;
    justify-content: center;

    transition: 2s ease-in-out;

}

.flip-card:hover .flip-card-back::after {
  content: url(./allgemeinePraxisScreenShot.jpg);
    transform: scale(0.237) rotate3D(0, 345, 0, 345deg);
}
*/
@keyframes load89234 {
    100% {
        background-position: -100% 0;
    }
}


.contactMe .card {
    position: relative;
    width: 500px;
    height: 100px;
    background: #080808;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    font-weight: bold;
    border-radius: 15px;
    box-shadow: 0px 0px 0px 0px;
    cursor: pointer;
    overflow: hidden;
}

.contactMe .cards a {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    box-shadow: 0px 0px 0px 0px;
    border: 0;
}

.contactMe .card::before,
.contactMe .card::after {
    position: absolute;
    content: "";
    width: 400px;
    height: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    font-weight: bold;
    background-color: #f0c31f;
    color: #080808;
    transition: all 0.5s;
}

.contactMe .card::before {
    top: 0;
    right: 0;
    border-radius: 0 15px 0 100%;
}

.contactMe .card::after {
    bottom: 0;
    left: 0;
    border-radius: 0 100%  0 15px;
}

.contactMe .card:hover::before,
.contactMe .card:hover:after {
    width: 100%;
    height: 100%;
    border-radius: 15px;
    transition: all 0.5s;
}

.contactMe .email:hover:after {
    content: "omardallah68@gmai.com";
}

.contactMe .telefonnummer:hover:after {
    content: "+49 177 957 68 59";
}


/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width: 600px) {
    /* Place the timelime to the left */
    .timeline::after {
        left: 31px;
    }

    /* Full-width containers */
    .container {
        width: 100%;
        padding-left: 70px;
        padding-right: 25px;
    }

    /* Make sure that all arrows are pointing leftwards */
    .container::before {
        left: 60px;
        border: medium solid white;
        border-width: 10px 10px 10px 0;
        border-color: transparent white transparent transparent;
    }

    /* Make sure all circles are at the same spot */
    .left::after,
    .right::after {
        left: 15px;
    }

    /* Make all right containers behave like the left ones */
    .right {
        left: 0%;
    }
}

</style>
