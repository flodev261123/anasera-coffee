<?php 

namespace App\Models;

use CodeIgniter\Model;

class IngredientsModel extends Model {

    protected $table = "ingredients";
    protected $primaryKey = 'id';

    protected $allowedFields = ['ingredients_name', 'stock', 'unit', 'foto', 'description', 'harga_beli'];

    protected bool $allowEmptyInserts = false;

    public function decreaseStock($ingredient_id, $amount)
    {
        $ingredient = $this->find($ingredient_id);
        if ($ingredient && $ingredient['stock'] >= $amount) {
            $this->update($ingredient_id, ['stock' => $ingredient['stock'] - $amount]);
        } else {
           
            $err = "gagal, jumlah barang keluar lebih besar dari jumlah stock bahan";

            session()->setFlashdata('error', $err);
            return redirect()->to("products");
        }
    }
}