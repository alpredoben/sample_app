<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Offered_model extends CI_Controller {

    private $tbl_product_offer = 'dto_product_offer';
    private $tbl_machine_offer = 'dto_machine_offer';
    private $tbl_sparepart_offer = 'dto_sparepart_offer';

    private $tbl_product = 'dto_product';
    private $tbl_active_status = 'dto_status_active';
    private $tbl_stock_status = 'dto_status_stok';

    /** ####################### SET WAIT ACTIVE OFFER ALL ITEM #################################### */
    public function setWaitActiveOfferBy($type, $id)
    {
        $this->db->set('active_id', 2);

        switch (strtolower($type)) {
            case 'produk':
                $where = array('product_offer_id' => $id);      
                $offer_table = $this->tbl_product_offer; 
                break;
            case 'mesin':
                $where = array('machine_offer_id' => $id);       
                $offer_table = $this->tbl_machine_offer; 
                break;
            default: 
                $where = array('sparepart_offer_id' => $id); 
                $offer_table = $this->tbl_sparepart_offer; 
                break;
        }

        $set_wait = $this->db->where($where)->update($offer_table);
        return ($set_wait) ? true : false;
    }

    

    /** ####################### CONFIGURATE MODUL QUERY FOR PRODUCT OFFER ########################################## */

    public function insertProductOffer($insert_data)
    {
        $insert = $this->db->insert($this->tbl_product_offer, $insert_data);
        return ($insert) ? true :false;
    }

    public function set_defult_product_offer($field='*')
    {
        $this->db->select($field);
        $this->db->from($this->tbl_product_offer . ' po');
        $this->db->join($this->tbl_product . ' p', 'p.product_id = po.product_code');
        $this->db->join($this->tbl_active_status . ' sa', 'sa.activate_id = po.active_id');
        $this->db->join($this->tbl_stock_status . ' ss', 'ss.stok_id = po.stok_id');
        $this->db->where(array(
            'po.status_data' => 0,
            'sa.activate_id' => 4,
            'ss.stok_id' => 1
        ));
    }

    public function setDataTableProductOffer($search = '')
    {

        $field = 'po.product_offer_id , p.product_id , p.product_name , po.quantity , po.product_price , po.discount , po.create_date , po.update_date , sa.activate_id , sa.active_name';

        $this->set_defult_product_offer($field);
        
        $arr_field = explode(' , ', $field);
        $i=0;
        foreach ($arr_field as $item) 
        {
            if($search != ''){
                if($i==0){
                    $this->db->group_start();
                    $this->db->like($item, $search);
                }
                else{
                    $this->db->or_like($item, $search);
                }

                if(count($arr_field)-1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        $this->db->order_by('po.create_date', 'desc');
    }

    public function getDataTableProductOffer($search='', $length, $start)
    {
        $this->setDataTableProductOffer($search);
        
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }
 
    public function countRecordProductOffer()
    {
        $this->set_defult_product_offer();
        return $this->db->count_all_results();
    }

    public function countFilterProductOffer($search='')
    {
        $this->setDataTableProductOffer($search);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function removeOfferProductBy($offer_id)
    {
        $delete = $this->db->set('status_data', 1)->where('product_offer_id', $offer_id)->update($this->tbl_product_offer);
        return ($delete) ? true : false;
    }


    /** ################################## CONFIGURATE MODULE QUERY FOR MACHINE ############################### */
    public function insertMachineOffer($insert_data)
    {
        $insert = $this->db->insert($this->tbl_machine_offer, $insert_data);
        return ($insert) ? true :false;
    }

}

/* End of file Offered_model.php */
