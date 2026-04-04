<?php 
namespace App\Controllers;

// Siguraduhon nga naga-match ini sa file name sang imo Model sa app/Models/
use App\Models\Product_model; 

class Products extends BaseController {

    // 1. READ: Listahan sang produkto
    public function index() {
        $model = new Product_model();
        $data = [
            'products' => $model->findAll(),
            'title'    => 'Riverside | Inventory'
        ];
        return view('products_list', $data); 
    }

    // 2. CREATE: Form sa pag-add
    public function add() {
        $data['title'] = 'Riverside | Add New Item';
        return view('add_product_view', $data);
    }

    // 3. CREATE: I-save sa Database
    public function store() {
        $model = new Product_model();
        $data = [
            'product_name' => $this->request->getPost('name'),
            'category'     => $this->request->getPost('category'),
            'price'        => $this->request->getPost('price'),
            'stock'        => $this->request->getPost('stock'),
        ];
        $model->insert($data);
        return redirect()->to(base_url('products'));
    }

    /**
     * 4. UPDATE: Form para sa pag-edit (FIXED & CLEANED)
     * Gin-isa naton ang logic para indi mag-conflict ang Model name.
     */
    public function edit($id = null) {
        $model = new Product_model(); // Gamiton ang husto nga model name
        
        $data = [
            'product' => $model->find($id),
            'title'   => 'Edit Product | Riverside' // Fix para sa Undefined variable $title
        ];

        // Check kon may nakita nga produkto para indi mag-error ang view
        if (empty($data['product'])) {
            return redirect()->to(base_url('products'));
        }

        return view('products_edit', $data);
    }

    // 5. UPDATE: I-save ang gin-edit
    public function update($id = null) {
        $model = new Product_model();
        $data = [
            'product_name' => $this->request->getPost('name'),
            'category'     => $this->request->getPost('category'),
            'price'        => $this->request->getPost('price'),
            'stock'        => $this->request->getPost('stock'),
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('products'));
    }

    // 6. DELETE: Pag-papas sang item
    public function delete($id = null) {
        $model = new Product_model();
        $model->delete($id);
        return redirect()->to(base_url('products'));
    }
}