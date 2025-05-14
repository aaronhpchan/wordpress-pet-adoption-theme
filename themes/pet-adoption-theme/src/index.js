// Check URL 

function isOnPage(pageIdentifier) {
  const currentUrl = window.location.href;

  // Remove protocol (https://, http://) and optional trailing slash
  const cleanUrl = currentUrl.replace(/^(https?:\/\/)?(www\.)?/, '').replace(/\/$/, '');
  const cleanIdentifier = pageIdentifier.replace(/^(https?:\/\/)?(www\.)?/, '').replace(/\/$/, '');

  return cleanUrl.includes(cleanIdentifier);
}

function isHomePage() {
  const path = window.location.pathname;
  return path === "/" || path === "/pet-adoption-theme/";
}

// Loading spinner animation

class Loader {
  constructor() {
    const loader = document.querySelector(".loader");

    if (loader) {
      loader.classList.add("loader-hidden");
  
      loader.addEventListener("transitionend", () => {
        loader.remove();
      });
    }
  }
}

// Navbar Overlay

class NavOverlay {
  constructor() {
    this.openButton = document.querySelector(".navbar-menu__icon");
    this.closeButton = document.querySelector(".nav-overlay__close");
    this.navOverlay = document.querySelector(".nav-overlay");
    this.navOverlayBg = document.querySelector(".nav-overlay__bg");
    this.isOverlayOpened = false;
    this.events();
  }
  
  events() {
    this.openButton.addEventListener("click", this.openOverlay.bind(this));
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
    window.addEventListener("resize", this.screenResize.bind(this));
  }
  
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

// Search 

class Search {
  constructor() {
    this.openButton = document.querySelector(".navbar-menu__search");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchOverlayBg = document.querySelector(".search-overlay__bg");
    this.searchField = document.querySelector("#search-field");
    this.isOverlayOpened = false;
    this.typingTimer;
    this.searchResultsDiv = document.querySelector(".search-overlay__results");
    this.prevSearchValue;
    this.events();
  }
  
  events() {
    this.openButton.addEventListener("click", this.openOverlay.bind(this));
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
    this.searchOverlayBg.addEventListener("click", this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.addEventListener("keyup", this.typingLogic.bind(this));
  }
  
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

// Home links animation

class HomeLinksAnimation {
  constructor() {
    this.homeLinks = document.querySelectorAll(".home-links__item");
    this.homeLinks.forEach(this.homeLinkHover.bind(this));
  }

  homeLinkHover(homeLink) {
    const homeLinkImg = homeLink.querySelector(".home-links__img").querySelector("img");

    homeLink.addEventListener("mouseover", () => {
      homeLinkImg.classList.add("home-links__img-hover");
    });
    homeLink.addEventListener("mouseleave", () => {
      homeLinkImg.classList.remove("home-links__img-hover");
    });
  }
}

// Home stories slideshow

class HomeStoriesSlideshow {
  constructor(slidesSelector, prevBtnSelector, nextBtnSelector) {
    this.slides = document.querySelectorAll(slidesSelector);
    this.slideIndex = 1;
    this.nextBtn = document.querySelector(nextBtnSelector);
    this.prevBtn = document.querySelector(prevBtnSelector);
    this.showSlides(this.slideIndex);
    this.events();
  }

  events() {
    this.nextBtn.addEventListener("click", () => this.plusSlides(1));
    this.prevBtn.addEventListener("click", () => this.plusSlides(-1));
  }

  // Next/previous controls
  plusSlides(n) {
    this.showSlides(this.slideIndex += n);
  }

  // Slide image controls
  currentSlide(n) {
    this.showSlides(this.slideIndex = n);
  }

  showSlides(n) {
    if (!this.slides.length) return;
    if (n > this.slides.length) this.slideIndex = 1;
    if (n < 1) this.slideIndex = this.slides.length;

    this.slides.forEach(slide => {
      slide.style.display = "none";
    });
    this.slides[this.slideIndex - 1].style.display = "block";
  }
}

// Pet card animation 

class PetCardHoverEffect {
  constructor() {
    this.petCards = document.querySelectorAll(".pet-card");
    this.petCards.forEach(this.petCardHover.bind(this));
  }

  petCardHover(petCard) {
    const petCardBg = petCard.querySelector(".pet-card__bg");
    const petCardImg = petCard.querySelector(".pet-card__img").querySelector("img");
    const petCardIcon = petCard.querySelector(".pet-card__info").querySelector("img");

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
}
  
// Dropdown 

class Dropdown {
  constructor() {
    this.dropdownTrigger = document.querySelector(".blog-categories__label");
    this.dropdown = document.querySelector(".blog-categories__items");
    this.events();
  }

  events() {
    this.dropdownTrigger.addEventListener("click", this.showDropdown.bind(this));
  }

  showDropdown() {
    this.dropdown.style.display = this.dropdown.style.display === "flex" ? "none" : "flex";
  }
}

window.addEventListener("load", () => {
  new Loader();
});

window.addEventListener("DOMContentLoaded", () => {
  new NavOverlay();
  new Search();
  if (isHomePage()) {
    new HomeLinksAnimation();
    new HomeStoriesSlideshow(".home-story__content", ".home-stories__prev", ".home-stories__next");
  }
  if (isHomePage() || isOnPage("adopt-a-cat") || isOnPage("adopt-a-dog") || isOnPage("pets") || isOnPage("shelters")) {
    new PetCardHoverEffect();
  }
  if (isOnPage("blog") || isOnPage("category")) {
    new Dropdown();
  }
});





