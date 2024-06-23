<div class="container mt-32 mx-auto px-4">
    <div
        class="w-full p-4 bg-gray-50 shadow-2xl border border-gray-200 rounded-lg sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-3xl font-bold text-amber-800 dark:text-white">Detail Bahan:
            <?= $ingredient['ingredients_name'] ?></h5>
        <p class="mb-4 text-lg text-gray-700 dark:text-gray-400">Unit: <?= $ingredient['unit'] ?></p>

        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Produk yang Menggunakan Bahan Ini :</p>

        <div class="w-full shadow-lg mb-4">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-amber-500 focus:border-amber-500"
                    placeholder="Cari Produk ...." oninput="filterProducts()" />
            </div>
        </div>

        <div class="flex justify-end mb-4">
            <form action="<?= base_url('recipes/removeIngredientFromAllProducts/' . $ingredient['id']) ?>"
                method="post">
                <?= csrf_field() ?>
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 focus:outline-none">Hapus
                    Semua Keterkaitan</button>
            </form>
        </div>

        <?php if (!empty($products)): ?>
        <ul id="products-list" class="mt-4">
            <?php foreach ($products as $product): ?>
            <li class="product-item mb-4 p-4 border border-gray-200 rounded-lg shadow dark:border-gray-700">
                <div class="flex items-center">
                    <img src="<?= base_url($product['foto']) ?>" alt="<?= $product['nama_produk'] ?>"
                        class="w-16 h-16 rounded-lg">
                    <div class="ml-4">
                        <h3 class="product-name text-xl font-bold text-gray-900 dark:text-white">
                            <?= $product['nama_produk'] ?></h3>
                        <p class="text-gray-700 dark:text-gray-400">Jumlah: <?= $product['amount'] ?>
                            <?= $product['unit'] ?></p>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <p id="no-results-message" class="hidden text-gray-700 dark:text-gray-400">Tidak ada produk yang cocok dengan
            pencarian Anda.</p>
        <?php else: ?>
        <p class="text-amber-700 font-semibold text-xl text-center mt-5">Tidak ada produk yang menggunakan bahan ini.
        </p>
        <?php endif; ?>
        <a class=" text-white transition ease-in-out delay-150 hover:-translate-y-1 mt-5 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            href="<?= base_url('/ingredients')?>">kembali</a>
    </div>

</div>

<script>
function filterProducts() {
    const search = document.getElementById('default-search').value.toLowerCase();
    const productItems = document.querySelectorAll('.product-item');
    let anyVisible = false;

    productItems.forEach(item => {
        const productName = item.querySelector('.product-name').innerText.toLowerCase();
        if (productName.includes(search)) {
            item.style.display = 'flex';
            anyVisible = true;
        } else {
            item.style.display = 'none';
        }
    });

    const noResultsMessage = document.getElementById('no-results-message');
    if (anyVisible) {
        noResultsMessage.classList.add('hidden');
    } else {
        noResultsMessage.classList.remove('hidden');
    }
}
</script>