<h2 class="page-title">
    Data Harga
</h2>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->userdata('level') == "administrator") { ?>
                    <a href="#" class="btn btn-success mb-3" style="background-color: #C0EDA6; color: #534340" id="tambahharga">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <line x1="12" y1="11" x2="12" y2="17" />
                            <line x1="9" y1="14" x2="15" y2="14" />
                        </svg>
                        Tambah Data Harga
                    </a>
                <?php } ?>
                <div class="mb-3"><?php echo $this->session->flashdata('msg'); ?></div>
                <table class="table table-striped table-bordered" id="tabelharga">
                    <thead style="background-color: #232e3c">
                        <tr>
                            <th style="color: #ffffff">NO</th>
                            <th style="color: #ffffff">KODE HARGA</th>
                            <th style="color: #ffffff">KODE BARANG</th>
                            <th style="color: #ffffff">NAMA BARANG</th>
                            <th style="color: #ffffff">SATUAN</th>
                            <th style="color: #ffffff">HARGA</th>
                            <th style="color: #ffffff">STOK</th>
                            <th style="color: #ffffff">CABANG</th>
                            <?php if ($this->session->userdata('level') == "administrator") { ?>
                                <th style="color: #ffffff">AKSI</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($harga as $h) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $h->kode_harga; ?></td>
                                <td><?php echo $h->kode_barang; ?></td>
                                <td><?php echo $h->nama_barang; ?></td>
                                <td><?php echo $h->satuan; ?></td>
                                <td style="align: right"><?php echo number_format($h->harga, '0', '', '.'); ?></td>
                                <td><?php echo $h->stok; ?></td>
                                <td><?php echo $h->kode_cabang; ?></td>
                                <?php if ($this->session->userdata('level') == "administrator") { ?>
                                    <td>
                                        <a href="#" data-kodeharga="<?php echo $h->kode_harga; ?>" class="btn btn-sm btn-primary edit" style="background-color: #C0EDA6; color: #534340">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                            </svg>
                                            Edit
                                        </a>
                                        <a href="#" data-href="<?php echo base_url(); ?>barang/hapusharga/<?php echo $h->kode_harga; ?>" class="btn btn-sm btn-danger hapus" style="background-color: #B91646">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                            Hapus
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php
                            $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modalharga" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Harga</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadforminputharga"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modaleditharga" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Harga</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadformeditharga"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modalhapusharga" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Anda yakin hapus data ini?</div>
                <div>Jika Dihapus Maka Anda Akan Kehilangan Data Ini</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Cancel</button>
                <a href="#" id="hapusharga" class="btn btn-danger">Yes, delete</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tambahharga").click(function() {
            $("#modalharga").modal("show");
            $("#loadforminputharga").load("<?php echo base_url(); ?>barang/inputharga");
        });

        $(".edit").click(function() {
            var kodeharga = $(this).attr("data-kodeharga");
            $("#modaleditharga").modal("show");
            $("#loadformeditharga").load("<?php echo base_url(); ?>barang/editharga/" + kodeharga);
        });

        $(".hapus").click(function() {
            var href = $(this).attr("data-href");
            $("#modalhapusharga").modal("show");
            $("#hapusharga").attr("href", href)
        });
        $('#tabelharga').DataTable();
    });
</script>