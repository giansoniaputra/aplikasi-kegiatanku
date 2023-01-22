<div class="flash-data" data-flashdata="<?= $this->session->flashdata("Pesan"); ?>"></div>
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
                <?php $this->load->view('generate/modal_generate'); ?>
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
    <!-- Page Heading -->
    <div class="row ml-2 mb-3">
        <button type="button" class="btn btn-warning btn-icon-split mr-2 mb-2" data-toggle="modal" data-target="#exampleModal">
            <span class="icon text-white-50">
                <i class="fas fa-flag"></i>
            </span>
            <span class="text">Tambah Kegiatan</span>
        </button>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Kegiatan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php $query = $this->Generate_m->tampil_data($email); ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kegiatan</th>
                            <th>Tingkat</th>
                            <th> - </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($query as $row) : ?>
                            <?php
                            if ($row->tingkat == 1) {
                                $tingkat = "Sangat Penting";
                            } elseif ($row->tingkat == 2) {
                                $tingkat = "Penting";
                            } ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row->nama_kegiatan; ?></td>
                                <td><?= $tingkat; ?></td>
                                <td class="text-center">
                                    <button type="button" class="border-0 bg-transparent" data-toggle="modal" data-target="#exampleModalEdit<?= $i; ?>"><i class="fa fa-edit text-warning"></i></button>
                                    <a href="<?= base_url('generate/hapus_kegiatan?id=' . $row->id) ?>" class="border-0 bg-transparent"><i class="fa fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModalEdit<?= $i++; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url() ?>generate/edit_kegiatan" method="POST">
                                                <input type="hidden" value="<?= $row->id; ?>" name="id">
                                                <div class="form-group">
                                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                                    <input type="text" class="form-control" id="nama_kegiatan" aria-describedby="emailHelp" name="nama_kegiatan" placeholder="Masukan Nama Kegiatan" required value="<?= $row->nama_kegiatan; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tingkat">Tingkat</label>
                                                    <select class="form-control" id="tingkat" name="tingkat">
                                                        <option value="" disabled>Pilih Tingkat Kegiatan</option>
                                                        <?php if ($row->tingkat == 1) : ?>
                                                            <option value="1" selected>Sangat Penting</option>
                                                            <option value="2">Penting</option>
                                                        <?php elseif ($row->tingkat == 2) : ?>
                                                            <option value="1">Sangat Penting</option>
                                                            <option value="2" selected>Penting</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" id="" class="btn btn-primary">Simpan</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/') ?>js/alert.js"></script>