<div class="container lg:mt-36 mt-24 mb-5 mx-auto">
    <div class="xl:flex sm:block justify-between gap-8 items-center">
        <a href="<?= site_url('ingredients/create_ingredients') ?>"
            class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded ">Tambah Bahan Baru</a>
        <div class="flex items-center xl:w-96 w-full xl:mt-0 mt-3">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                    </svg>
                </div>
                <input type="text" id="search-input" name="search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-700 focus:border-amber-800 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari Bahan.." oninput="filterBahan()" />
            </div>
        </div>

    </div>

    <?php if (session()->getFlashdata("emptybahan")): ?>


    <h1 class="text-amber-700 font-semibold text-2xl text-center mt-20"> <?= session()->getFlashdata("emptybahan") ?>
    </h1>

    <?php endif; ?>

    <div id="product-not-found" class="hidden mt-6 p-4 text-center text-amber-800 font-bold text-2xl rounded-lg"
        role="alert">
        Ingredients not found.
    </div>

    <div id="bahan-list" class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-8 mt-10">
        <?php foreach ($ingredients as $i): ?>
        <div
            class="bahan-item transition ease-in-out delay-100 hover:-translate-x-1 hover:scale-105 hover:shadow-amber-800 max-w-md bg-white border border-gray-200 rounded-lg shadow-2xl dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 hidden text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <?= $i['id'] ?>
                    </h5>

                </a>
                <h2 class="mb-3 font-bold text-2xl text-amber-800 dark:text-gray-400">
                    <?= $i['ingredients_name'] ?> </h2>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"> stock : <?= $i['stock'] ?> <span>
                        <?= $i['unit'] ?></span>
                </p>


                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">descriptions :


                    <?= $i['description'] ?: 'Belum Ada Deskripsi' ?>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">harga beli :
                    <?= 'IDR ' . number_format($i['harga_beli'], 0, ',', '.') ?>
                </p>
                <a href="<?= site_url('ingredients/edit/' . $i['id']) ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-amber-700 hover:bg-amber-800 rounded-lg  focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Edit
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
                <a href="<?= site_url('recipes/detail/' . $i['id']) ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-amber-700 hover:bg-amber-800 rounded-lg  focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Detail
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>

                <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-amber-700 hover:bg-amber-800 rounded-lg  focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Delete
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="popup-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-amber-50 rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin Ingin Hapus Product
                            Ini
                        </h3>
                        <a href="<?= site_url('ingredients/delete_ingredients/' . $i['id']) ?>"
                            class="text-white bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Ya , Saya Yakin
                        </a>
                        <a data-modal-hide="popup-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-amber-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                            cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!--delete modal -->


</div>

<script>
function filterBahan() {
    const search = document.getElementById('search-input').value.toLowerCase();
    const products = document.querySelectorAll('.bahan-item');
    let anyVisible = false;

    products.forEach(product => {
        const productName = product.querySelector('h2').innerText.toLowerCase();
        if (productName.includes(search)) {
            product.style.display = '';
            anyVisible = true;
        } else {
            product.style.display = 'none';
        }
    });

    const noResultsMessage = document.getElementById('product-not-found');
    if (anyVisible) {
        noResultsMessage.classList.add('hidden');
    } else {
        noResultsMessage.classList.remove('hidden');
    }
}
</script>