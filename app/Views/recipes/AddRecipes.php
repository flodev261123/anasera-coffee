<!-- AddRecipeView.php -->
<div class="container mt-32 mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">Add Recipe</h2>
    <form action="<?= site_url('recipes/storeRecipe') ?>" method="post" class="bg-white p-6 rounded-lg shadow-md">
        <input type="hidden" name="product_id" value="<?= $product_id ?>">

        <div class="mb-4">
            <label for="ingredients" class="block text-sm font-medium text-gray-700 mb-2">Ingredients:</label>
            <?php foreach ($ingredients as $ingredient): ?>
            <div class="flex items-center mb-2">
                <input type="checkbox" name="ingredients[]" value="<?= $ingredient['id'] ?>"
                    id="ingredient-<?= $ingredient['id'] ?>"
                    class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                <label for="ingredient-<?= $ingredient['id'] ?>"
                    class="ml-2 text-gray-700"><?= $ingredient['ingredients_name'] ?> (<?= $ingredient['unit'] ?>
                    available)</label>
                <input type="number" name="amount[<?= $ingredient['id'] ?>]"
                    class="ml-4 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Enter amount" step="any">
            </div>
            <?php endforeach; ?>
        </div>

        <button type="submit"
            class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add
            Recipe</button>
    </form>
</div>