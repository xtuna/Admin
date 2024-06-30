document.addEventListener('DOMContentLoaded', function() {
    loadProducts();

    document.querySelector('#add-product-form').addEventListener('submit', function(event) {
        event.preventDefault();
        addProduct();
    });
});

function loadProducts() {
    fetch('products-api.php')
        .then(response => response.json())
        .then(data => {
            const productTable = document.querySelector('#product-list');
            productTable.innerHTML = '';
            data.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.description}</td>
                    <td>${product.price}</td>
                    <td>${product.stock}</td>
                    <td>
                        <button onclick="editProduct(${product.id})">Edit</button>
                        <button onclick="deleteProduct(${product.id})">Delete</button>
                    </td>
                `;
                productTable.appendChild(row);
            });
        });
}

function addProduct() {
    const formData = new FormData(document.querySelector('#add-product-form'));
    fetch('products-api.php', {
        method: 'POST',
        body: JSON.stringify({
            name: formData.get('name'),
            description: formData.get('description'),
            price: formData.get('price'),
            stock: formData.get('stock')
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        loadProducts();
        document.querySelector('#add-product-form').reset();
        document.querySelector('#add-product-form').style.display = 'none';
    });
}

function deleteProduct(id) {
    fetch('products-api.php', {
        method: 'DELETE',
        body: JSON.stringify({ id: id }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        loadProducts();
    });
}

function showAddProductForm() {
    document.querySelector('#add-product-form').style.display = 'block';
}
