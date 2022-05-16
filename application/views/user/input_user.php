<form action="<?php echo base_url(); ?>user/simpanuser" class="formuser" method="POST">
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="iduser" placeholder="ID user">
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="namalengkap" placeholder="Nama Lengkap">
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="nohp" placeholder="Nomor Handphone">
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="username" placeholder="Username">
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="password" placeholder="Password">
    </div>
    <div class="mb-3 form-group">
        <select class="form-control" name="level" placeholder="Level">
            <option value="">-- Pilih Level --</option>
            <option value="administrator">Administrator</option>
            <option value="manager">Manager</option>
            <option value="kepala cabang">Kepala Cabang</option>
            <option value="kasir">Kasir</option>
        </select>
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="kodecabang" placeholder="Kode Cabang">
    </div>
    <div class="mb-3 text-right">
        <button type="submit" class="btn btn-azure">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
            Daftarkan
        </button>
    </div>
</form>

<script>
    $(function(){
        $('.formuser').bootstrapValidator({
            fields: {
                iduser: {
                    message: 'ID user harus diisi!',
                    validators: {
                        notEmpty: {
                            message: 'ID user harus diisi!'
                        }
                    }
                },
                namalengkap: {
                    message: 'Nama lengkap harus diisi!',
                    validators: {
                        notEmpty: {
                            message: 'Nama lengkap harus diisi!'
                        }
                    }
                },
                nohp: {
                    message: 'Nomor HP harus diisi!',
                    validators: {
                        notEmpty: {
                            message: 'Nomor HP harus diisi!'
                        }
                    }
                },
                username: {
                    message: 'Username harus diisi!',
                    validators: {
                        notEmpty: {
                            message: 'Username harus diisi!'
                        }
                    }
                },
            }
        });
    });
</script>