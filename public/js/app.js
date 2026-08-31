document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.querySelector(".menu-toggle");
    const mainNav = document.querySelector("#main-nav");

    if (menuToggle && mainNav) {
        menuToggle.addEventListener("click", () => {
            const isOpen = mainNav.classList.toggle("is-open");
            menuToggle.setAttribute("aria-expanded", String(isOpen));
            menuToggle.innerHTML = isOpen
                ? '<i class="fa-solid fa-xmark" aria-hidden="true"></i>'
                : '<i class="fa-solid fa-bars" aria-hidden="true"></i>';
        });
    }

    const productMainImage = document.querySelector("#product-main-image");
    const productThumbs = document.querySelectorAll("[data-product-image]");

    productThumbs.forEach((thumb) => {
        thumb.addEventListener("click", () => {
            if (!productMainImage) {
                return;
            }

            productMainImage.src = thumb.dataset.productImage;
            productThumbs.forEach((item) => item.classList.remove("is-active"));
            thumb.classList.add("is-active");
        });
    });
});
