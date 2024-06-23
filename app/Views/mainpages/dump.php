<script>
document.getElementById('add-ingredient').addEventListener('click', function() {
    let container = document.getElementById('ingredients-container');
    let index = container.children.length;

    let selectedIngredients = Array.from(document.querySelectorAll('.ingredient-select'))
        .map(select => select.value);

    let ingredientItem = document.createElement('div');
    ingredientItem.classList.add('ingredient-item', 'mb-2');
    ingredientItem.innerHTML = `
        <select name="ingredients[${index}][id]"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ingredient-select">
            <?php foreach ($ingredients as $ing): ?>
                <option value="<?= $ing['id'] ?>" ${selectedIngredients.includes('<?= $ing['id'] ?>') ? 'disabled class="bg-gray-700"' : ''}>
                    <?= $ing['ingredients_name'] ?> ${selectedIngredients.includes('<?= $ing['id'] ?>') ? '(digunakan)' : ''}
                </option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="ingredients[${index}][amount]"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2 ingredient-amount" placeholder="Amount" required min="1" />
        <button type="button" class="remove-ingredient text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-3 py-1 mt-1">Remove</button>
    `;
    container.appendChild(ingredientItem);

    // Cek apakah semua bahan sudah terpilih
    checkAllIngredientsSelected();
});

document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-ingredient')) {
        e.target.closest('.ingredient-item').remove();

        let container = document.getElementById('ingredients-container');

        // Setelah menghapus, cek apakah masih ada bahan yang tersedia untuk dipilih
        checkAllIngredientsSelected();
    }
});

function checkAllIngredientsSelected() {
    let container = document.getElementById('ingredients-container');
    let ingredientsAvailable = Array.from(document.querySelectorAll('.ingredient-select'))
        .filter(select => !select.querySelector('option:disabled')); // Filter hanya yang belum terdisabilitasi

    // Jika tidak ada bahan yang tersedia untuk dipilih, nonaktifkan tombol "Add Ingredient"
    if (ingredientsAvailable.length === 0) {
        document.getElementById('add-ingredient').disabled = true;
    } else {
        document.getElementById('add-ingredient').disabled = false;
    }
}

window.addEventListener('load', function() {
    let selectedIngredients = Array.from(document.querySelectorAll('.ingredient-select'))
        .map(select => select.value);

    document.querySelectorAll('.ingredient-select').forEach(select => {
        selectedIngredients.forEach(id => {
            if (select.value !== id) {
                let option = select.querySelector(`option[value="${id}"]`);
                option.disabled = true;
                option.classList.add('bg-gray-700');
                option.textContent += ' (digunakan)';
            }
        });
    });

    // Set kondisi awal untuk tombol "Add Ingredient"
    checkAllIngredientsSelected();
});
</script>


<div class="mb-4">
    <label class="block text-gray-700 dark:text-gray-400">Bahan yang Digunakan</label>
    <div id="ingredients-container">
        <?php foreach ($recipe_ingredients as $index => $ingredient_id): ?>
        <div class="ingredient-item mb-2">
            <select name="ingredients[<?= $index ?>][id]"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ingredient-select">
                <?php foreach ($ingredients as $ing): ?>
                <option value="<?= $ing['id'] ?>"
                    <?= set_select('ingredients[' . $index . '][id]', $ing['id'], $ing['id'] == $ingredient_id) ?>>
                    <?= $ing['ingredients_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="ingredients[<?= $index ?>][amount]"
                value="<?= set_value('ingredients[' . $index . '][amount]', $recipe_amounts[$index]) ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2 ingredient-amount"
                placeholder="Amount" required min="1" />

            <button type="button"
                class="remove-ingredient text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-3 py-1 mt-1">Remove</button>

        </div>

        <?php endforeach; ?>
    </div>
    <?php if (session()->getFlashdata("error")): ?>

    <div class="ms-3 text-xl font-bold text-red-500"> <?= session()->getFlashdata("error") ?>

    </div>

    <?php endif; ?>
    <button type="button" id="add-ingredient"
        class="text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800 font-medium rounded-lg text-sm px-5 py-2.5 mt-2">Add
        Ingredient</button>
</div>