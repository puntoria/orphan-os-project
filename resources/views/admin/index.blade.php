@extends('admin.base')

@section('page-content')

		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Lista e jetimëve</h3>
			</div>
			<!-- /.col-lg-12 -->
		</div>

		<!-- /.row -->
		<div class="row">
			<div class="col-lg-12" style="margin-bottom: 15px;">
				<ul class="nav nav-pills">
					<li class="disabled"><a href="#">Të gjithë <span class="badge">2316</span></a></li>
					<li><a href="#">Me donacion <span class="badge">2117</span></a></li>
					<li><a href="#">Pa donacion <span class="badge">199</span></a></li>

					<div class="pull-right">
						<select name="my-select" id="my-select" class="form-control pull-left">
							<option>10 jetimë për faqe</option>
							<option>25 jetimë për faqe</option>
							<option>50 jetimë për faqe</option>
							<option>100 jetimë për faqe</option>
							<option>250 jetimë për faqe</option>
							<option>500 jetimë për faqe</option>
							<option>1000 jetimë për faqe</option>
							<option>Të gjithë</option>
						</select>
					</div>
				</ul>
			</div>

			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="width: 5%;">#</th>
								<th style="width: 10%;">Donatori</th>
								<th style="width: 5%;">Donacion?</th>
								<th style="width: 20%;">Emri</th>
								<th style="width: 20%;">Emri i Babes</th>
								<th style="width: 20%;">Mbiemri</th>
								<th style="width: 10%;">Qyteti</th>
								<th style="width: 5%;">Video</th>
								<th style="width: 5%;"></th>
							</tr>
						</thead>
						<tbody>
							<?php for($i = 1; $i < 50; $i++): ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td>Mark Otto</td>
									<td>Po</td>
									<td>Trim</td>
									<td>Zenel</td>
									<td>Gashi</td>
									<td>Prizren</td>
									<td><i class="fa fa-youtube-play"></i></td>
									<th>
										<div class="dropdown">
											<a id="dLabel" type="button" class="fa fa-cog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											</a>
											<ul class="dropdown-menu pull-right" aria-labelledby="dLabel">
												<li><a href="#">Shkarko PDF</a></li>
												<li><a href="#">Shkarko Raportin Financiar</a></li>
												<li class="separator"></li>
												<li><a href="#">Ndrysho</a></li>
												<li><a href="#">Shto Raport Financiar</a></li>
												<li><a href="#">Fshije</a></li>
											</ul>
										</div>
									</th>
								</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</div>
				<!-- /.table-responsive -->
			</div>
			<!-- /.panel -->

			<div class="col-lg-12">
				<nav class="pull-right">
					<ul class="pagination">
						<li class="disabled">
							<a href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li>
							<a href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>

<!-- Modal -->
<div class="modal fade" id="add-orphan-modal" tabindex="-1" role="dialog" aria-labelledby="add-orphan-modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection