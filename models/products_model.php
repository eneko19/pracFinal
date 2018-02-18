<?php

class products_model {

    private $db;
    private $products;
    private $id;
    private $name;
    private $stock;
    private $price;
    private $sponsored;
    private $shortdescription;
    private $longdescription;
    private $brand;
    private $category;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    /* GETTERS & SETTERS */

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getSponsored() {
        return $this->sponsored;
    }

    public function setSponsored($sponsored) {
        $this->sponsored = $sponsored;
    }

    public function getShortDescription() {
        return $this->shortdescription;
    }

    public function setShortDescription($shortdescription) {
        $this->shortdescription = $shortdescription;
    }

    public function getLongDesc() {
        return $this->longdescription;
    }

    public function setLongDescription($longdescription) {
        $this->longdescription = $longdescription;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    /**
     * Extrae todos los productos de las tablas PRODUCT,IMAGE y PROMOTION donde la columna SPONSOR sea igual a "y"
     * @return array Bidimensional de las tablas PRODUCT,IMAGE y PROMOTION donde la columna SPONSOR sea igual a "y"
     */
    public function get_products($pagina, $numResultados) {
        
        $productPorPagina = 4;   
        
        $limit = ($pagina-1) * $productPorPagina;
        
        $consulta = $this->db->query("SELECT *,prod.ID, img.URL,FORMAT((prod.PRICE * (1-(p.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL
    FROM PRODUCT prod
    join IMAGE img on prod.ID = img.PRODUCT
    left join PROMOTION p on p.PRODUCT = prod.ID
    WHERE SPONSORED = 'y' limit {$limit},{$productPorPagina};");

        while ($filas = $consulta->fetch_assoc()) {
            $this->products[] = $filas;
        }


        return $this->products;
    }

    /**
     * Extrae todos los productos
     * @return type con todos los productos
     */
    public function get_productsToPromotion() {
        $consulta = $this->db->query("SELECT * FROM PRODUCT;");

        while ($filas = $consulta->fetch_assoc()) {
            $this->products[] = $filas;
        }


        return $this->products;
    }

    /**
     * Inserta un registro a la tabla
     * @return [false]  si no ha ocurrido ningún error,
     *         [string] de sql y el error si algo a ido mal
     */
    public function insertar() {

        $sql = "INSERT INTO PRODUCT (NAME, SHORTDESCRIPTION, LONGDESCRIPTION, STOCK, PRICE, SPONSORED, BRAND, CATEGORY)
              VALUES ('{$this->name}','{$this->shortdescription}','{$this->longdescription}','{$this->stock}','{$this->price}',
              '{$this->sponsored}','{$this->brand}','{$this->category}')";

        $result = $this->db->query($sql);

        if ($this->db->error)
            return "$sql<br>{$this->db->error}";
        else {
            return false;
        }
    }

    /**
     * Muestra la página del producto cuyo id le pases por parámetro
     * @param type $id el id del producto
     * @return type de la query segun el id
     */
    public function viewPage($id) {
        $sql = "SELECT *,prod.ID, img.URL,FORMAT((prod.PRICE * (1-(p.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL
    FROM PRODUCT prod
    left join IMAGE img on prod.ID = img.PRODUCT
    left join PROMOTION p on p.PRODUCT = prod.ID
    WHERE prod.ID=$id";

        $result = $this->db->query($sql);

        $fila = $result->fetch_assoc();
        return $fila;
    }

    /**
     * Muestra los productos según la subcategoria
     * @param type $idSubCat Identificador de la subcategoría
     * @return type de todos los productos identificados por el idSubCat
     */
    public function viewPageCat($idSubCat) {

        $consulta = $this->db->query("SELECT *,prod.ID, img.URL,FORMAT((prod.PRICE * (1-(p.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL
        FROM PRODUCT prod
        left join IMAGE img on prod.ID = img.PRODUCT
        left join PROMOTION p on p.PRODUCT = prod.ID
        WHERE CATEGORY='$idSubCat';");

        while ($filas = $consulta->fetch_assoc()) {
            $this->products[] = $filas;
        }
        return $this->products;
    }

    /**
     * Muestra los productos según el valor pasado por parámetro
     * @param type $valor Valor que busques en el buscador
     * @return type devuelve productos donde el valor este en algun campos de la descripción corta
     */
    public function search($valor) {

        $consulta = $this->db->query("SELECT *,prod.ID, img.URL,FORMAT((prod.PRICE * (1-(p.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL 
            FROM PRODUCT prod
            left join IMAGE img on prod.ID = img.PRODUCT
            left join PROMOTION p on p.PRODUCT = prod.ID
            WHERE SHORTDESCRIPTION like '%$valor%';");

        while ($filas = $consulta->fetch_assoc()) {
            $this->products[] = $filas;
        }
        return $this->products;
    }

    public function get_productsPagination() {
        $consulta = $this->db->query("SELECT count(prod.ID)
    FROM PRODUCT prod
    join IMAGE img on prod.ID = img.PRODUCT
    left join PROMOTION p on p.PRODUCT = prod.ID
    WHERE SPONSORED = 'y';");

        $filas = $consulta->fetch_array();
        $numProducts = $filas[0];

        return $numProducts;
    }

}

?>
