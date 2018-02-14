<?php

//Llamada al modelo
require_once("models/products_model.php");
require_once("models/brand_model.php");
require_once("models/promotion_model.php");

class products_controller {

    /**
     * Muestra pantalla 'add'
     * @return No
     */
    function add() {
        require_once("views/products_add.phtml");
    }

    /**
     * Mostra llistat
     * @return No
     */
    function view() {
        $producto = new products_model();

        $orderedCategories = $this->getAllCategories();

        //Uso metodo del modelo de personas
        $datos = $producto->get_products();

        $promotion = new promotion_model();

        $datosCar = $promotion->get_carousel();


        //Llamado a la vista: mostrar la pantalla
        require_once("views/home.phtml");
    }

    /**
     *
     * @return
     */
    function viewPage($id) {
        $producto = new products_model();

        $id = $_GET['id'];
        $product = $producto->viewPage($id);
        require_once("views/products_view.phtml");
    }

    /**
     *
     * @return
     */
    function viewPageCat($idSubCat) {
        $producto = new products_model();

        $idSubCat = $_GET['idSubcategory'];
        $datos = $producto->viewPageCat($idSubCat);

        $orderedCategories = $this->getAllCategories();
        require_once("views/homeCat.phtml");
    }


    /**
     * Inserta a la taula
     * @return No
     */
    function insert() {
        $producto = new products_model();

        $producto->setName($_POST['nombre']);
        $producto->setShortDescription($_POST['descCorta']);
        $producto->setLongDescription($_POST['descLarga']);
        $producto->setSponsored($_POST['sponsor']);
        $producto->setPrice($_POST['precio']);
        $producto->setStock($_POST['stock']);
        $producto->setBrand($_POST['marca']);
        $producto->setCategory($_POST['categoria']);

        $error = $producto->insertar();
    }

    /*
     * * Fucnion que muestra la pagina de añadir producto
     */

    function addView() {

        $categoria = new categories_model();

        $datosC = $categoria->get_categoriesToProduct();

        $brand = new brand_model();

        $datosB = $brand->get_brands();


        require_once("views/products_add.phtml");
    }

    function search($valor) {

        $producto = new products_model();

        $datos = $producto->search($valor);

        $orderedCategories = $this->getAllCategories();

        $promotion = new promotion_model();

        $datosCar = $promotion->get_carousel();

        require_once("views/home.phtml");
    }

    public function getAllCategories() {
        $cat = new categories_model();
        $allCategories = $cat->get_all_categories();
        $orderedCategories = [];

        foreach ($allCategories as $category) {
            $id = $category['ID'];
            $name = $category['NAME'];
            $pCategory = $category['PARENTCATEGORY'];
            if (empty($pCategory)) {
                if (!array_key_exists($id, $orderedCategories)) {
                    $orderedCategories[$id] = [];
                }
                $orderedCategories[$id][] = $name;
            } else {
                if (!array_key_exists($pCategory, $orderedCategories)) {
                    $orderedCategories[$pCategory] = [];
                }
                $orderedCategories[$pCategory][] = [
                    'ID' => $id,
                    'NAME' => $name
                ];
            }
        }
        return $orderedCategories;
    }

    public function getCart(){
        $productsOnCart = $_SESSION['cart'];

    }

}

?>
