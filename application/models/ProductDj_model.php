<?php
class ProductDj_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_type_where($type)
    {
        switch ($type) {
            case 'DJ Produksi':
                $type_where = "type IN ('DJ','DJ,LS') AND isproduction=1";
                break;
            case 'DJ + GS Produksi':
                $type_where = "type IN('DJ,GS', 'DJ,GS,LS') AND isproduction=1";
                break;
            case 'DD Produksi':
                $type_where = "type = 'DD' AND isproduction=1";
                break;
            case 'DJ + BD Produksi':
                $type_where = "type = 'BD' AND isproduction=1";
                break;
            case 'DJ Beli':
                $type_where = "type IN('DJ','DJ,LS') AND isproduction=0";
                break;
            case 'DJ + GS Beli':
                $type_where = "type IN('DJ,GS','DJ,GS,LS') AND isproduction=0";
                break;
            case 'DD Beli':
                $type_where = "type = 'DD' AND isproduction=0";
                break;
            case 'DJ + BD Beli':
                $type_where = "type = 'BD' AND isproduction=0";
                break;
            default:
                $type_where = 'id IS NULL';
                break;
        }

        return $type_where;
    }

    public function get_stock_awal($type, $year, $month)
    {
        $type_where = $this->get_type_where($type);

        $this->db->select("COUNT(`product-dj`.id) as pcs
        , IFNULL(SUM(`product-dj`.weightg), 0) as carat
        , IFNULL(SUM(`product-dj`.weightm), 0) as gram
        , IFNULL(SUM(`product-dj`.cogm), 0) as cogm
        , IFNULL(SUM(`product-dj`.pricenet), 0) as net
        , IFNULL(SUM(`product-dj`.priceusr), 0) as usernet
        ");
        $this->db->from('product-dj');
        $this->db->join('stock-awal-dj', 'product-dj.code = stock-awal-dj.code');
        $this->db->where($type_where);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_stock_in_beli($type, $year, $month)
    {
        $type_where = $this->get_type_where($type);

        $this->db->select("COUNT(`product-dj`.id) as pcs
        , IFNULL(SUM(`product-dj`.weightg), 0) as carat
        , IFNULL(SUM(`product-dj`.weightm), 0) as gram
        , IFNULL(SUM(`product-dj`.pricenet), 0) as cogm
        , IFNULL(SUM(`product-dj`.pricenet), 0) as net
        , IFNULL(SUM(`product-dj`.priceusr), 0) as usernet
        ");
        $this->db->from('product-dj');
        $this->db->where($type_where);
        $this->db->where('YEAR(`product-dj`.purchasedt)', $year);
        $this->db->where('MONTH(`product-dj`.purchasedt)', $month);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_stock_in_buyback($type, $year, $month)
    {
        $type_where = $this->get_type_where($type);

        $this->db->select("COUNT(id) as pcs
        , IFNULL(SUM(weightg), 0) as carat
        , IFNULL(SUM(weightm), 0) as gram
        , IFNULL(SUM(pricenet), 0) as cogm
        , IFNULL(SUM(pricenet), 0) as net
        , IFNULL(SUM(priceusr), 0) as usernet
        ");
        $this->db->from('buyback-dj');
        $this->db->where($type_where);
        $this->db->where('YEAR(buybackdt)', $year);
        $this->db->where('MONTH(buybackdt)', $month);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_stock_out_penjualan($type, $year, $month)
    {
        $type_where = $this->get_type_where($type);

        $this->db->select("COUNT(id) as pcs
        , IFNULL(SUM(weightg), 0) as carat
        , IFNULL(SUM(weightm), 0) as gram
        , IFNULL(SUM(pricenet), 0) as cogm
        , IFNULL(SUM(pricenet), 0) as net
        , IFNULL(SUM(priceusr), 0) as usernet
        ");
        $this->db->from('sales-dj');
        $this->db->where($type_where);
        $this->db->where('YEAR(salesdt)', $year);
        $this->db->where('MONTH(salesdt)', $month);

        $query = $this->db->get();
        return $query->row_array();
    }
}