<form action="<?php echo base_url() ?>cabang/simpancabang" class="formCabang" method="POST">
    <div class="form-group mb-3">
        <label class="form-label">Kode Cabang</label>
        <input type="text" class="form-control" name="kodecabang" placeholder="Kode Cabang">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Nama Cabang</label>
        <input type="text" class="form-control" name="namacabang" placeholder="Nama Cabang">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Alamat Cabang</label>
        <input type="text" class="form-control" name="alamatcabang" placeholder="Alamat Cabang">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Telepon</label>
        <input type="text" class="form-control" name="telepon" placeholder="Telepon">
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
    $('.formCabang').bootstrapValidator({
        fields: {
            kodecabang: {
                message: 'Kode Cabang Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Kode Cabang Harus Diisi !'
                    }
                }

            },
            namacabang: {
                message: 'Nama Cabang Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Nama Cabang Harus Diisi !'
                    }
                }
            },
            alamatcabang: {
                message: 'Alamat Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Alamat Harus Diisi !'
                    }
                }
            },
            telepon: {
                message: 'Telepon Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Telepon Harus Diisi !'
                    }
                }
            },
        }

    });
</script>