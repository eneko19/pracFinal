<?php

//Llamada al modelo
require_once("models/products_model.php");
require_once("models/brand_model.php");
require_once("models/promotion_model.php");

class products_controller {

    /**
     * Muestra pantalla 'add' de producto
     */
    function add() {
        require_once("views/products_add.phtml");
    }

    /**
     * Muestra la página principal con todas sus categorias para el menu, los productos y las promociones para el carrousel
     * Requiere la vista de home.phtml
     */
    function view($pagina) {
        $producto = new products_model();
        $numResultados = $producto->get_productsPagination();
        $productPorPagina = 4;

        $datos = $producto->get_products($pagina, $numResultados);
        $numPaginas = ceil($numResultados / $productPorPagina);


        $orderedCategories = $this->getAllCategories();

        $promotion = new promotion_model();

        $datosCar = $promotion->get_carousel();

        $cart = new cart_model();
        if (!empty($_SESSION['usuario'])){
        if (!empty($_SESSION['cart'])) {
            $idOrder = $_SESSION['idOrder'];
            $products = $cart->get_cartFromDB($idOrder);
        }else{
            $products = $cart->get_lastProducts();

            
            
        }}


        //Llamado a la vista: mostrar la pantalla
        require_once("views/home.phtml");
    }

    /**
     * Muestra la página de un producto dado su id
     * Recoge el id y lo manda a la función del modelo
     */
    function viewPage($id) {
        $producto = new products_model();

        $id = $_GET['id'];
        $product = $producto->viewPage($id);
        $cart = new cart_model();
        if (!empty($_SESSION['usuario'])){
        if (!empty($_SESSION['cart'])) {
            $idOrder = $_SESSION['idOrder'];
            $products = $cart->get_cartFromDB($idOrder);
        }}

        require_once("views/products_view.phtml");
    }

    /**
     * Muestra en la página todos los productos según la subcategoría
     * Recoge el id de la subcategoría y lo manda a la función del modelo
     */
    function viewPageCat($idSubCat) {
        $producto = new products_model();

        $idSubCat = $_GET['idSubcategory'];
        $datos = $producto->viewPageCat($idSubCat);

        $orderedCategories = $this->getAllCategories();
        // Para mostrar las marcas en la nueva vista
        $brand = new brand_model();
        $marcas = $brand->get_brands($idSubCat);
        $cart = new cart_model();
        if (!empty($_SESSION['usuario'])){
        if (!empty($_SESSION['cart'])) {
            $idOrder = $_SESSION['idOrder'];
            $products = $cart->get_cartFromDB($idOrder);
        }}

        require_once("views/homeCat.phtml");
    }

    /**
     * Inserta un nuevo producto a la base de datos
     * @return No
     */
    function insert() {
        $producto = new products_model();

        // Guarda las variables recogidas del formulario en los seters del modelo
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
     * * Función que muestra la pagina de añadir producto
     */

    function addView() {

        $categoria = new categories_model();

        // Saca la categorías para mostrarlas en las options
        $datosC = $categoria->get_categoriesToProduct();

        $brand = new brand_model();

        // Saca las marcas para mostrarlas en las options
        $datosB = $brand->get_brandsToProd();

        require_once("views/products_add.phtml");
    }

    /*
     * * Función que filtra los productos según el valor que le pases
     *
     */

    function search($valor) {
                $cart = new cart_model();
        if (!empty($_SESSION['usuario'])){
        if (!empty($_SESSION['cart'])) {
            $idOrder = $_SESSION['idOrder'];
            $products = $cart->get_cartFromDB($idOrder);
        }}
        $producto = new products_model();

        $datos = $producto->search($valor);

        $orderedCategories = $this->getAllCategories();

        $promotion = new promotion_model();

        $datosCar = $promotion->get_carousel();

        require_once("views/home.phtml");
    }

    /*
     * * Función que muestra las categorías y sus subcategorías
     */

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

    /*
     * * Función que muestra la pagina de añadir producto
     */

    public function getCart() {
        $productsOnCart = $_SESSION['cart'];
    }

}

?>
