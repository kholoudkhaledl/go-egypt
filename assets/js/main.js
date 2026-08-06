/* ---------------------------------------------------------
   --- Mobile Menu Toggle & Navbar Scroll Effect ---
   --------------------------------------------------------- */
const menuToggle = document.querySelector(".menu-toggle");
const navLinks = document.querySelector(".nav-links");
const menuIcon = menuToggle.querySelector("i");

/* Toggle mobile navigation menu and switch icon */
menuToggle.addEventListener("click", () => {
  navLinks.classList.toggle("active");

  if (navLinks.classList.contains("active")) {
    menuIcon.classList.remove("ri-menu-3-line");
    menuIcon.classList.add("ri-close-line");
  } else {
    menuIcon.classList.remove("ri-close-line");
    menuIcon.classList.add("ri-menu-3-line");
  }
});

/* Automatically close mobile menu when clicking any nav link */
document.querySelectorAll(".nav-links a").forEach((link) => {
  link.addEventListener("click", () => {
    navLinks.classList.remove("active");
    menuIcon.classList.remove("ri-close-line");
    menuIcon.classList.add("ri-menu-3-line");
  });
});

/* Add 'scrolled' class to header on window scroll */
window.addEventListener("scroll", function () {
  const header = document.querySelector("header");
  if (window.scrollY > 40) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});

/* ---------------------------------------------------------
   --- Active Navigation Link on Scroll (Scroll Spy) ---
   --------------------------------------------------------- */
document.addEventListener("DOMContentLoaded", function () {
  const sections = document.querySelectorAll("section, header#home, div#home");
  const navLinksItems = document.querySelectorAll(".nav-link");

  window.addEventListener("scroll", function () {
    let scrollPosition = window.scrollY;

    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 100;
      const sectionHeight = section.offsetHeight;
      const sectionId = section.getAttribute("id");

      if (
        scrollPosition >= sectionTop &&
        scrollPosition < sectionTop + sectionHeight
      ) {
        navLinksItems.forEach((link) => {
          link.classList.remove("active");
          if (link.getAttribute("href") === "#" + sectionId) {
            link.classList.add("active");
          }
        });
      }
    });
  });
});

/* ---------------------------------------------------------
   --- Destinations Slider & Drag-to-Scroll Functionality ---
   --------------------------------------------------------- */
document.addEventListener("DOMContentLoaded", function () {
  const nextBtn = document.querySelector(".next-btn");
  const prevBtn = document.querySelector(".prev-btn");
  const trackWrapper = document.querySelector(".destinations-track-wrapper");
  const track = document.querySelector(".destinations-track");
  const dotsContainer = document.querySelector(".slider-dots");

  if (!trackWrapper || !track) return;

  const items = track.querySelectorAll(".destination-item");

  /* Calculate actual card width including gap */
  const getCardWidth = () => {
    if (items.length === 0) return 395;
    const style = window.getComputedStyle(track);
    const gap = parseInt(style.gap) || 35;
    return items[0].offsetWidth + gap;
  };

  /* 1. Initialize slider pagination dots (fixed to 2 dots) */
  dotsContainer.innerHTML = "";
  const totalDots = 2;

  for (let i = 0; i < totalDots; i++) {
    const dot = document.createElement("div");
    dot.classList.add("dot");
    if (i === 0) dot.classList.add("active");

    dot.addEventListener("click", () => {
      const maxScroll = track.scrollWidth - trackWrapper.clientWidth;
      const scrollTarget = (maxScroll / (totalDots - 1)) * i;
      trackWrapper.scrollTo({
        left: scrollTarget,
        behavior: "smooth",
      });
    });
    dotsContainer.appendChild(dot);
  }

  const dots = dotsContainer.querySelectorAll(".dot");

  /* 2. Update active dot automatically on scroll or drag */
  trackWrapper.addEventListener("scroll", () => {
    const maxScroll = track.scrollWidth - trackWrapper.clientWidth;
    if (maxScroll <= 0) return;

    const currentScroll = trackWrapper.scrollLeft;
    const scrollPercent = currentScroll / maxScroll;

    let activeIndex = Math.round(scrollPercent * (totalDots - 1));
    activeIndex = Math.max(0, Math.min(activeIndex, totalDots - 1));

    dots.forEach((dot, i) => {
      dot.classList.toggle("active", i === activeIndex);
    });
  });

  /* 3. Handle next and previous arrow button clicks */
  nextBtn.addEventListener("click", () => {
    trackWrapper.scrollBy({
      left: getCardWidth() * 2,
      behavior: "smooth",
    });
  });

  prevBtn.addEventListener("click", () => {
    trackWrapper.scrollBy({ left: -getCardWidth() * 2, behavior: "smooth" });
  });

  /* 4. Enable drag-to-scroll functionality with mouse/touch */
  let isDown = false;
  let startX;
  let scrollLeft;

  trackWrapper.addEventListener("mousedown", (e) => {
    isDown = true;
    trackWrapper.classList.add("active");
    startX = e.pageX - trackWrapper.offsetLeft;
    scrollLeft = trackWrapper.scrollLeft;
  });

  trackWrapper.addEventListener("mouseleave", () => {
    isDown = false;
  });

  trackWrapper.addEventListener("mouseup", () => {
    isDown = false;
  });

  trackWrapper.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - trackWrapper.offsetLeft;
    const walk = (x - startX) * 2;
    trackWrapper.scrollLeft = scrollLeft - walk;
  });
});

