<?php
class Model_penjualan extends CI_Model
{
    function cekBarang()
    {
        $id_user = $this->session->userdata('id_user');
        return $this->db->get_where('penjualan_detail_temp', array('id_user' => $id_user));
    }

    function getLastFaktur($bulan, $tahun, $cabang)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $cabang = $this->session->userdata['kode_cabang'];
        $this->db->select('no_faktur');
        $this->db->from('penjualan');
        $this->db->where('kode_cabang', $cabang);
        $this->db->where('MONTH(tgltransaksi)', $bulan);
        $this->db->where('YEAR(tgltransaksi)', $tahun);
        $this->db->order_by('no_faktur', 'desc');
        $this->db->join('users', 'penjualan.id_user = users.id_user');
        $this->db->limit(1);
        return $this->db->get();
    }

    function cekBarangtemp($kode_barang, $id_user)
    {
        return $this->db->get_where('penjualan_detail_temp', array('kode_barang' => $kode_barang, 'id_user' => $id_user));
    }

    function insertBarangtemp($data)
    {
        $this->db->insert('penjualan_detail_temp', $data);
    }

    function getDatabarangtemp($id_user)
    {
        $this->db->select('penjualan_detail_temp.kode_barang,nama_barang,harga,qty,(qty * harga) as total, id_user');
        $this->db->from('penjualan_detail_temp');
        $this->db->join('barang_master', 'penjualan_detail_temp.kode_barang = barang_master.kode_barang');
        $this->db->where('id_user', $id_user);
        return $this->db->get();
    }

    function deleteBarangtemp($kode_barang, $id_user)
    {
        $hapus = $this->db->delete('penjualan_detail_temp', array('kode_barang' => $kode_barang, 'id_user'));
        if ($hapus) {
            return 1;
        }
    }

    function insertPenjualan($data)
    {

        $simpan = $this->db->insert('penjualan', $data);
        if ($simpan) {
            $detailpenjualan = $this->db->get_where('penjualan_detail_temp', array('id_user' => $data['id_user']));
            $totalpenjualan = 0;
            $berhasil = 0;
            $error = 0;
            foreach ($detailpenjualan->result() as $d) {
                $totalpenjualan = $totalpenjualan + ($d->qty * $d->harga);
                $datadetail = array(
                    'no_faktur' => $data['no_faktur'],
                    'kode_barang' => $d->kode_barang,
                    'harga' => $d->harga,
                    'qty' => $d->qty
                );
                $simpandetail = $this->db->insert('penjualan_detail', $datadetail);
                if ($simpandetail) {
                    $berhasil++;
                } else {
                    $error++;
                }
            }
            if ($error > 0) {
                $hapusdetailpenjualan = $this->db->delete('penjualan_detail', array('no_faktur' => $data['no_faktur']));
                $hapusdatapenjualan = $this->db->delete('penjualan', array('no_faktur' => $data['no_faktur']));
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
                <i class="fa fa-close mr-2"></i>
                Data Gagal Disimpan !
                </div>');
                redirect('penjualan/inputpenjualan');
            } else {
                $hapustemporary = $this->db->delete('penjualan_detail_temp', array('id_user' => $data['id_user']));
                if ($hapustemporary) {
                    if ($data['jenistransaksi'] == "tunai") {
                        $tahun = date('Y');
                        $thn = substr($tahun, 2, 2);
                        $getLastNobukti = $this->db->query("SELECT nobukti FROM historibayar WHERE YEAR(tglbayar) = '$tahun' ORDER BY nobukti DESC LIMIT 1")->row_array();
                        $nomorterakhir = $getLastNobukti['nobukti'];
                        $nobukti = buatkode($nomorterakhir, $thn, 6);
                        $databayar = array(
                            'nobukti' => $nobukti,
                            'no_faktur' => $data['no_faktur'],
                            'tglbayar' => $data['tgltransaksi'],
                            'bayar' => $totalpenjualan,
                            'id_user' => $data['id_user']
                        );
                        $bayar = $this->db->insert('historibayar', $databayar);
                        if ($bayar) {
                            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
                            <i class="fa fa-check mr-2"></i>
                            Data Berhasil Disimpan !
                            </div>');
                            redirect('penjualan/inputpenjualan');
                        } else {
                            $hapusdetailpenjualan = $this->db->delete('penjualan_detail', array('no_faktur' => $data['no_faktur']));
                            $hapusdatapenjualan = $this->db->delete('penjualan', array('no_faktur' => $data['no_faktur']));
                            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
                            <i class="fa fa-close mr-2"></i>
                            Data Gagal Disimpan !
                            </div>');
                            redirect('penjualan/inputpenjualan');
                        }
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
                        <i class="fa fa-check mr-2"></i>
                        Data Berhasil Disimpan !
                        </div>');
                        redirect('penjualan/inputpenjualan');
                    }
                } else {
                    $hapusdetailpenjualan = $this->db->delete('penjualan_detail', array('no_faktur' => $data['no_faktur']));
                    $hapusdatapenjualan = $this->db->delete('penjualan', array('no_faktur' => $data['no_faktur']));
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
                    <i class="fa fa-close mr-2"></i>
                    Data Gagal Disimpan !
                    </div>');
                    redirect('penjualan/inputpenjualan');
                }
            }
        }
    }

    function getDatapenjualan($rowno, $rowperpage, $no_faktur, $namapelanggan, $dari, $sampai)
    {
        if ($no_faktur != "") {
            $this->db->where('penjualan.no_faktur', $no_faktur);
        }
        if ($namapelanggan != "") {
            $this->db->like('nama_pelanggan', $namapelanggan);
        }
        if ($dari != "") {
            $this->db->where('tgltransaksi >', $dari);
        }
        if ($sampai != "") {
            $this->db->where('tgltransaksi <', $sampai);
        }
        $this->db->select('penjualan.no_faktur,tgltransaksi,penjualan.kode_pelanggan,nama_pelanggan,jenistransaksi,jatuhtempo,penjualan.id_user,nama_lengkap,totalpenjualan,totalbayar');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'penjualan.kode_pelanggan = pelanggan.kode_pelanggan');
        $this->db->join('users', 'penjualan.id_user = users.id_user');
        $this->db->join('view_totalpenjualan', 'penjualan.no_faktur = view_totalpenjualan.no_faktur');
        $this->db->join('view_totalbayar', 'penjualan.no_faktur = view_totalbayar.no_faktur', 'left');
        $this->db->limit($rowperpage, $rowno);
        return $this->db->get();
    }
    function getDatapenjualancount($no_faktur, $namapelanggan, $dari, $sampai)
    {
        if ($no_faktur != "") {
            $this->db->where('penjualan.no_faktur', $no_faktur);
        }
        if ($namapelanggan != "") {
            $this->db->like('nama_pelanggan', $namapelanggan);
        }
        if ($dari != "") {
            $this->db->where('tgltransaksi >', $dari);
        }
        if ($sampai != "") {
            $this->db->where('tgltransaksi <', $sampai);
        }
        $this->db->select('penjualan.no_faktur,tgltransaksi,penjualan.kode_pelanggan,nama_pelanggan,jenistransaksi,jatuhtempo,penjualan.id_user,nama_lengkap,totalpenjualan,totalbayar');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'penjualan.kode_pelanggan = pelanggan.kode_pelanggan');
        $this->db->join('users', 'penjualan.id_user = users.id_user');
        $this->db->join('view_totalpenjualan', 'penjualan.no_faktur = view_totalpenjualan.no_faktur');
        $this->db->join('view_totalbayar', 'penjualan.no_faktur = view_totalbayar.no_faktur', 'left');
        return $this->db->get();
    }
    function deletePenjualan($no_faktur)
    {
        $hapus = $this->db->delete('penjualan', array('no_faktur' => $no_faktur));
        if ($hapus) {
            $hapusdetail = $this->db->delete('penjualan_detail', array('no_faktur' => $no_faktur));
            if ($hapusdetail) {
                $hapushistorybayar = $this->db->delete('historibayar', array('no_faktur' => $no_faktur));
                if ($hapushistorybayar) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-succes" role="alert" > Data Berhasil di Hapus ! </div> ');
                    redirect('penjualan');
                }
            }
        }
    }

    function getPenjualan($no_faktur)
    {
        $this->db->select('penjualan.no_faktur,tgltransaksi,penjualan.kode_pelanggan,nama_pelanggan,alamat_pelanggan,jenistransaksi,jatuhtempo,penjualan.id_user,nama_lengkap as kasir');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'penjualan.kode_pelanggan = pelanggan.kode_pelanggan');
        $this->db->join('users', 'penjualan.id_user = users.id_user');
        $this->db->where('no_faktur', $no_faktur);
        return $this->db->get();
    }
    function getDetailpenjualan($no_faktur)
    {
        $this->db->select('penjualan_detail.kode_barang,nama_barang,penjualan_detail.harga,qty,satuan');
        $this->db->from('penjualan_detail');
        $this->db->join('barang_master', 'penjualan_detail.kode_barang= barang_master.kode_barang');
        $this->db->where('no_faktur', $no_faktur);
        return $this->db->get();
    }

    function getBayar($no_faktur)
    {
        return $this->db->get_where('historibayar', array('no_faktur' => $no_faktur));
    }

    function insertBayar()
    {
        $id_user = $this->session->userdata('id_user');
        $no_faktur = $this->input->post('no_faktur');
        $tglbayar = $this->input->post('tglbayar');
        $jmlbayar = $this->input->post('jmlbayar');
        $tahun = date('Y');
        $thn = substr($tahun, 2, 2);
        $getLastNobukti = $this->db->query("SELECT nobukti FROM historibayar WHERE YEAR(tglbayar) = '$tahun' ORDER BY nobukti DESC LIMIT 1")->row_array();
        $nomorterakhir = $getLastNobukti['nobukti'];
        $nobukti = buatkode($nomorterakhir, $thn, 6);
        $databayar = array(
            'nobukti' => $nobukti,
            'no_faktur' => $no_faktur,
            'tglbayar' => $tglbayar,
            'bayar' => $jmlbayar,
            'id_user' => $id_user
        );
        $bayar = $this->db->insert('historibayar', $databayar);
        if ($bayar) {
            $this->session->set_flashdata('msg', '<div class = "alert alert-success" role = "alert">
            Data Berhasil Disimpan !</div>');
            redirect('penjualan/detailfaktur/' . $no_faktur);
        } else {
            $this->session->set_flashdata('msg', '<div class = "alert alert-danger" role = "alert">
            Data Gagal Disimpan !</div>');
            redirect('penjualan/detailfaktur/' . $no_faktur);
        }
    }

    function deleteBayar($nobukti, $no_faktur)
    {
        $hapus = $this->db->delete('historibayar', array('nobukti' => $nobukti));
        if ($hapus) {
            $this->session->set_flashdata('msg', '<div class = "alert alert-success" role = "alert">
            Data Berhasil Dihapus !</div>');
            redirect('penjualan/detailfaktur' . $no_faktur);
        } else {
            $this->session->set_flashdata('msg', '<div class = "alert alert-danger" role = "alert">
            Data Gagal Dihapus !</div>');
            redirect('penjualan/detailfaktur/' . $no_faktur);
        }
    }

    function getlaporanpenjualan($cabang, $dari, $sampai)
    {
        if ($cabang != "") {
            $this->db->where('users.kode_cabang', $cabang);
        }

        $this->db->where('tgltransaksi >=', $dari);
        $this->db->where('tgltransaksi <=', $sampai);
        $this->db->select('penjualan.no_faktur,tgltransaksi,penjualan.kode_pelanggan,nama_pelanggan,jenistransaksi,jatuhtempo,penjualan.id_user,nama_lengkap,totalpenjualan,totalbayar');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'penjualan.kode_pelanggan = pelanggan.kode_pelanggan');
        $this->db->join('users', 'penjualan.id_user = users.id_user');
        $this->db->join('view_totalpenjualan', 'penjualan.no_faktur = view_totalpenjualan.no_faktur');
        $this->db->join('view_totalbayar', 'penjualan.no_faktur = view_totalbayar.no_faktur', 'left');
        return $this->db->get();
    }

    function getDataPenjualanhariini(){
        $hariini = date("Y-m-d");
        if($this->session->userdata('kode_cabang') != 'PST')(
            $this->db->where('users.kode_cabang', $this->session->userdata('kode_cabang'))
        );
        $this->db->join('users', 'penjualan.id_user = users.id_user');
        return $this->db->get_where('penjualan', array('tgltransaksi' => $hariini));
    }

    function getBayarhariini(){
        $hariini = date("Y-m-d");
        if($this->session->userdata('kode_cabang') != 'PST')(
            $this->db->where('users.kode_cabang', $this->session->userdata('kode_cabang'))
        );
        $this->db->select("SUM(bayar) as totalbayar");
        $this->db->from('historibayar');
        $this->db->join('penjualan', 'historibayar.no_faktur = penjualan.no_faktur');
        $this->db->join('users', 'penjualan.id_user = users.id_user');
        $this->db->where('tglbayar', $hariini);
        return $this->db->get();
    }

    function getPenjualanperbulan(){
        $tahun = date("Y");
        $query = "SELECT id, namabulan, totalpenjualan FROM `bulan`
        LEFT JOIN (
            SELECT
            MONTH(tgltransaksi) as bulan, SUM(harga*qty) as totalpenjualan
            FROM penjualan_detail
            INNER JOIN penjualan on penjualan_detail.no_faktur = penjualan.no_faktur
            WHERE YEAR(tgltransaksi) = '$tahun'
            GROUP BY MONTH(tgltransaksi)
            ) pnj ON (bulan.id = pnj.bulan)";
        
            return $this->db->query($query);
    }
}
