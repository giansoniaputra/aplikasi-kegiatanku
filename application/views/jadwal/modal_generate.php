<form action="jadwal/tambah_kegiatan" method="POST">
    <div class="form-group">
        <label for="nama_kegiatan">Nama Kegiatan</label>
        <input type="text" class="form-control" id="nama_kegiatan" aria-describedby="emailHelp" name="nama_kegiatan" placeholder="Masukan Nama Kegiatan" required>
    </div>
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" aria-describedby="emailHelp" name="tanggal" value="<?= $tanggal; ?>" required>
    </div>
    <div class="form-group">
        <label for="tingkat">Tingkat</label>
        <select class="form-control" id="tingkat" name="tingkat">
            <option value="" disabled selected>Pilih Tingkat Kegiatan</option>
            <option value="1">Sangat Penting</option>
            <option value="2">Penting</option>
        </select>
    </div>