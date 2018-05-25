<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Myitem_model extends CI_Model {

    private $tbl_kopi = 'tbl_kopi', $tbl_mesin = 'tbl_mesin', $tbl_sparepart = 'tbl_sparepart';


    public function getAllItemList($nama_item)
    {
        if(strtolower($nama_item) == 'kopi'){
            return $this->getItemKopi();
        }

        if(strtolower($nama_item) == 'mesin'){
            return $this->getItemMesin();
        }

        if(strtolower($nama_item) == 'sparepart'){
            return $this->getItemSparepart();
        }
    }

    public function getItemKopi($id = null)
    {
        if($item_id != null)
            $this->db->where('items_id', $id);
            
        $select = $this->db->where('status_data', 0)->get($this->tbl_kopi);
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }

    public function getItemMachine($id = null)
    {
        if($item_id != null)
            $this->db->where('items_id', $id);
            
        $select = $this->db->where('status_data', 0)->get($this->tbl_mesin);
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }

    public function getItemSparepart($id = null)
    {
        if($item_id != null)
            $this->db->where('items_id', $id);
            
        $select = $this->db->where('status_data', 0)->get($this->tbl_sparepart);
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }

    public function setWaitActiveOfferBy($type, $id)
    {
        $tables = '';
        
        $this->db->set('active_id', 2);

        switch (strtolower($type)) {
            case 'produk': $tables = $this->tbl_kopi; break;
            case 'mesin': $tables = $this->tbl_mesin; break;
            default: $tables = $this->tbl_sparepart; break;
        }

        $setwait = $this->db->where('items_id', $id)->update($tables);
        return ($setwait) ? true : false;
    }

    public function removeOfferItem($type, $id)
    {

    }

    public function removeOfferMachineBy($offer_id)
    {
        $delete = $this->db->set('status_data', 1)->where('machine_offer_id', $offer_id)->update($this->tbl_machine_offer);
        return ($delete) ? true : false;
    }

}

/* End of file Myitem_model.php */
