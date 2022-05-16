<form action="<?php echo base_url() ?>barang/updateharga" class="formHarga" method="POST">
    <div class="form-group mb-3">
        <label class="form-label">Kode Harga</label>
        <input type="text" value="<?php echo $harga['kode_harga']; ?>" readonly class="form-control" name="kodeharga" id="kodeharga" placeholder="Kode Harga">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Jenis Barang</label>
        <select disabled name="kodebarang" id="kodebarang" class="form-select">
            <option value="">Pilih Barang</option>
            <?php foreach($barang as $b) { ?>
                <option <?php if($harga['kode_barang']==$b->kode_barang){ echo "selected";} ?> value="<?php echo $b->kode_barang; ?>"><?php echo $b->kode_barang . " - " . $b->nama_barang; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Harga</label>
        <input type="text" value="<?php echo $harga['harga']; ?>" id="harga" class="form-control" name="harga" placeholder="Harga">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Stok</label>
        <input type="text" value="<?php echo $harga['stok']; ?>" class="form-control" name="stok" id="stok" placeholder="Stok">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Cabang</label>
        <select disabled name="cabang" id="cabang" class="form-select">
            <option value="">Pilih Cabang</option>
            <?php foreach($cabang as $c) { ?>
                <option <?php if($harga['kode_cabang']==$c->kode_cabang){ echo "selected";} ?> value="<?php echo $c->kode_cabang; ?>"><?php echo $c->nama_cabang; ?></option>
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
            Update
        </button>
    </div>
</form>

<script>
    $(function() {
        $('.formHarga').bootstrapValidator({
        fields: {
            namabarang: {
                message: 'Barang Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Barang Harus Diisi !'
                    }
                }
            },
            harga: {
                message: 'Harga Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Harga Harus Diisi !'
                    }
                }
            },
            stok: {
                message: 'Stok Tidak Valid !',
                validators: {
                    notEmpty: {
                        message: 'Stok Harus Diisi !'
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
    function loadkodeharga(){
            var kodebarang = $("#kodebarang").val();
            var kodecabang = $("#cabang").val();
            var kodeharga = kodebarang + kodecabang;
            $("#kodeharga").val(kodeharga);
        }

        $("#kodebarang").change(function() {
            loadkodeharga();
        });

        $("#cabang").change(function() {
            loadkodeharga();
        });
    });
</script>