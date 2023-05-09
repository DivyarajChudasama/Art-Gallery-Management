const searchBtn = document.querySelector('.search-bar button');
const productNames = document.querySelectorAll('.product-name');

searchBtn.addEventListener('click', () => {
  const searchTerm = document.querySelector('.search-bar input').value.toLowerCase();

  productNames.forEach((name) => {
    const product = name.parentElement.parentElement;
    const productName = name.textContent.toLowerCase();
    
    if (productName.includes(searchTerm)) {
      product.style.display = 'flex';
    } else {
      product.style.display = 'none';
    }
  });
});

const addToCartBtns = document.querySelectorAll(".add-to-cart");
const cartCounter = document.querySelector(".cart span");

let cartCount = 0;

addToCartBtns.forEach(btn => {
  btn.addEventListener("click", () => {
    cartCount++;
    cartCounter.innerHTML = cartCount;
  });
});