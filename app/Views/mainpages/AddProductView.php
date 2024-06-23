<div class="container mx-auto lg:mt-32 mt-24">
    <div
        class="w-full p-4  bg-gray-50 shadow-2xl border border-gray-200 rounded-lg  sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-5 text-3xl font-bold text-amber-800 dark:text-white">Tambah Product Baru</h5>

        <div class="">
            <form action="<?= site_url('products/store') ?>" method="post" enctype="multipart/form-data">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="nama_produk"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Product</label>
                        <input type="text" id="nama_produk" name="nama_produk"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?= set_value("nama_produk")?>" />
                        <?php if(isset($validation) && $validation->hasError('nama_produk')): ?>
                        <p class="text-red-500"><?= $validation->getError('nama_produk') ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Category</label>

                        <select name="category" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" disabled selected>Pilih kategori</option>
                            <?php foreach ($categories as $category): ?>

                            <option value="<?= $category['id']; ?>"><?= $category['category_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($validation) && $validation->hasError('category')): ?>
                        <p class="text-red-500"><?= $validation->getError('category') ?></p>
                        <?php endif; ?>
                    </div>
                    <div>


                        <label for="units" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Satuan
                            Perunits
                            :</label>
                        <div>

                            <div class="relative flex items-center max-w-full">
                                <select id="unit" name="unit"
                                    class="bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Satuan</option>
                                    <option value="cup" <?= set_select('unit', 'cup') ?>>cup</option>
                                    <option value="pcs" <?= set_select('unit', 'pcs') ?>>pcs</option>
                                    <option value="pack" <?= set_select('unit', 'pack') ?>>pack</option>
                                    <option value="box" <?= set_select('unit', 'box') ?>>box</option>
                                    <option value="bag" <?= set_select('unit', 'bag') ?>>bag</option>
                                    <option value="bottle" <?= set_select('unit', 'bottle') ?>>bottle</option>
                                    <option value="can" <?= set_select('unit', 'can') ?>>can</option>
                                    <option value="jar" <?= set_select('unit', 'jar') ?>>jar</option>
                                    <option value="roll" <?= set_select('unit', 'roll') ?>>roll</option>
                                    <option value="tube" <?= set_select('unit', 'tube') ?>>tube</option>
                                    <option value="set" <?= set_select('unit', 'set') ?>>set</option>
                                    <option value="piece" <?= set_select('unit', 'piece') ?>>piece</option>
                                </select>
                            </div>
                            <?php if(isset($validation) && $validation->hasError('unit')): ?>
                            <p class="text-red-500"><?= $validation->getError('unit') ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if(isset($validation) && $validation->hasError('unit')): ?>
                        <p class="text-red-500"><?= $validation->getError('unit') ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="harga_satuan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Satuan</label>
                        <input type="text" id="harga_satuan" name="harga_satuan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?= set_value("harga_satuan")?>" oninput="formatCurrency(this)" />
                        <?php if(isset($validation) && $validation->hasError('harga_satuan')): ?>
                        <p class="text-red-500"><?= $validation->getError('harga_satuan') ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="foto" class="block text-gray-700">Foto Product</label>
                    <input type="file" name="foto" id="foto"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="<?= set_value('foto')?>">
                    <?php if(isset($validation) && $validation->hasError('foto')): ?>
                    <p class="text-red-500"><?= $validation->getError('foto') ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex justify-between items-center">
                    <input type="submit" value="Add Product"
                        class="text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <a href="<?= base_url('/products')?>"
                        class="text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center">batal</a>
                </div>


            </form>
        </div>
    </div>

</div>