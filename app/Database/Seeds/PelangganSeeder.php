<?php

namespace App\Database\Seeds;

class PelangganSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $options = [
            'cost' => 10,
        ];

        $data = [
            'nama'       => 'ID Programming',
            'no_telp'    => '081234567890',
            'email'      => 'idprogramming@gmail.com',
            'password'   => password_hash('123456', PASSWORD_DEFAULT, $options),
            'status'     => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $this->db->table('pelanggan')->insert($data);
    }
}
