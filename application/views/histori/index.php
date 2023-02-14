<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-white">Question Histories</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 text-white" style="background-image:url('<?= base_url('assets/img/bg-quest.jpg'); ?>'); background-repeat:no-repeat; background-size:cover; background-position:end;">
        <div class="card-header py-3" style="background-image:url('<?= base_url('assets/img/bg-quest.jpg'); ?>'); background-repeat:no-repeat; background-size:cover; background-position:end;">
            <label for="">Select Date</label>
            <input class="form-control form-control-sm col-sm-2" type="date" id="tanggal">
            <input type="hidden" value="<?= $email; ?>" id="user">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-white" id="tableku" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name of Question</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h1 class="h3 mb-2 text-white">Question To Do Next</h1>
    <?php $next_agenda = $this->Histori_m->tampil_data_next($tanggal, $email);
    $i = 1; ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="background-image:url('<?= base_url('assets/img/bg-quest.jpg'); ?>'); background-repeat:no-repeat; background-size:cover; background-position:end;">
        <div class="card-header py-3" style="background-image:url('<?= base_url('assets/img/bg-quest.jpg'); ?>'); background-repeat:no-repeat; background-size:cover; background-position:end;">

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-white" id="tableku2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name of Question</th>
                            <th>Date</th>
                            <th> - </th>
                        </tr>
                    </thead>
                    <tbody id="tbody2">
                        <?php foreach ($next_agenda as $row) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row->nama_kegiatan; ?></td>
                                <td>
                                    <?= $row->tanggal; ?>
                                    <input type="hidden" value="<?= $row->id; ?>" id="id<?= $i; ?>">
                                    <input type="hidden" value="<?= $tanggal; ?>" id="tanggal<?= $i; ?>">
                                    <input type="hidden" value="<?= $row->tanggal; ?>" id="tanggal_n<?= $i; ?>">
                                    <input type="hidden" value="<?= $email; ?>" id="user<?= $i; ?>">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="border-0 bg-transparent" data-toggle="modal" data-target="#exampleModalEdit<?= $i; ?>"><i class="fa fa-edit text-warning"></i></button>
                                    <button type="button" class="border-0 bg-transparent"><i class="fa fa-trash text-danger" id="delete<?= $i; ?>"></i></button>
                                </td>
                            </tr>
                            <!-- modal edit -->
                            <div class="modal fade" id="exampleModalEdit<?= $i++; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" style="background-image:url('<?= base_url('assets/img/bg-naga.jpg'); ?>'); background-repeat:no-repeat; background-size:cover; background-position:end;">
                                <div class="modal-dialog" style="background-image:url('<?= base_url('assets/img/bg-quest.jpg'); ?>'); background-repeat:no-repeat; background-size:cover; background-position:end;">
                                    <div class="modal-content border-white text-white" style="background-image:url('<?= base_url('assets/img/bg-quest.jpg'); ?>'); background-repeat:no-repeat; background-size:cover; background-position:end;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Quest</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url() ?>histori/edit_kegiatan" method="POST">
                                                <input type="hidden" value="<?= $row->id; ?>" name="id">
                                                <div class="form-group">
                                                    <label for="nama_kegiatan">Name of Quest</label>
                                                    <input type="text" class="form-control" id="nama_kegiatan" aria-describedby="emailHelp" name="nama_kegiatan" placeholder="Masukan Nama Kegiatan" required value="<?= $row->nama_kegiatan; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal">Date</label>
                                                    <input type="date" class="form-control" id="tanggal" aria-describedby="emailHelp" name="tanggal" value="<?= $row->tanggal; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tingkat">Difficulty</label>
                                                    <select class="form-control" id="tingkat" name="tingkat">
                                                        <option value="" disabled>Select Difficulty Level</option>
                                                        <?php if ($row->tingkat == 1) : ?>
                                                            <option value="1" selected>Very Hard</option>
                                                            <option value="2">Hard</option>
                                                        <?php elseif ($row->tingkat == 2) : ?>
                                                            <option value="1">Very Hard</option>
                                                            <option value="2" selected>Hard</option>
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
                            <!-- modal edit -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tableku').DataTable({
            responsive: true,
            processing: true,
            searching: false,
            bLengthChange: false,
            paging: false,
            ordering: false,
            info: false,
            oLanguage: {
                sEmptyTable: "<small>Silahkan Pilih Tanggal Kegiatan</small>"
            }

        });

        $('#tableku2').DataTable({
            responsive: true,
            processing: true,
            searching: true,
            bLengthChange: true,
            paging: true,
            ordering: false,
            info: true,

        });

        $("#tanggal").on("change", function() {
            let tanggal = $("#tanggal").val();
            let user = $("#user").val();
            $.ajax({
                url: "<?= base_url('histori/data_table'); ?>",
                data: {
                    tanggal: tanggal,
                    user: user,
                },
                type: "POST",
                success: function(data) {
                    $("#tbody").html(data);
                }
            });
        });
        <?php $q = 1; ?>
        <?php foreach ($next_agenda as $row) : ?>

            $("#delete<?= $q; ?>").on("click", function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $("#id<?= $q; ?>").val()
                        let tanggal = $("#tanggal<?= $q; ?>").val()
                        let tanggal2 = $("#tanggal_n<?= $q; ?>").val()
                        let user = $("#user<?= $q++; ?>").val()
                        $.ajax({
                            url: "<?= base_url('histori/delete_data'); ?>",
                            data: {
                                id: id,
                                tanggal: tanggal,
                                tanggal2: tanggal2,
                                user: user
                            },
                            type: "POST",
                            success: function(data) {
                                document.location.href = '<?= base_url('histori/'); ?>'
                            }
                        });
                    }
                })

            })
        <?php endforeach; ?>
    });
</script>