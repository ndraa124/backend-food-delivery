<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin\PemesananModel;

class Pemesanan extends BaseController
{
    protected $halaman;
    protected $title;
    protected $pemesanan;

    public function __construct()
    {
        $this->halaman = 'pemesanan';
        $this->title = 'Pemesanan';

        $this->pemesanan = new PemesananModel();
    }

    public function index()
    {
        $data = [
            'halaman'   => $this->halaman,
            'title'     => $this->title,
            'main'      => 'pemesanan/index'
        ];

        return view('layout/template', $data);
    }

    public function ajaxList()
    {
        $draw   = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start  = $_REQUEST['start'];
        $search = $_REQUEST['search']['value'];

        $total = $this->pemesanan->ajaxGetTotal();
        $output = [
            'length'          => $length,
            'draw'            => $draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $total
        ];

        if ($search !== '') {
            $list = $this->pemesanan->ajaxGetDataSearch($search, $length, $start);
        } else {
            $list = $this->pemesanan->ajaxGetData($length, $start);
        }

        if ($search !== '') {
            $total_search = $this->pemesanan->ajaxGetTotalSearch($search);
            $output = [
                'recordsTotal'    => $total_search,
                'recordsFiltered' => $total_search
            ];
        }

        $data = [];
        $no = $start + 1;
        foreach ($list as $temp) {
            if ($temp['status'] == '0' || $temp['status'] == '4') {
                $aksi = '
                    <div class="text-center">                
                        <a href="' . site_url('pemesanan/detailPemesanan/' . $temp['kd_pemesanan']) . '" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Detail Pemesanan">
                            <i class="fa fa-eye"></i>
                        </a>
                    </div>
                ';
            } else {
                $aksi = '
                    <div class="text-center">
                        <a href="' . site_url('pemesanan/detailPemesanan/' . $temp['kd_pemesanan']) . '" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Detail Pemesanan">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit Data" onclick="ajaxEdit(' . $temp['id'] . ')">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </div>
                ';
            }

            $row = [];
            $row[] = $no++;
            $row[] = 'FD-' . $temp['kd_pemesanan'];
            $row[] = formatTgl($temp['tgl_pesan'], 1);
            $row[] = formatRupiah($temp['total_bayar'], 1);
            $row[] = $temp['nama'];
            $row[] = formatStatusPesan($temp['status']);
            $row[] = $aksi;

            $data[] = $row;
        }

        $output['data'] = $data;

        echo json_encode($output);
        exit();
    }

    public function detailPemesanan($kd_pemesanan)
    {
        $data = [
            'halaman'   => $this->halaman,
            'title'     => $this->title,
            'main'      => 'pemesanan/detail',
            'pesanan'   => $this->pemesanan->getDetailPesanan($kd_pemesanan),
        ];

        return view('layout/template', $data);
    }

    public function ajaxSave()
    {
        $data = [
            'kd_pemesanan' => $this->request->getVar('kd_pemesanan'),
            'status'       => $this->request->getVar('status'),
            'noteCancel'   => $this->request->getVar('noteCancel'),
        ];

        if ($this->pemesanan->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function ajaxEdit($kd_pemesanan)
    {
        $pemesanan = $this->pemesanan->find($kd_pemesanan);
        echo json_encode($pemesanan);
    }
}
