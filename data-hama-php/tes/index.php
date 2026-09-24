<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern CRUD App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
        .slide-up { animation: slideUp 0.3s ease-out; }
        @keyframes slideUp { from {transform: translateY(20px);} to {transform: translateY(0);} }
        .card-hover { transition: transform 0.2s, box-shadow 0.2s; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-gray-50">

<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Header -->
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Product Manager</h1>
        <p class="text-gray-600 mt-2">Manage your products with this modern interface</p>
    </header>

    <!-- Controls -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="relative w-full sm:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="searchInput" placeholder="Search products..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <button id="addProductBtn" class="w-full sm:w-auto flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 shadow-sm">
            <i class="fas fa-plus mr-2"></i> Add Product
        </button>
    </div>

    <!-- Products Grid -->
    <div id="productsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>

    <!-- Empty State -->
    <div id="emptyState" class="text-center py-12 hidden">
        <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
        <h3 class="text-lg font-medium text-gray-700">No products found</h3>
        <p class="text-gray-500 mt-1">Add your first product by clicking the "Add Product" button</p>
    </div>

    <!-- Modal Tambah/Edit -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md slide-up">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800" id="modalTitle">Add New Product</h2>
                    <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500"><i class="fas fa-times"></i></button>
                </div>
                <form id="productForm" enctype="multipart/form-data">
                    <input type="hidden" id="productId" name="id">
                    <input type="hidden" id="currentImage" name="currentImage">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                            <input type="text" name="name" id="productName" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="productDescription" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                            <input type="number" name="price" id="productPrice" class="w-full px-3 py-2 border border-gray-300 rounded-lg" min="0" step="0.01" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category" id="productCategory" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                <option value="">Select a category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Home">Home</option>
                                <option value="Sports">Sports</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            <input type="file" name="image" id="productImage" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" id="cancelModalBtn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md slide-up">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Confirm Deletion</h2>
                    <button id="closeConfirmModalBtn" class="text-gray-400 hover:text-gray-500"><i class="fas fa-times"></i></button>
                </div>
                <p class="text-gray-700 mb-6">Are you sure you want to delete this product? This action cannot be undone.</p>
                <div class="flex justify-end space-x-3">
                    <button id="cancelDeleteBtn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// === JavaScript sama seperti sebelumnya, tapi fetch dari API ===
let products = [];
let productToDelete = null;

function fetchProducts() {
    fetch('product_api.php?action=read')
        .then(res => res.json())
        .then(data => {
            products = data;
            renderProducts(products);
        });
}

function renderProducts(list) {
    const grid = document.getElementById('productsGrid');
    const empty = document.getElementById('emptyState');
    grid.innerHTML = '';
    if (!list.length) {
        empty.classList.remove('hidden');
        return;
    }
    empty.classList.add('hidden');
    list.forEach(p => {
        grid.innerHTML += `
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover fade-in">
            <div class="p-6">
                ${p.image ? `<img src="${p.image}" class="w-full h-40 object-cover rounded mb-4">` : ''}
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">${p.name}</h3>
                        <span class="inline-block mt-1 px-2 py-1 text-xs font-medium rounded-full bg-gray-100">${p.category}</span>
                    </div>
                    <span class="text-lg font-semibold text-gray-800">$${parseFloat(p.price).toFixed(2)}</span>
                </div>
                <p class="mt-3 text-gray-600 text-sm">${p.description}</p>
                <div class="mt-4 flex justify-end space-x-2">
                    <button onclick="editProduct(${p.id})" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteProduct(${p.id})" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
        `;
    });
}

function openModal() {
    document.getElementById('productModal').classList.remove('hidden');
}
function closeModal() {
    document.getElementById('productModal').classList.add('hidden');
}
function openConfirmModal() {
    document.getElementById('confirmModal').classList.remove('hidden');
}
function closeConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
}

document.getElementById('addProductBtn').addEventListener('click', () => {
    document.getElementById('modalTitle').innerText = 'Add New Product';
    document.getElementById('productForm').reset();
    document.getElementById('productId').value = '';
    openModal();
});
document.getElementById('closeModalBtn').onclick = closeModal;
document.getElementById('cancelModalBtn').onclick = closeModal;
document.getElementById('closeConfirmModalBtn').onclick = closeConfirmModal;
document.getElementById('cancelDeleteBtn').onclick = closeConfirmModal;

// Save product
document.getElementById('productForm').addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(this);
    let action = formData.get('id') ? 'update' : 'create';
    fetch(`product_api.php?action=${action}`, {
        method: 'POST',
        body: formData
    }).then(res => res.json())
      .then(res => {
        closeModal();
        fetchProducts();
    });
});

function editProduct(id) {
    const p = products.find(x => x.id == id);
    document.getElementById('modalTitle').innerText = 'Edit Product';
    document.getElementById('productId').value = p.id;
    document.getElementById('productName').value = p.name;
    document.getElementById('productDescription').value = p.description;
    document.getElementById('productPrice').value = p.price;
    document.getElementById('productCategory').value = p.category;
    document.getElementById('currentImage').value = p.image;
    openModal();
}

function deleteProduct(id) {
    productToDelete = id;
    openConfirmModal();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
    fetch(`product_api.php?action=delete`, {
        method: 'POST',
        body: new URLSearchParams({ id: productToDelete })
    }).then(res => res.json())
      .then(res => {
        closeConfirmModal();
        fetchProducts();
    });
});

// Search
document.getElementById('searchInput').addEventListener('input', function(){
    const term = this.value.toLowerCase();
    renderProducts(products.filter(p =>
        p.name.toLowerCase().includes(term) ||
        p.description.toLowerCase().includes(term) ||
        p.category.toLowerCase().includes(term)
    ));
});

fetchProducts();
</script>
</body>
</html>
