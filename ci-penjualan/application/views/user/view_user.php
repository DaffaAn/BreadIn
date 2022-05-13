<h2 class="page-title">
    Daftar User
</h2>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="#" class="btn btn-success mb-3" style="background-color: #C0EDA6; color: #534340" id="tambahuser">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="12" y1="11" x2="12" y2="17" /><line x1="9" y1="14" x2="15" y2="14" /></svg>
                    Tambah User</a>
                <div class="md-3"><?php echo $this->session->flashdata('msg');?></div>
                <table class="table table-striped table-bordered" id="tabeluser">
                    <thead style="background-color: #153149">
                        <tr>
                            <th style="color: white">No.</th>
                            <th style="color: white">ID User</th>
                            <th style="color: white">Nama Lengkap</th>
                            <th style="color: white">No. Handphone</th>
                            <th style="color: white">Username</th>
                            <th style="color: white">Level</th>
                            <th style="color: white">Kode Cabang</th>
                            <th style="color: white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach($user as $u){
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $u->id_user; ?></td>
                                <td><?php echo $u->nama_lengkap; ?></td>
                                <td><?php echo $u->no_hp; ?></td>
                                <td><?php echo $u->username; ?></td>
                                <td><?php echo $u->level; ?></td>
                                <td><?php echo $u->kode_cabang; ?></td>
                                <td>
                                    <a href="#" data-iduser="<?php echo base_url(); ?>user/edituser/<?php echo $u->id_user; ?>" class="btn btn-sm btn-success edit" style="background-color: #C0EDA6; color: #534340">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                        Edit
                                    </a>
                                    <a href="#" data-href="<?php echo base_url(); ?>user/hapususer/<?php echo $u->id_user; ?>" class="btn btn-sm btn-danger hapus" style="background-color: #B91646">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php
                        $no++; 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modaluser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftarkan User Baru</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadforminputuser"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modaledituser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadformedituser"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modalhapususer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Apakah anda ingin menghapus data user ini?</div>
                <div>Data tidak bisa dikembalikan setelah dihapus.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Batal</button>
                <a href="#" id="hapususer" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("#tambahuser").click(function(){
            $("#modaluser").modal("show");
            $("#loadforminputuser").load("<?php echo base_url(); ?>user/inputuser");
        });
        $(".edit").click(function(){
            var iduser = $(this).attr('data-iduser');
            $("#modaledituser").modal("show");
            $("#loadformedituser").load("<?php echo base_url(); ?>user/edituser/"+iduser);
        });
        $(".hapus").click(function(){
            var href = $(this).attr('data-href');
            $("#modalhapususer").modal("show");
            $('#hapususer').attr('href', href);
        });
        $('#tabeluser').DataTable();
    });
</script>