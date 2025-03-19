/* Check URL */
let url = window.location.href;
let urlHome;
let urlSegments;
let urlHomeSegments;
let ifUrlHome;
let urlLastSegment;
findUrl();
findHomeUrl();
checkHomeUrl();

function findUrl() {
  url = url.replace("https://", "");  
  url = url.replace("http://localhost/", "");

  // Remove the last character of the url if it is a slash
  let urlLastChar = url.slice(-1);
  if (urlLastChar === "/") {
    url = url.substring(0, url.length - 1);
  }
}

function findHomeUrl() {
  if (url.includes("/")) {
    urlHome = url.substring(0, url.indexOf("/"));
  } else {
    urlHome = url;
  }
}

function checkHomeUrl() {
  urlSegments = url.split("/");
  urlHomeSegments = urlHome.split("/");
  if (urlSegments.length === urlHomeSegments.length) {
    ifUrlHome = true;
  } else {
    ifUrlHome = false;
    urlLastSegment = urlSegments[urlSegments.length - 1];
  }
}

/* Loading spinner animation */
window.addEventListener("load", () => {
  const loader = document.querySelector(".loader");

  loader.classList.add("loader-hidden");

  loader.addEventListener("transitionend", () => {
    loader.remove();
  });
});

/* Navbar Overlay */

class NavOverlay {
  // Create/initiate object
  constructor() {
    this.openButton = document.querySelector(".navbar-menu__icon");
    this.closeButton = document.querySelector(".nav-overlay__close");
    this.navOverlay = document.querySelector(".nav-overlay");
    this.navOverlayBg = document.querySelector(".nav-overlay__bg");
    this.isOverlayOpened = false;
    this.events();
  }
  // Events
  events() {
    this.openButton.addEventListener("click", this.openOverlay.bind(this));
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
    window.addEventListener("resize", this.screenResize.bind(this));
  }
  // Methods
  openOverlay() {
    this.navOverlay.classList.add("nav-overlay--active");
    this.isOverlayOpened = true;
  }
  closeOverlay() {
    this.navOverlay.classList.remove("nav-overlay--active");
    this.isOverlayOpened = false;
  }
  keyPressDispatcher(e) {
    if (e.keyCode === 27 && this.isOverlayOpened) { // 27 is key code for ESC key
      this.closeOverlay();
    }
  }
  screenResize() {
    if (window.innerWidth > 992 && this.isOverlayOpened) {
      this.closeOverlay();
    }
  }
}
const navOverlay = new NavOverlay();

/* Search */

