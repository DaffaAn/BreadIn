<form action="<?php echo base_url() ?>barang/simpanbarang" class="formbarang" method="POST">
    <div class="form-group mb-3">
        <label class="form-label">Kode Barang</label>
        <input type="text" class="form-control" name="kodebarang" placeholder="Kode Barang">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" class="form-control" name="namabarang" placeholder="Nama Barang">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Satuan</label>
        <select name="satuan" class="form-select">
            <option value="">--Satuan--</option>
            <option value="pcs">Pcs</option>
            <option value="unit">Unit</option>
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
    $('.formbarang').bootstrapValidator({
        fields: {
            kodebarang: {
                message: 'Kode Barang Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Kode Barang Harus Diisi !'
                    }
                }

            },
            namabarang: {
                message: 'Nama Barang Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Nama Barang Harus Diisi !'
                    }
                }
            },
            satuan: {
                message: 'Satuan Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Satuan Harus Diisi !'
                    }
                }
            },
        }

    });
</script>