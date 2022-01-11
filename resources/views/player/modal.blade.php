<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Pemain</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <form method="post" action="#" id="form">
                <input type="hidden" value="" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Pemain</label>
                        <input type="text" name="nama_pemain" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tinggi</label>
                        <input type="number" name="tinggi" class="form-control" required>
                    </div>
                    <div class="form-group is-invalid">
                        <label class="form-label">Posisi</label>
                        <select class="form-control" name="posisi" required>
                            <option value=""></option>
                            <option value="PENYERANG">PENYERANG</option>
                            <option value="GELANDANG">GELANDANG</option>
                            <option value="BERTAHAN">BERTAHAN</option>
                            <option value="PENJAGA GAWANG">PENJAGA GAWANG</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Punggung</label>
                        <input type="text" name="nomor_punggung" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                </div>
            </form>
		</div>
	</div>
</div>