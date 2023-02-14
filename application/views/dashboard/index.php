<?php $query = $this->Dashboard_m->tampil_data($tanggal, $email); ?>
<div class="container-fluid">
    <?php if ($this->db->affected_rows($query) > 0) : ?>
        <div class="col-xl-8 col-md-6 mb-4">
            <div class="border-left-warning shadow-lg h-100 py-2" style="background-image:url('<?= base_url('assets/img/bg-quest.jpg'); ?>'); background-repeat:no-repeat; background-size:cover; background-position:end;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h2 class="text-warning pb-3 blink_me">Quest To Do Next!</h2>
                            <?php foreach ($query as $row) : ?>
                                <?php $sisa = strtotime($row->tanggal) - strtotime($tanggal);
                                $ref = strtotime('2023-01-14') - strtotime('2023-01-13');
                                $waktu = $sisa - $ref;
                                ?>
                                <?php if (date('d', $waktu) > 1) : ?>
                                    <div class="h6 mb-0 font-weight-bold text-white my-2">* Within <span class="text-warning"><?= date('d', $waktu) ?> Days</span> (<?= tanggal_hari($row->tanggal, TRUE) ?>). You have a quest to do, Namely: <span class="text-warning"><b><?= $row->nama_kegiatan; ?></b></span> </div>
                                <?php elseif (date('d', $waktu) == 1) : ?>
                                    <div class="h6 mb-0 font-weight-bold text-white my-2">* <span class="text-warning">Tomorrow </span> You Have 1 Quest to do: <span class="text-warning"><b><?= $row->nama_kegiatan; ?></b></span> </div>
                                <?php endif; ?>
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
            <div class="border-left-warning shadow-lg h-100 py-2" style="background-image:url('<?= base_url('assets/img/bg-quest.jpg'); ?>'); background-repeat:no-repeat; background-size:cover; background-position:end;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h2 class="text-white pb-3">Great!</h2>
                            <div class="h6 mb-0 font-weight-bold text-white my-2">Yeay💖 You not have question to do about 2 week ahead</div>
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