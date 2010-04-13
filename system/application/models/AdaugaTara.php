<?php
/**
 * Description of AdaugaTara
 *
 * @author Bogdan Olteanu
 */
class AdaugaTaraModel extends Model {

    public function InsertCountry($country)
    {
        $sql = "INSERT INTO tpl_country(country) VALUES ('$country')";
        $this->db->query($sql);
    }

    public function InsertRegion($country, $region)
    {
        $sql = "INSERT INTO tpl_region(region, country) VALUES ('$region', '$country')";
        $this->db->query($sql);
    }
}
?>
