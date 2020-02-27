<?php
    include_once("locations.php");

    $districts = getDistrictsByProvinceId($_POST["provId"]);

    foreach ($districts as $d) {
        echo "<option value='".$d["districtid"]."'>".$d["name"]."</option>";
    }

?>