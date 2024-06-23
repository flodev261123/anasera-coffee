<div class="container lg:mt-36 mt-24 mb-20 mx-auto">

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

    <?php if (session()->getFlashdata("no_r")): ?>
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
        <div class="ms-3 text-sm font-normal text-white"> <?= session()->getFlashdata("no_r") ?></div>
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

    <?php if (session()->getFlashdata("notfound")): ?>
    <div id="toast-success"
        class="flex items-center  mx-auto m-12 w-full max-w-xs p-4 mb-4 text-gray-500 bg-amber-800 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-amber-700 bg-amber-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="ms-3 text-sm font-normal text-white"> <?= session()->getFlashdata("notfound") ?></div>
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
    <?php if (session()->getFlashdata("empty")): ?>

    <a href="<?= site_url('products/create') ?>" class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded ">
        Add Product
    </a>
    <h1 class="text-amber-700 font-semibold text-2xl text-center mt-20"> <?= session()->getFlashdata("empty") ?></h1>

    <?php else : ?>

    <div class="xl:flex sm:block justify-between gap-8 items-center">
        <div class="flex justify-start gap-4 items-center">
            <a href="<?= site_url('products/create') ?>"
                class="bg-amber-700 hover:bg-amber-800 text-white   font-medium rounded text-sm px-4 py-2.5 text-center inline-flex items-center ">
                Add Product
            </a>


            <button id="dropdownHelperRadioButton" data-dropdown-toggle="dropdownHelperRadio"
                class="text-white bg-amber-700 hover:bg-amber-800   font-medium rounded text-sm px-4 py-2.5 text-center inline-flex items-center "
                type="button">Filter By Category <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg></button>

            <!-- Dropdown menu -->
            <div id="dropdownHelperRadio"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
                style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 6119.5px, 0px);">
                <form action="<?= site_url('products')?>" method="GET">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownHelperRadioButton">

                        <?php foreach ($categories as $category): ?>
                        <li>
                            <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">

                                <div class="flex items-center h-5">

                                    <input type="radio" name="category" value="<?= $category['id'] ?>"
                                        <?php echo ($category == $category['id']) ? 'checked' : ''; ?> class=" w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                    dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700
                                    focus:ring-2 dark:bg-gray-600 dark:border-gray-500">

                                </div>
                                <div class="ms-2 text-sm">
                                    <label for="helper-radio-4" class="font-medium text-gray-900 dark:text-gray-300">
                                        <div> <?= $category['category_name'] ?></div>

                                    </label>
                                </div>

                            </div>
                        </li>
                        <?php endforeach; ?>
                        <li>
                            <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">

                                <div class="flex items-center h-5">

                                    <input type="radio" name="category" value="all"
                                        <?php echo ($category == 'all' || !$category) ? 'checked' : ''; ?> class=" w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                    dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700
                                    focus:ring-2 dark:bg-gray-600 dark:border-gray-500">

                                </div>
                                <div class="ms-2 text-sm">
                                    <label for="helper-radio-4" class="font-medium text-gray-900 dark:text-gray-300">
                                        <div> All</div>

                                    </label>
                                </div>

                            </div>
                        </li>
                        <button type="submit"
                            class="text-white bg-amber-700 hover:bg-amber-800 w-full  font-medium rounded-3xl text-sm px-4 py-1  inline-flex items-center ">
                            <p class="mx-auto">Filter</p>
                        </button>
                    </ul>

                </form>
            </div>


        </div>

        <?php if (session()->getFlashdata("all")): ?>

        <div class="ms-3 text-lg  text-amber-700 font-semibold"> <?= session()->getFlashdata("all") ?></div>


        <?php endif; ?>
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
                    placeholder="Cari Products.." oninput="filterProducts()" />
            </div>
        </div>
    </div>

    <div id="product-not-found" class="hidden mt-6 p-4 text-center text-amber-800 font-bold text-2xl rounded-lg"
        role="alert">
        Product not found.
    </div>
    <div id="product-list" class="grid lg:grid-cols-3  grid-cols-1 gap-8 mt-10">
        <!-- Product Not Found Message -->

        <?php foreach ($products as $product): ?>
        <div
            class="product-item transition ease-in-out delay-100 hover:-translate-x-1 hover:scale-105 hover:shadow-amber-800 max-w-md bg-white border border-gray-200 rounded-lg shadow-2xl dark:bg-gray-800 dark:border-gray-700">
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
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category:
                    <?= $product['category_name'] ?>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Price:
                    <?= 'IDR ' . number_format($product['harga_satuan'], 0, ',', '.') ?>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Satuan: <?= $product['unit'] ?></p>

                <?php if (!$product['hasRecipe']): ?>
                <p class="mb-3 text-lg text-amber-700 cursor-pointer font-semibold dark:text-gray-400"> belum ada resep
                </p>
                <div class="flex justify-around gap-1 items-center">
                    <a href="<?= site_url('products/edit/' . $product['id']) ?>"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg">Edit</a>
                    <a href="<?= site_url('recipes/index/' . $product['id']) ?>"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 rounded-lg">Buat
                        Resep</a>



                    <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg">Delete</button>
                    <div class="block">
                        <a href="<?= site_url('products/reduce/' . $product['id']) ?>"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Keluarkan
                            Stock

                        </a>
                    </div>
                </div>

                <?php else :?>
                <p class="mb-3 text-lg text-green-700  font-semibold dark:text-gray-400"> sudah ada resep
                </p>
                <div class="flex justify-around gap-2 items-center">
                    <a href="<?= site_url('products/edit/' . $product['id']) ?>"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg">Edit</a>


                    <?php if ($product['hasRecipe']): ?>
                    <?php foreach ($recipes as $recipe): ?>
                    <?php if ($recipe['products_id'] == $product['id']): ?>
                    <a href="<?= site_url('recipes/editRecipe/' . $product['id']) ?>"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-500 hover:bg-green-700 rounded-lg">
                        Atur Resep <?= $recipe['nama_produk'] ?>
                    </a>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>

                    <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg">Delete</button>
                    <div class="block">
                        <a href="<?= site_url('products/reduce/' . $product['id']) ?>"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-700 hover:bg-amber-800 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Keluarkan
                            Stock

                        </a>
                    </div>
                </div>


                <?php endif; ?>
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
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                            to
                            delete this product?</h3>
                        <a href="<?= site_url('products/delete/' . $product['id']) ?>"
                            class="text-white bg-amber-700 hover:bg-amber-800 rounded-lg px-5 py-2.5">Yes, I'm
                            sure</a>
                        <a data-modal-hide="popup-modal"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:z-10">No,
                            cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>


</div>

<script>
function filterProducts() {
    const search = document.getElementById('search-input').value.toLowerCase();
    const products = document.querySelectorAll('.product-item');
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