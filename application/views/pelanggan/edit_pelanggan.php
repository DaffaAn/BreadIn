<form action="<?php echo base_url() ?>pelanggan/updatepelanggan" class="formpelanggan" method="POST">
    <div class="form-group mb-3">
        <label class="form-label">Kode Pelanggan</label>
        <input type="text" readonly value="<?php echo $pelanggan['kode_pelanggan']; ?>" readyonly class=" form-control" name="kodepelanggan" placeholder="Kode Pelanggan">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Nama Pelanggan</label>
        <input type="text" value="<?php echo $pelanggan['nama_pelanggan']; ?>" class="form-control" name="namapelanggan" placeholder="Nama Pelanggan">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Alamat Pelanggan</label>
        <input type="text" value="<?php echo $pelanggan['alamat_pelanggan']; ?>" class="form-control" name="alamatpelanggan" placeholder="Alamat Pelanggan">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Nomor Handphone</label>
        <input type="text" value="<?php echo $pelanggan['no_hp']; ?>" class="form-control" name="nohp" placeholder="No HP">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Cabang</label>
        <select name="cabang" class="form-select">
            <option value="">Pilih Cabang</option>
            <?php foreach ($cabang as $c) { ?>
                <option <?php if ($pelanggan['kode_cabang'] == $c->kode_cabang) {
                            echo "selected";
                        }  ?> value="<?php echo $c->kode_cabang; ?>"><?php echo $c->nama_cabang; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <line x1="10" y1="14" x2="21" y2="3" />
                <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
            </svg>
            Simpan
        </button>
    </div>
</form>

<script>
    $('.formpelanggan').bootstrapValidator({
        fields: {
            kodepelanggan: {
                message: 'Kode Pelanggan Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Kode Pelanggan Harus Diisi !'
                    }
                }

            },
            namapelanggan: {
                message: 'Nama Pelanggan Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Nama Pelanggan Harus Diisi !'
                    }
                }
            },
            alamatpelanggan: {
                message: 'Alamat Pelanggan Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Alamat Pelanggan Harus Diisi !'
                    }
                }
            },
            nohp: {
                message: 'No HP Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'No HP Harus Diisi !'
                    }
                }
            },
            cabang: {
                message: 'Cabang Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Cabang Harus Diisi !'
                    }
                }
            },

        }

    });
</script>