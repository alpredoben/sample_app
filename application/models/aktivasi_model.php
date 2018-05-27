<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi_model extends CI_Model {

    private $tbl_penawaran = 'dto_penawaran';
    private $tbl_items = 'dto_items';
    private $tbl_kategori = 'dto_kategori';
    private $tbl_user = 'dto_user';
    private $tbl_aktifasi = 'dto_aktifasi';
    private $tbl_stok = 'dto_stok';
    private $tbl_status = 'dto_status';

    public function set_datatable_aktivasi($search = '', $id_aktivasi='', $id_kategori = '')
    {
        $fields = 'pn.id_penawaran, it.id_item, it.kode_item, it.nama_item, pn.kuantitas, pn.harga_item, pn.diskon, kt.id_kategori, kt.nama_kategori, s.id_status, s.keterangan, st.id_stok, st.status_stok, ak.id_aktifasi, ak.nama_aktifasi, pn.active_date';

        $this->db->select($fields);
        $this->db->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_items     . ' it', 'it.id_item = pn.id_item', 'left');
        $this->db->join($this->tbl_kategori  . ' kt', 'kt.id_kategori = pn.id_kategori', 'left');
        $this->db->join($this->tbl_stok      . ' st', 'st.id_stok = pn.id_stok', 'left');
        $this->db->join($this->tbl_aktifasi  . ' ak', 'ak.id_aktifasi = pn.id_aktifasi', 'left');
        $this->db->join($this->tbl_status    . ' s', 's.id_status = pn.id_status', 'left');

        $this->db->where('st.id_stok', 1);
        $this->db->where('s.id_status', 0);

        if(!empty($id_aktivasi))
            $this->db->where('pn.id_aktifasi', $id_aktivasi);

        if(!empty($id_kategori))
            $this->db->where('pn.id_kategori', $id_kategori);
        
        
        $i=0;
        $fields = explode(',', ($fields));
        foreach ($fields as $item) 
        {
            if($search != ''){
                if($i==0){
                    $this->db->group_start();
                    $this->db->like(trim($item), $search);
                }
                else{
                    $this->db->or_like(trim($item), $search);
                }

                if(count($fields)-1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        $this->db->order_by('pn.id_penawaran', 'asc');
    }

    public function get_datatable_aktivasi($search, $length, $start, $id_aktivasi='', $id_kategori='')
    {
        $this->set_datatable_aktivasi($search, $id_aktivasi, $id_kategori);
        
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }

    public function count_record_aktivasi($id_aktivasi='', $id_kategori='')
    {
        $this->set_datatable_aktivasi('', $id_aktivasi, $id_kategori );
        return $this->db->count_all_results();
    }

    public function count_filter_aktivasi($search='', $id_aktivasi='', $id_kategori='')
    {
        $this->set_datatable_aktivasi($search, $id_aktivasi, $id_kategori);
        $query = $this->db->get();
        return $query->num_rows();
    }


}

/* End of file Aktivasi_model.php */
