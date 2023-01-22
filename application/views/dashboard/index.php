<?php $query = $this->Dashboard_m->tampil_data($tanggal, $email); ?>

<div class="container-fluid">
    <?php if ($this->db->affected_rows($query) > 0) : ?>
        <div class="col-xl-8 col-md-6 mb-4">
            <div class="card border-left-warning bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h2 class="text-warning pb-3">Warning!</h2>
                            <?php foreach ($query as $row) : ?>
                                <?php $sisa = strtotime($row->tanggal) - strtotime($tanggal); ?>
                                <div class="h6 mb-0 font-weight-bold text-white my-2">* Dalam waktu <span class="text-warning"><?= date('d', $sisa) ?> hari</span> kedepan kamu punya kegiatan yaitu: <span class="text-warning"><b><?= $row->nama_kegiatan; ?></b></span> </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-info-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="col-xl-8 col-md-6 mb-4">
            <div class="card border-left-primary bg-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h2 class="text-white pb-3">Selemat!</h2>
                            <div class="h6 mb-0 font-weight-bold text-white my-2">Yeayyyyy🥳 Kamu terbebas dari kegiatan apapun. jadi kamu gak perlu khawatir tentang deadline</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-info-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>