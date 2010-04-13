<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuLeft
 *
 * @author hathor
 */
class MenuLeftModel extends Model
{
    public function getMenu()
    {
        $sql = "SELECT * FROM tpl_menu GROUP BY country";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $red = $sth->fetchall();
        return $red;
    }
}
?>
