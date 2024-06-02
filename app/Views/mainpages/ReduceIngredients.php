<div class="container mt-32 mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">Keluarkan Produk</h2>
    <form action="<?= site_url('products/issueProduct/' . $product['id']) ?>" method="post"
        class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-input mt-1 block w-full">
            <?php if (isset($validation) && $validation->hasError('quantity')): ?>
            <p class="text-red-500"><?= $validation->getError('quantity') ?></p>
            <?php endif; ?>
        </div>
        <button type="submit"
            class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Keluarkan</button>
    </form>
</div>