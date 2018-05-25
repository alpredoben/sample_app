<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Offers_model extends CI_Model {

    public function removeOfferMachineBy($offer_id)
    {
        $delete = $this->db->set('status_data', 1)->where('machine_offer_id', $offer_id)->update($this->tbl_machine_offer);
        return ($delete) ? true : false;
    }

}

/* End of file Offers_model.php */
