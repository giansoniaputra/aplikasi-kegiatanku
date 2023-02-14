<form action="<?= base_url() ?>jadwal/tambah_kegiatan" method="POST">
    <div class="form-group">
        <label for="nama_kegiatan">Name of Quest</label>
        <input type="text" class="form-control" id="nama_kegiatan" aria-describedby="emailHelp" name="nama_kegiatan" placeholder="Enter The Quest" required>
    </div>
    <div class="form-group">
        <label for="tanggal">Date</label>
        <input type="date" class="form-control" id="tanggal" aria-describedby="emailHelp" name="tanggal" value="<?= $tanggal; ?>" required>
    </div>
    <div class="form-group">
        <label for="tingkat">Difficulty</label>
        <select class="form-control" id="tingkat" name="tingkat" required>
            <option value="" disabled selected>Select Difficulty Level</option>
            <option value="1">Very Hard</option>
            <option value="2">Hard</option>
        </select>
    </div>
    <input type="hidden" value="<?= $email; ?>" name="user" id="user-id">