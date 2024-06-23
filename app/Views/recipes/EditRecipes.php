<!-- editRecipe.php -->

<div class="container mt-32 mx-auto px-4">
    <?php if (session()->getFlashdata("no_n")): ?>
    <div id="toast-success"
        class="flex items-center mx-auto m-12 w-full max-w-xs p-4 mb-4 text-gray-500 bg-red-500 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
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
        <div class="ms-3 text-sm font-normal text-white"> <?= session()->getFlashdata("no_n") ?></div>
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

    <div
        class="w-full p-4 bg-gray-50 shadow-2xl border border-gray-200 rounded-lg sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-3xl font-bold text-amber-800 dark:text-white">Edit Resep</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pilih Bahan Yang Ingin Di Gunakan Beserta Takaran
            nya.</p>

        <div class="w-full shadow-lg">
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
                    placeholder="Cari Bahan ...." oninput="filterIngredients()" />
            </div>
        </div>

        <form action="<?= site_url('recipes/updateRecipe/' . $productId) ?>" method="post"
            class="bg-white p-6 rounded-lg shadow-md mt-4" id="recipeForm">
            <?= csrf_field() ?>

            <input type="hidden" name="product_id" value="<?= $productId ?>">


            <!-- Container for scrollable ingredients list -->
            <div id="ingredients-list" class="max-h-96 overflow-y-scroll mt-4">
                <?php foreach ($ingredients as $ingredient): ?>
                <div
                    class="ingredient-item flex items-center justify-between p-3 mt-5 border border-gray-200 rounded dark:border-gray-700">
                    <div>
                        <input type="checkbox" name="ingredients[]" value="<?= $ingredient['id'] ?>"
                            id="ingredient-<?= $ingredient['id'] ?>"
                            class="w-4 h-4 text-amber-800 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 ingredient-checkbox"
                            <?= in_array($ingredient['id'], $selectedIngredients) ? 'checked' : '' ?>>
                        <label for="ingredient-<?= $ingredient['id'] ?>"
                            class="ml-2 text-gray-700"><?= $ingredient['ingredients_name'] ?>
                            (<?= $ingredient['unit'] ?> available)</label>
                    </div>
                    <input type="number" name="amount[<?= $ingredient['id'] ?>]" id="amount-<?= $ingredient['id'] ?>"
                        placeholder="masukan takaran"
                        class="block py-2.5 px-0 max-w-xl text-sm text-gray-900 bg-transparent border-0 border-b-2 border-amber-700 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-amber-800 peer amount-input"
                        value="<?= isset($amounts[$ingredient['id']]) ? $amounts[$ingredient['id']] : '' ?>">
                    <?php if(isset($validation) && $validation->hasError('amount[' . $ingredient['id'] . ']')): ?>
                    <div class="text-red-500 text-sm mt-1">
                        <?= $validation->getError('amount[' . $ingredient['id'] . ']') ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div id="no-results-message" class="hidden text-red-500 text-center mt-4">Bahan tidak ditemukan.</div>
            <button type="submit"
                class="text-white transition ease-in-out delay-150 hover:-translate-y-1 mt-5 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update
                Resep</button>



            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class=" text-white transition ease-in-out delay-150 hover:-translate-y-1 mt-5 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                Delete Resep
            </button>


            <a class=" text-white transition ease-in-out delay-150 hover:-translate-y-1 mt-5 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                href="<?= base_url('/products')?>">batal</a>

            <div id="popup-modal" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Anda yakin ingin hapus
                                resep ini</h3>
                            <a href="<?= site_url('recipes/delete_recipes/'. $recipe['id'])?>"
                                class="text-white transition ease-in-out delay-150 hover:-translate-y-1 mt-5 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Delete Resep</a>
                            <button data-modal-hide="popup-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                cancel</button>

                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.ingredient-checkbox');
    const amounts = document.querySelectorAll('.amount-input');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const ingredientId = this.value;
            const amountInput = document.getElementById(`amount-${ingredientId}`);

            if (this.checked) {
                amountInput.disabled = false;
            } else {
                amountInput.value = '';

            }
        });
    });


});

function filterIngredients() {
    const search = document.getElementById('default-search').value.toLowerCase();
    const ingredients = document.querySelectorAll('.ingredient-item');
    let anyVisible = false;

    ingredients.forEach(ingredient => {
        const ingredientName = ingredient.querySelector('label').innerText.toLowerCase();
        if (ingredientName.includes(search)) {
            ingredient.style.display = 'flex';
            anyVisible = true;
        } else {
            ingredient.style.display = 'none';
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