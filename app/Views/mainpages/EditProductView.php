<!-- EditProductView.php -->
<div class="container mt-32 mb-10 mx-auto px-4">
    <div
        class="w-full p-4  bg-gray-50 shadow-2xl border border-gray-200 rounded-lg  sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="mb-5 text-3xl font-bold text-amber-800 dark:text-white">Edit Produk</h2>


        <form action="<?= site_url('products/update/' . $product['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label for="nama_produk" class="block text-gray-700 dark:text-gray-400">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk"
                    value="<?= set_value('nama_produk', $product['nama_produk']) ?>"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <?php if(isset($validation) && $validation->hasError('nama_produk')): ?>
                <p class="text-red-500"><?= $validation->getError('nama_produk') ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-gray-700 dark:text-gray-400">Category</label>
                <select name="category" id="category"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"
                        <?= set_select('category', $category['id'], $category['id'] == $product['category']) ?>>
                        <?= $category['category_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if(isset($validation) && $validation->hasError('category')): ?>
                <p class="text-red-500"><?= $validation->getError('category') ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="harga_satuan" class="block text-gray-700 dark:text-gray-400">Harga Satuan</label>
                <input type="number" name="harga_satuan" id="harga_satuan"
                    value="<?= set_value('harga_satuan', $product['harga_satuan']) ?>"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <?php if(isset($validation) && $validation->hasError('harga_satuan')): ?>
                <p class="text-red-500"><?= $validation->getError('harga_satuan') ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="unit" class="block text-gray-700 dark:text-gray-400">Satuan</label>
                <input type="text" name="unit" id="unit" value="<?= set_value('unit', $product['unit']) ?>"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <?php if(isset($validation) && $validation->hasError('unit')): ?>
                <p class="text-red-500"><?= $validation->getError('unit') ?></p>
                <?php endif; ?>
            </div>
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                <div class="max-w-full">


                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">Click to upload</span> or drag and drop</p>

                            </div>
                            <input id="dropzone-file" type="file" name="foto" class="hidden" />
                            <?php if(isset($validation) && $validation->hasError('foto')): ?>
                            <p class="text-red-500"><?= $validation->getError('foto') ?></p>
                            <?php endif; ?>
                        </label>
                    </div>


                </div>

                <div class="">
                    <figure class="max-w-md">

                        <img class="w-full h-64 rounded-lg" src="<?= base_url($product['foto']) ?>"
                            alt="image description">

                    </figure>

                </div>

            </div>


            <?php if (session()->getFlashdata("no_recipe")): ?>
            <h1 class="text-amber-700 font-bold text-lg text-center mt-5"> <?= session()->getFlashdata("no_recipe") ?>
            </h1>
            <?php endif; ?>
            <div>
                <div class="flex justify-between items-center">
                    <button type="submit"
                        class="text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800  font-medium rounded-lg text-sm lg:w-36 w-full px-5 py-2.5 text-center">Update
                        Produk

                    </button>
                    <a href="<?= base_url('/products')?>"
                        class="text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center">batal</a>
                </div>


            </div>
        </form>
    </div>
</div>