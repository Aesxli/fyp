const tabs = document.querySelectorAll("[data-target]");
const tabContents = document.querySelectorAll("[data-content]");
const filterButtons = document.querySelectorAll(".filter-button");

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    // Remove the "active-tab" class from all tab buttons
    tabs.forEach((t) => {
      t.classList.remove("active-button");
    });

    // Add the "active-tab" class to the clicked tab
    tab.classList.add("active-button");

    // Get the target content element
    const target = document.querySelector(tab.dataset.target);

    // Hide all tab contents
    tabContents.forEach((tc) => {
      tc.classList.remove("filter-active");
    });

    // Show the target tab content
    target.classList.add("filter-active");
  });
});