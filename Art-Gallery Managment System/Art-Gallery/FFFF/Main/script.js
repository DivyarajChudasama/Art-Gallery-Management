const itemsPerPage = 9;
let currentPage = 1;
const shopContainer = document.querySelector('.shop-container');
const prevPageBtn = document.querySelector('.prev-page');
const nextPageBtn = document.querySelector('.next-page');

function createPage() {
  const startItem = (currentPage - 1) * itemsPerPage;
  const endItem = startItem + itemsPerPage;
  const items = shopContainer.querySelectorAll('.item');
  for (let i = 0; i < items.length; i++) {
    if (i >= startItem && i < endItem) {
      items[i].style.display = 'block';
    } else {
      items[i].style.display = 'none';
    }
  }
}

createPage();

prevPageBtn.addEventListener('click', () => {
  if (currentPage > 1) {
    currentPage--;
    createPage();
  }
});

nextPageBtn.addEventListener('click', () => {
  const items = shopContainer.querySelectorAll('.item');
  if (currentPage < Math.ceil(items.length / itemsPerPage)) {
    currentPage++;
    createPage();
  }
});