<form action="<?php echo base_url(); ?>user/updateuser" class="formuser" method="POST">
    <?php if ($user['id_user'] == $this->session->userdata['id_user']) { ?>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="iduser" value="<?php echo $user['id_user']?>" readonly>
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="namalengkap" value="<?php echo $user['nama_lengkap']?>">
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="nohp" value="<?php echo $user['no_hp']?>">
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="username" value="<?php echo $user['username']?>">
    </div>
    <div class="mb-3 form-group">
        <input type="password" class="form-control" name="password" value="<?php echo $user['password']?>">
    </div>
    <div class="mb-3 form-group">
        <?php if ($this->session->userdata['level'] == "administrator") { ?>
        <select class="form-control" name="level">
            <option value="administrator">Administrator</option>
            <option value="manager">Manager</option>
            <option value="kepala cabang">Kepala Cabang</option>
            <option value="staff">Staff</option>
        </select>
        <?php }else if ($this->session->userdata['level'] == "staff") { ?>
        <select class="form-control" name="level">
            <option value="staff">Staff</option>
            <option value="administrator">Administrator</option>
            <option value="manager">Manager</option>
            <option value="kepala cabang">Kepala Cabang</option>
        </select>
        <?php }else if ($this->session->userdata['level'] == "boss") { ?>
        <select class="form-control" name="level">
            <option value="manager">Manager</option>
            <option value="kepala cabang">Kepala Cabang</option>
            <option value="staff">Staff</option>
            <option value="administrator">Administrator</option>
        </select>
        <?php } ?>
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="kodecabang" value="<?php echo $user['kode_cabang']?>">
    </div>
    <div class="mb-3 text-right">
        <button type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
            Simpan
        </button>
    </div>
    <?php }else{?>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="iduser" value="<?php echo $user['id_user']?>" readonly>
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="namalengkap" value="<?php echo $user['nama_lengkap']?>" readonly>
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="nohp" value="<?php echo $user['no_hp']?>" readonly>
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="username" value="<?php echo $user['username']?>" readonly>
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="password" value="Password dirahasiakan" readonly>
    </div>
    <div class="mb-3 form-group">
        <select class="form-control" name="level" placeholder="Level"  readonly>
            <option value=""><?php echo $user['level']?></option>
            <option value="administrator">Administrator</option>
            <option value="manager">Manager</option>
            <option value="kepala cabang">Kepala Cabang</option>
            <option value="staff">Staff</option>
        </select>
    </div>
    <div class="mb-3 form-group">
        <input type="text" class="form-control" name="kodecabang" value="<?php echo $user['kode_cabang']?>" readonly>
    </div>
    <?php } ?>
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