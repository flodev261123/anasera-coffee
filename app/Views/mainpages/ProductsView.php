<div class="container lg:mt-36 mt-24 mb-5 mx-auto">
    <?php if (session()->getFlashdata("error")): ?>
    <div id="toast-success"
        class="flex items-center  mx-auto m-12 w-full max-w-xs p-4 mb-4 text-gray-500 bg-red-500 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="ms-3 text-sm font-normal text-white"> <?= session()->getFlashdata("error") ?></div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <?php endif; ?>
    <a href="<?= site_url('products/create') ?>"
        class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded ">Add Product</a>
    <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-8 mt-10">
        <?php foreach ($products as $product): ?>
        <div
            class="max-w-md bg-white border border-gray-200 rounded-lg shadow-2xl dark:bg-gray-800 dark:border-gray-700">
            <figure class="relative max-w-md transition-all duration-300 cursor-pointer">
                <a href="#">
                    <div class="absolute inset-0 bg-gray-800 opacity-30 rounded-t-lg"></div>
                    <img class="h-96 w-full rounded-t-lg" src="<?= $product['foto']?>" alt="Product Image">
                </a>
                <figcaption class="absolute px-4 bottom-6">
                    <h2 class="mb-2 text-4xl font-bold tracking-tight text-amber-800 dark:text-white">
                        <?= $product['nama_produk'] ?></h2>
                </figcaption>
            </figure>
            <div class="p-5">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category: <?= $product['category_name'] ?>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Price: <?= $product['harga_satuan'] ?></p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Stock: <?= $product['unit'] ?></p>

                <?php if (!$product['hasRecipe']): ?>
                <p class="mb-3 text-lg text-amber-700 cursor-pointer font-semibold dark:text-gray-400"> <a
                        href="<?= site_url('recipes/index/' . $product['id']) ?>">buat resep</a>
                </p>
                <?php else :?>
                <p class="mb-3 text-lg text-green-700  font-semibold dark:text-gray-400"> sudah ada resep
                </p>
                <?php endif; ?>

                <a href="<?= site_url('products/edit/' . $product['id']) ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg">Edit</a>


                <a href="<?= site_url('products/reduce/' . $product['id']) ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Keluarkan
                    Stock
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
                <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg">Delete</button>
            </div>
        </div>
        <div id="popup-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-amber-50 rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                            delete this product?</h3>
                        <a href="<?= site_url('products/delete/' . $product['id']) ?>"
                            class="text-white bg-amber-700 hover:bg-amber-800 rounded-lg px-5 py-2.5">Yes, I'm sure</a>
                        <a data-modal-hide="popup-modal"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:z-10">No,
                            cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>