/* ---------------------------------------------------------
   --- Pharaonic Marquee Ticker Setup ---
   --------------------------------------------------------- */
document.addEventListener("DOMContentLoaded", function () {
  const track = document.getElementById("tickerTrack");

  if (track) {
    /* Duplicate content for seamless infinite scrolling loop */
    const items = track.innerHTML;
    track.innerHTML += items;

    /* Set dynamic ticker animation speed */
    track.style.animation = "scrollTicker 60s linear infinite";
  }
});

/* ---------------------------------------------------------
   --- "Did You Know?" Interactive Facts Section ---
   --------------------------------------------------------- */
const factsData = [
  {
    title:
      "The Great Pyramid is the only remaining Wonder of the Ancient World.",
    desc: "Built over 4,500 years ago, the Great Pyramid of Giza is a testament to the incredible ingenuity of ancient Egyptians.",
    image: "assets/images/pyramid.jpg",
    icon: "ri-ancient-gate-line",
  },
  {
    title:
      "The River Nile is the longest river in the world flowing through Egypt.",
    desc: "Ancient Egyptians depended entirely on the annual flooding of the Nile to enrich their agricultural lands.",
    image: "assets/images/nile.jpg",
    icon: "ri-landscape-line",
  },
  {
    title:
      "The ancient city of Alexandria held the greatest library in history.",
    desc: "It was a major center of learning and collected hundreds of thousands of scrolls from all over the ancient world.",
    image: "assets/images/library.jpg",
    icon: "ri-book-open-line",
  },
  {
    title: "Tutankhamun became a legendary pharaoh at just nine years old.",
    desc: "His tomb was discovered almost completely intact in 1922, revealing treasures that amazed the entire world.",
    image: "assets/images/tut.jpg",
    icon: "ri-vip-crown-line",
  },
];

let currentIndex = 0;
const titleEl = document.getElementById("fact-title");
const descEl = document.getElementById("fact-desc");
const imgEl = document.getElementById("fact-img");
const sideIconContainer = document.getElementById("side-icon");
const nextBtn = document.getElementById("next-fact-btn");

/* Function to update fact content with fade effect */
function updateFact() {
  titleEl.classList.add("fade-out");
  descEl.classList.add("fade-out");
  imgEl.classList.add("fade-out");
  sideIconContainer.classList.add("fade-out");

  setTimeout(() => {
    currentIndex = (currentIndex + 1) % factsData.length;

    titleEl.textContent = factsData[currentIndex].title;
    descEl.textContent = factsData[currentIndex].desc;
    imgEl.src = factsData[currentIndex].image;
    sideIconContainer.innerHTML = `<i class="${factsData[currentIndex].icon}"></i>`;

    titleEl.classList.remove("fade-out");
    descEl.classList.remove("fade-out");
    imgEl.classList.remove("fade-out");
    sideIconContainer.classList.remove("fade-out");
  }, 400);
}

/* Auto-rotate facts every 5 seconds */
let timer = setInterval(updateFact, 3000);

/* Manual control button to change fact and reset timer */
nextBtn.addEventListener("click", () => {
  updateFact();
  clearInterval(timer);
  timer = setInterval(updateFact, 3000);
});
