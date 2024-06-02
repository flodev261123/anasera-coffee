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
                            Perunit
                            :</label>
                        <div class="relative flex items-center max-w-full">
                            <input type="text" id="unit" name="unit"
                                class="bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="<?=set_value("unit")?>" />
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
                            value="<?= set_value("harga_beli")?>" />
                        <?php if(isset($validation) && $validation->hasError('description')): ?>
                        <p class="text-red-500"><?= $validation->getError('description') ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="foto" class="block text-gray-700">Foto Bahan ( Opsional )</label>
                    <input type="file" name="foto" id="foto"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="<?= set_value('foto')?>">
                    <?php if(isset($validation) && $validation->hasError('foto')): ?>
                    <p class="text-red-500"><?= $validation->getError('foto') ?></p>
                    <?php endif; ?>
                </div>

                <input type="submit" value="Tambah Bahan"
                    class="text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            </form>
        </div>
    </div>

</div>