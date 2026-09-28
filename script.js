const productsGrid = document.getElementById('productsGrid');
const categoryFilter = document.getElementById('categoryFilter');

async function fetchProducts() {
  try {
    const response = await fetch('products.php');
    if (!response.ok) {
      throw new Error('No se pudo cargar el catálogo');
    }

    const products = await response.json();
    renderProducts(products);
  } catch (error) {
    productsGrid.innerHTML = `
      <div class="empty-state">
        <h3>No se pudo cargar el catálogo</h3>
        <p>${error.message}</p>
      </div>
    `;
  }
}

function renderProducts(products) {
  const selectedCategory = categoryFilter.value;
  const filteredProducts = selectedCategory === 'all'
    ? products
    : products.filter(product => product.category === selectedCategory);

  if (!filteredProducts.length) {
    productsGrid.innerHTML = `
      <div class="empty-state">
        <h3>No hay productos en esta categoría</h3>
        <p>Prueba con otra categoría para ver más opciones.</p>
      </div>
    `;
    return;
  }

  productsGrid.innerHTML = filteredProducts.map(product => `
    <article class="product-card">
      <img class="product-image" src="${product.image_url || 'https://images.unsplash.com/...'}" alt="${product.name}" />
      <div class="product-body">
        <span class="product-tag">${product.category || 'General'}</span>
        <h3 class="product-name">${product.name}</h3>
        <p class="product-description">${product.description}</p>
        <div class="product-footer">
          <span class="product-price">$${Number(product.price).toFixed(2)}</span>
          <button class="buy-btn">Comprar</button>
        </div>
      </div>
    </article>
  `).join('');
}

categoryFilter.addEventListener('change', fetchProducts);
fetchProducts();
