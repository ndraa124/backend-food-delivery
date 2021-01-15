<?php

namespace App\Controllers;

use App\Models\Admin\KategoriModel;
use App\Models\Admin\ProdukModel;
use App\Models\Admin\PelangganModel;
use App\Models\Admin\PemesananModel;

class Dashboard extends BaseController
{
	protected $title;
	protected $halaman;
	protected $kategori;
	protected $produk;
	protected $pemesanan;
	protected $pelanggan;

	public function __construct()
	{
		$this->title = 'Dashboard';
		$this->halaman = 'dashboard';

		$this->kategori = new KategoriModel();
		$this->produk = new ProdukModel();
		$this->pemesanan = new PemesananModel();
		$this->pelanggan = new PelangganModel();
	}

	public function index()
	{
		$data = [
			'title' 	=> $this->title,
			'halaman' 	=> $this->halaman,
			'main' 		=> 'dashboard/index',
			'kategori' 	=> $this->kategori->ajaxGetTotal(),
			'produk' 	=> $this->produk->ajaxGetTotal(),
			'pemesanan' => $this->pemesanan->ajaxGetTotal(),
			'pelanggan' => $this->pelanggan->ajaxGetTotal(),
		];

		return view('layout/template', $data);
	}
}
