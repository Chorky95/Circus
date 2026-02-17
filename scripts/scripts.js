// console.log("Hello, Circus!");

// Header Mobile Menu Functionality
document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.querySelector(".header__hamburger");
  const mobileMenu = document.querySelector(".header__mobile-menu");
  const mobileLinks = document.querySelectorAll(".header__mobile-link");
  const body = document.body;

  if (hamburger && mobileMenu) {
    // Toggle mobile menu
    hamburger.addEventListener("click", function () {
      const isOpen = hamburger.classList.contains("is-active");

      if (isOpen) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });

    // Close menu when clicking on a link
    mobileLinks.forEach((link) => {
      link.addEventListener("click", function () {
        closeMobileMenu();
      });
    });

    // Close menu when clicking outside
    mobileMenu.addEventListener("click", function (e) {
      if (e.target === mobileMenu) {
        closeMobileMenu();
      }
    });

    function openMobileMenu() {
      hamburger.classList.add("is-active");
      mobileMenu.classList.add("is-open");
      hamburger.setAttribute("aria-expanded", "true");
      body.style.overflow = "hidden";
    }

    function closeMobileMenu() {
      hamburger.classList.remove("is-active");
      mobileMenu.classList.remove("is-open");
      hamburger.setAttribute("aria-expanded", "false");
      body.style.overflow = "";
    }
  }
});

// Give Me Jokes Block Functionality
document.addEventListener("DOMContentLoaded", function () {
  const jokesBlocks = document.querySelectorAll(".give-me-jokes");

  jokesBlocks.forEach((block) => {
    let allJokes = [];
    let jokeTypes = new Set();

    const initialSection = block.querySelector(".give-me-jokes__initial");
    const contentSection = block.querySelector(".give-me-jokes__content");
    const jokesGrid = block.querySelector(".js-jokes-grid");
    const getJokesBtn = block.querySelector(".js-get-jokes");
    const loadMoreBtn = block.querySelector(".js-load-more");
    const typeFilter = block.querySelector(".js-joke-type-filter");

    // Fetch jokes from API via WordPress AJAX
    function fetchJokes() {
      const formData = new FormData();
      formData.append("action", "fetch_jokes");

      return fetch(wpAjax.ajax_url, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            return data.data;
          } else {
            throw new Error(data.data.message || "Failed to fetch jokes");
          }
        });
    }

    // Create joke card HTML
    function createJokeCard(joke) {
      return `
                <div class="give-me-jokes__joke" data-type="${joke.type}">
                    <div class="give-me-jokes__joke-type caption">${joke.type}</div>
                    <p class="give-me-jokes__joke-setup body-1">${joke.setup}</p>
                    <p class="give-me-jokes__joke-punchline body-italic">${joke.punchline}</p>
                </div>
            `;
    }

    // Update filter dropdown with available types
    function updateFilterDropdown() {
      const currentValue = typeFilter.value;
      typeFilter.innerHTML = '<option value="">Type</option>';

      Array.from(jokeTypes)
        .sort()
        .forEach((type) => {
          const option = document.createElement("option");
          option.value = type;
          option.textContent = type;
          typeFilter.appendChild(option);
        });

      // Restore previous selection if it still exists
      if (currentValue && jokeTypes.has(currentValue)) {
        typeFilter.value = currentValue;
      }
    }

    // Display jokes in the grid
    function displayJokes(jokes, append = false) {
      if (!append) {
        jokesGrid.innerHTML = "";
      }

      jokes.forEach((joke) => {
        allJokes.push(joke);
        jokeTypes.add(joke.type);
        jokesGrid.insertAdjacentHTML("beforeend", createJokeCard(joke));
      });

      updateFilterDropdown();
    }

    // Filter jokes by type
    function filterJokes() {
      const selectedType = typeFilter.value;
      const jokeCards = block.querySelectorAll(".give-me-jokes__joke");

      jokeCards.forEach((card) => {
        if (selectedType === "" || card.dataset.type === selectedType) {
          card.style.display = "flex";
        } else {
          card.style.display = "none";
        }
      });
    }

    // Handle "Get jokes" button click
    if (getJokesBtn) {
      getJokesBtn.addEventListener("click", function () {
        getJokesBtn.disabled = true;
        getJokesBtn.textContent = "Loading...";

        fetchJokes()
          .then((jokes) => {
            displayJokes(jokes);
            initialSection.style.display = "none";
            contentSection.style.display = "block";
            if (loadMoreBtn) {
              loadMoreBtn.style.display = "block";
            }
          })
          .catch((error) => {
            console.error("Error fetching jokes:", error);
            alert("Failed to fetch jokes. Please try again.");
            getJokesBtn.disabled = false;
            getJokesBtn.textContent =
              getJokesBtn.dataset.originalText || "Punch it";
          });
      });
    }

    // Handle "Load more" button click
    if (loadMoreBtn) {
      loadMoreBtn.addEventListener("click", function () {
        loadMoreBtn.disabled = true;
        loadMoreBtn.textContent = "Loading...";

        fetchJokes()
          .then((jokes) => {
            displayJokes(jokes, true);
            // Reset filter
            typeFilter.value = "";
            filterJokes();
            loadMoreBtn.disabled = false;
            loadMoreBtn.textContent =
              loadMoreBtn.dataset.originalText || "Give me more jokes";
          })
          .catch((error) => {
            console.error("Error fetching jokes:", error);
            alert("Failed to fetch more jokes. Please try again.");
            loadMoreBtn.disabled = false;
            loadMoreBtn.textContent =
              loadMoreBtn.dataset.originalText || "Give me more jokes";
          });
      });

      // Store original button text
      loadMoreBtn.dataset.originalText = loadMoreBtn.textContent;
    }

    // Handle filter change
    if (typeFilter) {
      typeFilter.addEventListener("change", filterJokes);
    }

    // Store original button text for get jokes button
    if (getJokesBtn) {
      getJokesBtn.dataset.originalText = getJokesBtn.textContent;
    }
  });
});
