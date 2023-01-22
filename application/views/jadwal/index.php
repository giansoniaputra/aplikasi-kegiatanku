<div class="flash-data" data-flashdata="<?= $this->session->flashdata("Pesan"); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata("Pesan_Error"); ?>"></div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $this->load->view('jadwal/modal_generate'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" id="" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <?php
    $this->Jadwal_m->cek_jadwal($email);
    $cek = $this->db->affected_rows() > 0;
    ?>
    <div class="row ml-2 mb-3">
        <?php if ($cek) : ?>
            <button type="button" id="data_ada" class="btn btn-warning btn-icon-split mb-2 mr-2">
            <?php else : ?>
                <a href="<?= base_url('jadwal/generate?user=') . $email ?>" class="btn btn-warning btn-icon-split mb-2 mr-2">
                <?php endif; ?>
                <span class="icon text-white-50">
                    <i class="fas fa-flag"></i>
                </span>
                <span class="text">Generate Kegiatan</span>
                </a>
                <button type="button" class="btn btn-warning btn-icon-split mb-2" data-toggle="modal" data-target="#exampleModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">Tambah Kegiatan</span>
                </button>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Kegiatan Yang Belum Terlaksana</h6>
                </div>
                <div class="card-body">
                    <?php $query = $this->Jadwal_m->tampil_kegiatan($email); ?>
                    <?php $i = 1; ?>
                    <?php foreach ($query as $row) : ?>
                        <div class="input-group mb-2 mr-sm-2">
                            <?php if ($row->tingkat == 1) : ?>
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-success"><input type="checkbox" class=" border-0 bg-transparent p-0" id="check<?= $i; ?>"></div>
                                </div>
                                <input type="hidden" value="<?= $row->id; ?>" id="id<?= $i++; ?>">
                                <input type="text" class="form-control bg-success text-white" id="inlineFormInputGroupUsername2" value="<?= $row->nama_kegiatan; ?>" placeholder="Username" disabled>
                            <?php elseif ($row->tingkat == 2) : ?>
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-primary"><input type="checkbox" class=" border-0 bg-transparent p-0" id="check<?= $i; ?>"></div>
                                </div>
                                <input type="hidden" value="<?= $row->id; ?>" id="id<?= $i++; ?>">
                                <input type="text" class="form-control bg-primary text-white" id="inlineFormInputGroupUsername2" value="<?= $row->nama_kegiatan; ?>" placeholder="Username" disabled>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Kegiatan Yang Telah Terlaksana</h6>
                </div>
                <div class="card-body">
                    <?php $query2 = $this->Jadwal_m->tampil_kegiatan_selesai($email); ?>
                    <?php $a = 1; ?>
                    <?php foreach ($query2 as $row) : ?>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><input type="checkbox" class=" border-0 bg-transparent p-0" id="check-out<?= $a; ?>" checked></div>
                            </div>
                            <input type="hidden" value="<?= $row->id; ?>" id="id2<?= $a++; ?>">
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername2" value="<?= $row->nama_kegiatan; ?>" placeholder="Username" disabled>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-md-6 mb-4">
        <div class="card border-left-primary bg-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h6 mb-0 font-weight-bold text-white">* Jika kegiatan berwarna hijau maka kegiatan itu di utamakan</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-info-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/') ?>js/alert.js"></script>
<script src="<?= base_url('assets/') ?>js/alert-error.js"></script>
<?php $j = 1; ?>
<?php foreach ($query as $row) : ?>
    <script>
        $(document).ready(function() {
            $("#check<?= $j; ?>").on("change", function() {
                let id = $("#id<?= $j++; ?>").val();
                $.ajax({
                    url: "<?= base_url('jadwal/update'); ?>",
                    data: {
                        id: id
                    },
                    type: "POST",
                    success: function(data) {
                        document.location.href = '<?= base_url('jadwal/'); ?>'
                    }
                });
            });
        });
    </script>
<?php endforeach; ?>

<?php $k = 1; ?>
<?php foreach ($query2 as $row) : ?>
    <script>
        $(document).ready(function() {
            $("#check-out<?= $k; ?>").on("change", function() {
                let id = $("#id2<?= $k++; ?>").val();
                $.ajax({
                    url: "<?= base_url('jadwal/back_update'); ?>",
                    data: {
                        id: id
                    },
                    type: "POST",
                    success: function(data) {
                        document.location.href = '<?= base_url('jadwal/'); ?>'
                    }
                });
            });
        });
    </script>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        $("#data_ada").on("click", function() {
            Swal.fire({
                icon: 'error',
                title: 'Warning!',
                text: 'Data Sudah Pernah Di Generate'
            })
        })
    })
</script>