<div class="container mx-auto lg:mt-32 mt-24">
    <div
        class="w-full p-4  bg-gray-50 shadow-2xl border border-gray-200 rounded-lg  sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-5 text-3xl font-bold text-amber-800 dark:text-white">Tambah Bahan Baru</h5>

        <div class="">
            <form action="<?= site_url('ingredients/store_ingredients') ?>" method="post" enctype="multipart/form-data">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="nama_produk"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Bahan</label>
                        <input type="text" id="ingredients_name" name="ingredients_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?= set_value("ingredients_name")?>" />
                        <?php if(isset($validation) && $validation->hasError('ingredients_name')): ?>
                        <p class="text-red-500"><?= $validation->getError('ingredients_name') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Jumlah
                            Stock
                            :</label>
                        <div class="relative flex items-center max-w-full">
                            <input type="number" id="stock" name="stock"
                                class="bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="<?=set_value("stock")?>" />
                        </div>
                        <?php if(isset($validation) && $validation->hasError('stock')): ?>
                        <p class="text-red-500"><?= $validation->getError('stock') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Satuan
                            Perunit :</label>
                        <div class="relative flex items-center max-w-full">
                            <select id="unit" name="unit"
                                class="bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih Satuan</option>
                                <option value="g" <?= set_select('unit', 'g') ?>>gram (g)</option>
                                <option value="kg" <?= set_select('unit', 'kg') ?>>kilogram (kg)</option>
                                <option value="mg" <?= set_select('unit', 'mg') ?>>milligram (mg)</option>
                                <option value="lb" <?= set_select('unit', 'lb') ?>>pound (lb)</option>
                                <option value="oz" <?= set_select('unit', 'oz') ?>>ounce (oz)</option>
                                <option value="l" <?= set_select('unit', 'l') ?>>liter (l)</option>
                                <option value="ml" <?= set_select('unit', 'ml') ?>>milliliter (ml)</option>
                                <option value="mm" <?= set_select('unit', 'mm') ?>>millimeter (mm)</option>
                                <option value="in" <?= set_select('unit', 'in') ?>>inch (in)</option>

                            </select>
                        </div>
                        <?php if(isset($validation) && $validation->hasError('unit')): ?>
                        <p class="text-red-500"><?= $validation->getError('unit') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="harga beli"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                            Beli</label>
                        <input type="number" id="harga_beli" name="harga_beli"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?= set_value("harga_beli")?>" />
                        <?php if(isset($validation) && $validation->hasError('harga_beli')): ?>
                        <p class="text-red-500"><?= $validation->getError('harga_beli') ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <input type="text" id="description" name="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?= set_value("description")?>" />

                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <input type="submit" value="Tambah Bahan"
                        class="text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <a href="<?= base_url('/ingredients')?>"
                        class="text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center">batal</a>
                </div>

            </form>
        </div>
    </div>

</div>