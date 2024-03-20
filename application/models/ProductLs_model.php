<?php
class ProductLs_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_type_id($type)
    {
        switch ($type) {
            case 'LS Generic':
                $type_id = 1;
                break;
            case 'LS Dossier':
                $type_id = 3;
                break;
            case 'LS Branded':
                $type_id = 4;
                break;
            case 'LS Gemstone':
                $type_id = 2;
                break;
            default:
                $type_id = 0;
                break;
        }

        return $type_id;
    }

    public function get_stock_awal($type, $year, $month)
    {
        $type_id = $this->get_type_id($type);

        $this->db->select("COUNT(`product-ls`.id) as pcs
        , IFNULL(SUM(`product-ls`.weight), 0) as carat
        , 0 as gram
        , IFNULL(SUM(`product-ls`.pricenet), 0) as cogm
        , IFNULL(SUM(`product-ls`.pricenet), 0) as net
        , IFNULL(SUM(`product-ls`.priceusr), 0) as usernet
        ");
        $this->db->from('product-ls');
        $this->db->join('stock-awal-ls', 'product-ls.code = stock-awal-ls.code');
        $this->db->where('product-ls.type', $type_id);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_stock_in_beli($type, $year, $month)
    {
        $type_id = $this->get_type_id($type);

        $this->db->select("COUNT(id) as pcs
        , IFNULL(SUM(weight), 0) as carat
        , 0 as gram
        , IFNULL(SUM(pricenet), 0) as cogm
        , IFNULL(SUM(pricenet), 0) as net
        , IFNULL(SUM(priceusr), 0) as usernet
        ");
        $this->db->from('product-ls');
        $this->db->where('type', $type_id);
        $this->db->where('YEAR(purchasedt)', $year);
        $this->db->where('MONTH(purchasedt)', $month);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_stock_in_buyback($type, $year, $month)
    {
        $type_id = $this->get_type_id($type);

        $this->db->select("COUNT(id) as pcs
        , IFNULL(SUM(weight), 0) as carat
        , 0 as gram
        , IFNULL(SUM(pricenet), 0) as cogm
        , IFNULL(SUM(pricenet), 0) as net
        , IFNULL(SUM(priceusr), 0) as usernet
        ");
        $this->db->from('buyback-ls');
        $this->db->where('type', $type_id);
        $this->db->where('YEAR(buybackdt)', $year);
        $this->db->where('MONTH(buybackdt)', $month);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_stock_out_penjualan($type, $year, $month)
    {
        $type_id = $this->get_type_id($type);

        $this->db->select("COUNT(id) as pcs
        , IFNULL(SUM(weight), 0) as carat
        , 0 as gram
        , IFNULL(SUM(pricenet), 0) as cogm
        , IFNULL(SUM(pricenet), 0) as net
        , IFNULL(SUM(priceusr), 0) as usernet
        ");
        $this->db->from('sales-ls');
        $this->db->where('type', $type_id);
        $this->db->where('YEAR(salesdt)', $year);
        $this->db->where('MONTH(salesdt)', $month);

        $query = $this->db->get();
        return $query->row_array();
    }
}