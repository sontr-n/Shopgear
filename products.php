<?php
    require_once('config.php');

    function getCategories() {
        $connection = getConnection();
        $sql = "SELECT * FROM categories WHERE active=1";
        $result = select($connection, $sql);
        closeConnection($connection);
        $categories = array();
        while($item = mysqli_fetch_array($result)) {
            $item['subcategories'] = getSubcategoriesByCategoryId($item['id']);
            $categories[] = $item;
        }
        return $categories;
    }

    function searchProductsByName($name) {
        $connection = getConnection();
        $sql = "SELECT * FROM products WHERE name LIKE '%$name%'";
        $result = select($connection, $sql);
        closeConnection($connection);
        $products = array();
        while($item = mysqli_fetch_array($result)) {
            $products[] = $item;
        }
        return $products;
    }

    function addCategory($name, $description) {
        $connection = getConnection();
        $sql = "INSERT INTO categories (name, description, active) VALUES ('$name', '$description', 1)";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }

    function getCategoryById($id) {
        $connection = getConnection();
        $sql = "SELECT id, name, description FROM categories WHERE id=$id";
        $result = select($connection, $sql);
        $category = mysqli_fetch_array($result);
        closeConnection($connection);
        return $category;
    }

    function deleteCategory($id) {
        $connection = getConnection();
        $sql = "DELETE FROM categories WHERE id=$id";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }

    function updateCategory($id, $name, $description) {
        $connection = getConnection();
        $sql = "UPDATE categories SET name = '$name', description = '$description' WHERE id=$id";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }

    function getSubcategories() {
        $connection = getConnection();
        $sql = "SELECT categories.name AS catename, subcategories.* FROM subcategories LEFT JOIN categories ON subcategories.cateid = categories.id";
        $result = select($connection, $sql);
        closeConnection($connection);
        $subcategories = array();
        while($item = mysqli_fetch_array($result)) {
            $subcategories[] = $item;
        }
        return $subcategories;
    }

    function getSubcategoriesByCategoryId($cateid) {
        $connection = getConnection();
        $sql = "SELECT categories.name AS catename, subcategories.* FROM subcategories LEFT JOIN categories ON subcategories.cateid = categories.id WHERE cateid=$cateid";
        $result = select($connection, $sql);
        closeConnection($connection);
        $subcategories = array();
        while($item = mysqli_fetch_array($result)) {
            $subcategories[] = $item;
        }
        return $subcategories;
    }

    function getSubcategoryById($id) {
        $connection = getConnection();
        $sql = "SELECT categories.name AS catename, subcategories.* FROM subcategories LEFT JOIN categories ON subcategories.cateid = categories.id WHERE subcategories.id = $id";
        $result = select($connection, $sql);
        $subcategories = mysqli_fetch_array($result);
        closeConnection($connection);
        return $subcategories;
    }

    function updateSubcategory($id, $name, $description) {
        $connection = getConnection();
        $sql = "UPDATE subcategories SET name = '$name', description = '$description' WHERE id=$id";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }

    function addSubcategory($cateid, $name, $description) {
        $connection = getConnection();
        $sql = "INSERT INTO subcategories (cateid, name, description, active) VALUES ('$cateid','$name', '$description', 1)";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }

    function getCategoryName($cateid) {
        $connection = getConnection();
        $sql = "SELECT name FROM categories WHERE id=$cateid";
        $result = select($connection, $sql);
        closeConnection($connection);
        $item = mysqli_fetch_array($result);
        return $item['name'];
    }

    function getSubcategoryName($subcateid) {
        $connection = getConnection();
        $sql = "SELECT name FROM subcategories WHERE id=$subcateid";
        $result = select($connection, $sql);
        closeConnection($connection);
        $item = mysqli_fetch_array($result);
        return $item['name'];
    }

    function deleteSubcategory($id) {
        $connection = getConnection();
        $sql = "DELETE FROM subcategories WHERE id=$id";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }

    function getProducts($page = 1, $limit = 20) {
        $offset = $limit * ($page - 1);
        $connection = getConnection();
        $sql = "SELECT categories.id AS cateid, categories.name AS catename, subcategories.id AS subcateid, subcategories.name as subcatename, products.* FROM products LEFT JOIN subcategories ON products.subcateid = subcategories.id LEFT JOIN categories ON products.cateid = categories.id LIMIT $offset,$limit";
        $result = select($connection, $sql);
        closeConnection($connection);
        $products = array();
        while($item = mysqli_fetch_array($result)) {
            $products[] = $item;
        }
        return $products;
    }

    function countPageProducts($limit = 20) {
        $connection = getConnection();
        $sql = "SELECT COUNT(*) AS count FROM products LEFT JOIN subcategories ON products.subcateid = subcategories.id LEFT JOIN categories ON products.cateid = categories.id";
        $result = select($connection, $sql);
        closeConnection($connection);
        $products = array();
        $item = mysqli_fetch_array($result);
        $count = $item['count'];
        $pagecount = 0;
        if ($count % $limit == 0) {
            $pagecount = $count / $limit;
        } else {
            $pagecount = $count / $limit + 1;
        }
        return $pagecount;
    }

    function getProductsByCateId($cateid, $page = 1, $limit = 20) {
        $offset = $limit * ($page - 1);
        $connection = getConnection();
        $sql = "SELECT categories.id AS cateid, categories.name AS catename, subcategories.id AS subcateid, subcategories.name as subcatename, products.* FROM products LEFT JOIN subcategories ON products.subcateid = subcategories.id LEFT JOIN categories ON products.cateid = categories.id WHERE products.cateid = $cateid LIMIT $offset,$limit";
        $result = select($connection, $sql);
        closeConnection($connection);
        $products = array();
        while($item = mysqli_fetch_array($result)) {
            $products[] = $item;
        }
        return $products;
    }

    function countPageProductsByCateId($cateid, $limit = 20) {
        $connection = getConnection();
        $sql = "SELECT COUNT(*) AS count FROM products LEFT JOIN subcategories ON products.subcateid = subcategories.id LEFT JOIN categories ON products.cateid = categories.id WHERE products.cateid = $cateid";
        $result = select($connection, $sql);
        closeConnection($connection);
        $products = array();
        $item = mysqli_fetch_array($result);
        $count = $item['count'];
        $pagecount = 0;
        if ($count % $limit == 0) {
            $pagecount = $count / $limit;
        } else {
            $pagecount = $count / $limit + 1;
        }
        return $pagecount;
    }

    function getProductsBySubcateId($subcateid, $page = 1, $limit = 20) {
        $offset = $limit * ($page - 1);
        $connection = getConnection();
        $sql = "SELECT categories.id AS cateid, categories.name AS catename, subcategories.id AS subcateid, subcategories.name as subcatename, products.* FROM products LEFT JOIN subcategories ON products.subcateid = subcategories.id LEFT JOIN categories ON products.cateid = categories.id WHERE products.subcateid = $subcateid LIMIT $offset,$limit";
        $result = select($connection, $sql);
        closeConnection($connection);
        $products = array();
        while($item = mysqli_fetch_array($result)) {
            $products[] = $item;
        }
        return $products;
    }

    function countPageProductsBySubcateId($subcateid, $limit = 20) {
        $connection = getConnection();
        $sql = "SELECT COUNT(*) AS count FROM products LEFT JOIN subcategories ON products.subcateid = subcategories.id LEFT JOIN categories ON products.cateid = categories.id WHERE products.subcateid = $subcateid";
        $result = select($connection, $sql);
        closeConnection($connection);
        $products = array();
        $item = mysqli_fetch_array($result);
        $count = $item['count'];
        $pagecount = 0;
        if ($count % $limit == 0) {
            $pagecount = $count / $limit;
        } else {
            $pagecount = $count / $limit + 1;
        }
        return $pagecount;
    }

    function formatPrice($value) {
        return number_format(floatval($value), 0, 0, ',');
    }

    function overrideParams($original, $key, $value) {
        parse_str($original, $params);
        $paramkeys = array_keys($params);
        $result = '';
        $hasKey = false;
        for($i = 0; $i < count($paramkeys); $i++) {
            if ($paramkeys[$i] == $key) {
                $hasKey = true;
                $result = $result.$paramkeys[$i].'='.$value.'&';
            } else {
                $result = $result.$paramkeys[$i].'='.$params[$paramkeys[$i]].'&';
            }
        }
        if (!$hasKey) {
            $result = $result.$key.'='.$value;
        }
        return $result;
    }

    function getProductById($id) {
        $connection = getConnection();
        $sql = "SELECT id, cateid, subcateid, name, producer, remaining, price FROM products WHERE id=$id";
        $result = select($connection, $sql);
        closeConnection($connection);
        $product = mysqli_fetch_array($result);
        return $product;
    }

    function getProductDetailById($id) {
        $connection = getConnection();
        $sql = "SELECT id, cateid, subcateid, name, producer, remaining, price, description, origin, warranty, date FROM products WHERE id=$id";
        $result = select($connection, $sql);
        closeConnection($connection);
        $product = mysqli_fetch_array($result);
        return $product;
    }

    function addProduct($cateid, $subcateid, $name, $producer, $remaining, $price, $description, $origin, $warranty, $date) {
        $connection = getConnection();
        $sql = "INSERT INTO products (cateid, subcateid, name, producer, remaining, price, description, origin, warranty, date) VALUES ('$cateid', '$subcateid', '$name', '$producer', 
            '$remaining','$price','$description', '$origin', '$warranty', '$date')";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }

    function deleteProduct($id) {
        $connection = getConnection();
        $sql = "DELETE FROM products WHERE id=$id";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }

    function updateProduct($id, $cateid, $subcateid, $name, $producer, $remaining, $price, $description, $origin, $warranty, $date) {
        $connection = getConnection();
        $sql = "UPDATE products SET cateid='$cateid', subcateid='$subcateid', name='$name', producer='$producer', remaining='$remaining', price='$price', 
            description='$description', origin='$origin', warranty='$warranty', date='$date' WHERE id='$id'";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }
   
    function insertPayment($to, $address, $phone, $total) {
        $connection = getConnection();
        $sql = "INSERT INTO payments (`to`, `address`, `phone`, `total`) VALUES ('$to', '$address','$phone', '$total')";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }
    function getPayments() {
        $connection = getConnection();
        $sql = "SELECT * FROM payments";
        $result = select($connection, $sql);
        closeConnection($connection);
        $items = array();
        while($item = mysqli_fetch_array($result)) {
            $items[] = $item;
        }
        return $items;
    }
    // function showprice($price){
    //     $len = strlen($price);
    //     $counter = 3;
    //     $result = "";
    //     while ($len-$counter>=0)
    //     {
    //         $con = substr($price, $len-$counter, 3);
    //         $result = ','.$con.$result;
    //         $counter += 3;
    //     }
    //     $con = substr($price, 0, 3-($counter-$len));
    //     $result = $con.$result;
    //     if(substr($result,0,1)==','){
    //         $result=substr($result,1,$len+1);
    //     }
    //     return result;
    // }
?>