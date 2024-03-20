<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('productls_model');
		$this->load->model('productdj_model');
		$this->load->helper('ddebug_helper');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$year = 2023;
		$month = 7;

		$productls = [
			'LS Generic',
			'LS Dossier',
			'LS Branded',
			'LS Gemstone',
		];
		$productdj = [
			'DJ Produksi',
			'DJ + GS Produksi',
			'DD Produksi',
			'DJ + BD Produksi',
			'DJ Beli',
			'DJ + GS Beli',
			'DD Beli',
			'DJ + BD Beli',
		];



		foreach ($productls as $key => $type) {
			$stock_awal = $this->productls_model->get_stock_awal($type, $year, $month);
			$stock_in_beli = $this->productls_model->get_stock_in_beli($type, $year, $month);
			$stock_in_buyback = $this->productls_model->get_stock_in_buyback($type, $year, $month);
			$stock_out_penjualan = $this->productls_model->get_stock_out_penjualan($type, $year, $month);
			$stock_akhir = [
				'pcs' => ($stock_awal['pcs'] + $stock_in_beli['pcs']
					+ $stock_in_buyback['pcs']) - $stock_out_penjualan['pcs'],
				'carat' => ($stock_awal['carat'] + $stock_in_beli['carat']
					+ $stock_in_buyback['carat']) - $stock_out_penjualan['carat'],
				'gram' => ($stock_awal['gram'] + $stock_in_beli['gram']
					+ $stock_in_buyback['gram']) - $stock_out_penjualan['gram'],
				'cogm' => ($stock_awal['cogm'] + $stock_in_beli['cogm']
					+ $stock_in_buyback['cogm']) - $stock_out_penjualan['cogm'],
				'net' => ($stock_awal['net'] + $stock_in_beli['net']
					+ $stock_in_buyback['net']) - $stock_out_penjualan['net'],
				'usernet' => ($stock_awal['usernet'] + $stock_in_beli['usernet']
					+ $stock_in_buyback['usernet']) - $stock_out_penjualan['usernet'],
			];

			$productls_result[$type] = [
				'stock_awal' => $stock_awal,
				'stock_in_beli' => $stock_in_beli,
				'stock_in_buyback' => $stock_in_buyback,
				'stock_out_penjualan' => $stock_out_penjualan,
				'stock_akhir' => $stock_akhir,
			];
		}

		foreach ($productdj as $key => $type) {
			$stock_awal = $this->productdj_model->get_stock_awal($type, $year, $month);
			$stock_in_beli = $this->productdj_model->get_stock_in_beli($type, $year, $month);
			$stock_in_buyback = $this->productdj_model->get_stock_in_buyback($type, $year, $month);
			$stock_out_penjualan = $this->productdj_model->get_stock_out_penjualan($type, $year, $month);
			$stock_akhir = [
				'pcs' => ($stock_awal['pcs'] + $stock_in_beli['pcs']
					+ $stock_in_buyback['pcs']) - $stock_out_penjualan['pcs'],
				'carat' => ($stock_awal['carat'] + $stock_in_beli['carat']
					+ $stock_in_buyback['carat']) - $stock_out_penjualan['carat'],
				'gram' => ($stock_awal['gram'] + $stock_in_beli['gram']
					+ $stock_in_buyback['gram']) - $stock_out_penjualan['gram'],
				'cogm' => ($stock_awal['cogm'] + $stock_in_beli['cogm']
					+ $stock_in_buyback['cogm']) - $stock_out_penjualan['cogm'],
				'net' => ($stock_awal['net'] + $stock_in_beli['net']
					+ $stock_in_buyback['net']) - $stock_out_penjualan['net'],
				'usernet' => ($stock_awal['usernet'] + $stock_in_beli['usernet']
					+ $stock_in_buyback['usernet']) - $stock_out_penjualan['usernet'],
			];

			$productdj_result[$type] = [
				'stock_awal' => $stock_awal,
				'stock_in_beli' => $stock_in_beli,
				'stock_in_buyback' => $stock_in_buyback,
				'stock_out_penjualan' => $stock_out_penjualan,
				'stock_akhir' => $stock_akhir,
			];
		}

		$body = array_merge($productls_result, $productdj_result);
		$total = $this->count_total($body);
		$data['result'] = array_merge($body, $total);

		$this->load->view('home', $data);
	}

	public function count_total($data)
	{
		$total = [
			'stock_awal' => [
				'pcs' => 0,
				'carat' => 0,
				'gram' => 0,
				'cogm' => 0,
				'net' => 0,
				'usernet' => 0,
			],
			'stock_in_beli' => [
				'pcs' => 0,
				'carat' => 0,
				'gram' => 0,
				'cogm' => 0,
				'net' => 0,
				'usernet' => 0,
			],
			'stock_in_buyback' => [
				'pcs' => 0,
				'carat' => 0,
				'gram' => 0,
				'cogm' => 0,
				'net' => 0,
				'usernet' => 0,
			],
			'stock_out_penjualan' => [
				'pcs' => 0,
				'carat' => 0,
				'gram' => 0,
				'cogm' => 0,
				'net' => 0,
				'usernet' => 0,
			],
			'stock_akhir' => [
				'pcs' => 0,
				'carat' => 0,
				'gram' => 0,
				'cogm' => 0,
				'net' => 0,
				'usernet' => 0,
			],
		];


		foreach ($data as $item) {
			foreach ($item as $key => $value) {
				$total[$key]['pcs'] = $total[$key]['pcs'] + $value['pcs'];
				$total[$key]['carat'] = $total[$key]['carat'] + $value['carat'];
				$total[$key]['gram'] = $total[$key]['gram'] + $value['gram'];
				$total[$key]['cogm'] = $total[$key]['cogm'] + $value['cogm'];
				$total[$key]['net'] = $total[$key]['net'] + $value['net'];
				$total[$key]['usernet'] = $total[$key]['usernet'] + $value['net'];
			}
		}

		return ['TOTAL' => $total];
	}
}