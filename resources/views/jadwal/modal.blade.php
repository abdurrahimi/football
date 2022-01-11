<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Jadwal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <form method="post" action="#" id="form">
                <input type="hidden" value="" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Tim Tuan Rumah</label>
                        <select class="form-control" name="home_id" required>
                            <option value="">Pilih Tim Tuan Rumah</option>
                            @foreach ($team as $item)
                                <option value="{{$item->id}}">{{$item->nama_tim}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tim Tamu</label>
                        <select class="form-control" name="away_id" required>
                            <option value="">Pilih Tim Tamu</option>
                            @foreach ($team as $item)
                                <option value="{{$item->id}}">{{$item->nama_tim}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label class="form-label">Jadwal</label>
                        <input type="date" name="date" class="form-control" required>
                    </div> --}}
                    <div class="form-group">
                        <label class="form-label">Jadwal</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input name="date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                            </div>
                        </div>
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