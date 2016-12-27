@extends('layouts.app')
@section('content')
			<div id="content-container">
				
				<div id="page-title">
					<h1 class="page-header text-overflow">제휴업체관리</h1>
				</div>


				<ol class="breadcrumb">
					<li><a href="#">작가홈</a></li>
					<li class="active">제휴업체관리</li>
				</ol>


				<div id="page-content">
					


					<div class="row">
						<div class="col-sm-12">

							<div class="panel">
								<div class="panel-body">
									<div class="table-responsive">
										<div class="padding-bottom-5">
											<a href="manage_apply.blade.php"><button class="btn btn-primary novel-user-nick-form">업체추가</button></a>
										</div>

										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th class="text-center">업체명</th>
													<th class="text-center">관리</th>
												</tr>
											</thead>
											<tbody>
												
												<tr>
													<td class="col-md-9"><a href="manage_apply.blade.php">업체명1</a></td>
													<td class="text-center">
														<a href="manage_apply.blade.php"><button class="btn btn-success">수정</button></a>
														<button class="btn btn-warning">삭제</button>
													</td>
												</tr>

												<tr>
													<td class="col-md-9"><a href="manage_apply.blade.php">업체명2</a></td>
													<td class="text-center">
														<a href="manage_apply.blade.php"><button class="btn btn-success">수정</button></a>
														<button class="btn btn-warning">삭제</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>


			</div>


@endsection