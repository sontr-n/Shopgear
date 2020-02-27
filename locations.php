<?php
    require_once('config.php');

    function getProvinces() {
        $connection = getConnection();
        $sql = "SELECT * FROM provinces";
        $result = select($connection, $sql);
        closeConnection($connection);
        $provinces = array();
        while($item = mysqli_fetch_array($result)) {
            $item['districts'] = getDistrictsByProvinceId($item['provinceid']);
            $provinces[] = $item;
        }
        return $provinces;
    }

    function getProvincesById($provinceid) {
        $connection = getConnection();
        $sql = "SELECT provinceid, name, type FROM provinces WHERE provinceid=$provinceid";
        $result = select($connection, $sql);
        $province = mysqli_fetch_array($result);
        closeConnection($connection);
        return $province;
    }

    function getDistricts() {
        $connection = getConnection();
        $sql = "SELECT provinces.name AS provincename, districts.* FROM districts LEFT JOIN provinces ON districts.provinceid = provinces.provinceid";
        $result = select($connection, $sql);
        closeConnection($connection);
        $districts = array();
        while($item = mysqli_fetch_array($result)) {
            $districts[] = $item;
        }
        return $districts;
    }

    function getDistrictsByProvinceId($provinceid) {
        $connection = getConnection();
        $sql = "SELECT * FROM districts WHERE provinceid = $provinceid";
        $result = select($connection, $sql);
        closeConnection($connection);
        $districts = array();
        while($item = mysqli_fetch_array($result)) {
            $districts[] = $item;
        }
        return $districts;
    }  

    function getDistrictsById($districtid) {
        $connection = getConnection();
        $sql = "SELECT provinces.name AS provincename, districts.* FROM districts LEFT JOIN provinces ON districts.provinceid = provinces.provinceid WHERE districts.districtid=$districtid";
        $result = select($connection, $sql);
        $districts = mysqli_fetch_array($result);
        closeConnection($connection);
        return $districts;
    }   

?>