class Search {
  // Create/initiate object
  constructor() {
    this.openButton = document.querySelector(".navbar-menu__search");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchOverlayBg = document.querySelector(".search-overlay__bg");
    this.searchField = document.querySelector("#search-field");
    this.isOverlayOpened = false;
    this.typingTimer;
    this.searchResultsDiv = document.querySelector(".search-overlay__results");
    this.searchResult;
    this.prevSearchValue;
    this.events();
  }
  // Events
  events() {
    this.openButton.addEventListener("click", this.openOverlay.bind(this));
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
    this.searchOverlayBg.addEventListener("click", this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.addEventListener("keyup", this.typingLogic.bind(this));
  }
  // Methods
  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    this.searchField.value = "";
    this.searchResultsDiv.innerHTML = "";
    this.searchField.focus();
    this.isOverlayOpened = true;
  }
  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    this.isOverlayOpened = false;
  }
  keyPressDispatcher(e) {
    if (e.keyCode === 27 && this.isOverlayOpened) { // 27 is key code for ESC key
      this.closeOverlay();
    }
  }
  typingLogic() {
    if (this.searchField.value !== this.prevSearchValue) {
      clearTimeout(this.typingTimer);
      if (!this.searchField.value) {
        this.searchResultsDiv.innerHTML = "";
      } 
      this.typingTimer = setTimeout(this.getSearchResults.bind(this), 750);
    } 
    this.prevSearchValue = this.searchField.value;
  }
  getSearchResults() {
    const fetchUrls = async() => {
      try {
        // petData is from functions.php
        const response = await fetch(petData.root_url + '/wp-json/pet/v1/search?term=' + this.searchField.value);
        const searchResults = await response.json();
        let isEmptyResult = true;
        Object.keys(searchResults).forEach(function(key, index) {
          if(this[key].length) {
            isEmptyResult = false;
          } 
        }, searchResults);      

        this.searchResultsDiv.innerHTML = `
          ${isEmptyResult ? `<p class="search-overlay__results-heading">No matches were found for "${this.searchField.value}"</p>` : `<p class="search-overlay__results-heading">Search results for "${this.searchField.value}"<p>`}
          ${searchResults.pages.length ? '<p class="search-overlay__results-category">Pages</p><ul>' : ''}
            ${searchResults.pages.map(result => `
              <li><a href="${result.permalink}">${result.title}</a></li>`).join('')
            }  
          ${searchResults.posts.length ? '</ul>' : ''}
          ${searchResults.posts.length ? '<p class="search-overlay__results-category">Blog Posts</p><ul>' : ''}
            ${searchResults.posts.map(result => `
              <li><a href="${result.permalink}">${result.title}</a></li>`).join('')
            }  
          ${searchResults.posts.length ? '</ul>' : ''}
          ${searchResults.pets.length ? '<p class="search-overlay__results-category">Pets</p><ul>' : ''}
            ${searchResults.pets.map(result => `
              <li><a href="${result.permalink}">${result.title}</a></li>`).join('')
            }  
          ${searchResults.pets.length ? '</ul>' : ''}
          ${searchResults.shelters.length ? '<p class="search-overlay__results-category">Shelters</p><ul>' : ''}
            ${searchResults.shelters.map(result => `
              <li><a href="${result.permalink}">${result.title}</a></li>`).join('')
            }  
          ${searchResults.shelters.length ? '</ul>' : ''}
          ${searchResults.stories.length ? '<p class="search-overlay__results-category">Stories</p><ul>' : ''}
            ${searchResults.stories.map(result => `
              <li><a href="${result.permalink}">${result.title}</a></li>`).join('')
            }  
          ${searchResults.stories.length ? '</ul>' : ''}
        `;
      } catch(err) {
        console.log(err);
      }
    }
    if (this.searchField.value) { 
      fetchUrls();
    }
  }
}
const search = new Search();

/* Home links animation */

// Only executes on homepage
if (ifUrlHome) {
  let homeLinks = document.querySelectorAll(".home-links__item");
  homeLinks.forEach(homeLinkHover);
  function homeLinkHover(homeLink) {
    let homeLinkImg = homeLink.querySelector(".home-links__img").querySelector("img");

    homeLink.addEventListener("mouseover", () => {
      homeLinkImg.classList.add("home-links__img-hover");
    });
    homeLink.addEventListener("mouseleave", () => {
      homeLinkImg.classList.remove("home-links__img-hover");
    });
  }
}

/* Home stories slideshow */

// Only executes on homepage
if (ifUrlHome) {
  let slideIndex = 1;
  showSlides(slideIndex);

  // Next/previous controls
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  // Slide image controls
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("home-story__content");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
  }
}

/* Pet card animation */

let petCards = document.querySelectorAll(".pet-card");
petCards.forEach(petCardHover);
function petCardHover(petCard) {
  let petCardBg = petCard.querySelector(".pet-card__bg");
  let petCardImg = petCard.querySelector(".pet-card__img").querySelector("img");
  let petCardIcon = petCard.querySelector(".pet-card__info").querySelector("img");

  petCard.addEventListener("mouseover", () => {
    petCardBg.classList.add("pet-card__bg-hover");
    petCardImg.classList.add("pet-card__img-hover");
    petCardIcon.classList.add("pet-card__info-imghover");
  });
  petCard.addEventListener("mouseleave", () => {
    petCardBg.classList.remove("pet-card__bg-hover");
    petCardImg.classList.remove("pet-card__img-hover");
    petCardIcon.classList.remove("pet-card__info-imghover");
  });
}
  
/* Dropdown */

// Only executes on blog page and blog catergory page
if (url.includes("blog") || url.includes("category")) {
  let dropdownTrigger = document.getElementsByClassName("blog-categories__label")[0];
  let dropdown = document.getElementsByClassName("blog-categories__items")[0];
  dropdownTrigger.addEventListener("click", showDropdown);

  function showDropdown() {
    dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
  }
}






