<h2 class="page-title">
    Data Penjualan
</h2>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="<?php echo base_url(); ?>penjualan/inputpenjualan" class="btn btn-success mb-3" style="background-color: #C0EDA6; color: #534340">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <line x1="12" y1="11" x2="12" y2="17" />
                        <line x1="9" y1="14" x2="15" y2="14" />
                    </svg>
                    Tambah Pelanggan
                </a>

                <div class="mb-3"><?php echo $this->session->flashdata('msg'); ?></div>
                <table class="table table-striped table-bordered">
                    <thead style="background-color: #232e3c">
                        <tr>
                            <th style="color: #ffffff">NO</th>
                            <th style="color: #ffffff">NO FAKTUR</th>
                            <th style="color: #ffffff">TANGGAL</th>
                            <th style="color: #ffffff">KODE PELANGGAN</th>
                            <th style="color: #ffffff">NAMA PELANGGAN</th>
                            <th style="color: #ffffff">JENIS TRANSAKSI</th>
                            <th style="color: #ffffff">JATUH TEMPO</th>
                            <th style="color: #ffffff">TOTAL PENJUALAN</th>
                            <th style="color: #ffffff">TOTAL BAYAR</th>
                            <th style="color: #ffffff">SISA BAYAR</th>
                            <th style="color: #ffffff">KET</th>
                            <th style="color: #ffffff">KASIR</th>
                            <th style="color: #ffffff">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = $row + 1;
                        $this->db->get('penjualan');
                        foreach ($penjualan as $p) {
                            $sisabayar = $p->totalpenjualan - $p->totalbayar;
                            if ($sisabayar > 0) {
                                $ket = "Belum Lunas";
                                $warna = "bg-red";
                            } else {
                                $ket = "Lunas";
                                $warna = "bg-green";
                            }
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td> <a href="<?php echo base_url() ?>penjualan/detailfaktur/<?php echo $p->no_faktur; ?>"><?php echo $p->no_faktur; ?></a></td>
                                <td><?php echo $p->tgltransaksi; ?></td>
                                <td><?php echo $p->kode_pelanggan; ?></td>
                                <td><?php echo $p->nama_pelanggan; ?></td>
                                <td><?php echo $p->jenistransaksi; ?></td>
                                <td><?php echo $p->jatuhtempo; ?></td>
                                <td align="right"><?php echo number_format($p->totalpenjualan, '0', '', '.'); ?></td>
                                <td align="right"><?php echo number_format($p->totalbayar, '0', '', '.'); ?></td>
                                <td align="right"><?php echo number_format($p->totalpenjualan - $p->totalbayar, '0', '', '.'); ?></td>
                                <td align="center"> <span class="badge <?php echo $warna; ?>"> <?php echo $ket; ?></span></td>
                                <td><?php echo $p->nama_lengkap; ?></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger hapus" data-href="<?php echo base_url(); ?>penjualan/hapuspenjualan/<?php echo $p->no_faktur; ?>"><i class="fa fa-trash-o"></i></a>
                                    <a href="<?php echo base_url() ?>penjualan/cetakpenjualan/<?php echo $p->no_faktur; ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>
                                    <?php if ($sisabayar != 0) { ?>
                                        <a href="<?php echo base_url() ?>penjualan/detailfaktur/<?php echo $p->no_faktur; ?>" class="btn btn-sm btn-success">Bayar</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
                <div>
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modalhapuspenjualan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Anda yakin hapus data ini?</div>
                <div>Jika Dihapus Maka Anda Akan Kehilangan Data Ini</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Cancel</button>
                <a href="#" id="hapuspenjualan" class="btn btn-danger">Yes, delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(document.getElementById('dari'), {});
        flatpickr(document.getElementById('sampai'), {});
    });
</script>

<script>
    $(function() {
        $(".hapus").click(function() {
            var href = $(this).attr("data-href");
            $("#modalhapuspenjualan").modal("show");
            $("#hapuspenjualan").attr("href", href)
        });
    });
</script>