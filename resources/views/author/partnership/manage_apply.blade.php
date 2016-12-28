@extends('layouts.app')
@section('content')


	<div id="content-container">

		<div id="page-title">
			<h1 class="page-header text-overflow">연재신청내역</h1>
		</div>


		<ol class="breadcrumb">
			<li><a href="#">어드민</a></li>
			<li class="active">연재신청내역</li>
		</ol>


		<div id="page-content">



			<div class="row">
				<div class="col-sm-12">

					<div class="panel">
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
									<tr>
										<th>작가명</th>
										<th>작품명</th>
										<th>연재요청업체명</th>
										<th class="text-center">초기연재회차</th>
										<th class="text-center">일</th>
										<th class="text-center">편수</th>
										<th class="text-center">신청일</th>
										<th class="text-center">처리일</th>
										<th class="text-center">상태</th>
									</tr>
									</thead>
									<tbody>

									<tr>
										<td class="col-md-1">작가명1</td>
										<td class="col-md-2">작품명1</td>
										<td class="col-md-2">네이버</td>
										<td class="col-md-1 text-center">20편</td>
										<td class="col-md-1 text-center">1일</td>
										<td class="col-md-1 text-center">2편</td>
										<td class="col-md-1 text-center">2016-12-20</td>
										<td class="col-md-1 text-center">2016-12-20</td>
										<td class="col-md-2 text-center">
											<button class="btn btn-sm btn-warning">심사중</button>
											<button class="btn btn-sm btn-primary">승인</button>
											<button class="btn btn-sm btn-danger">거절</button>
										</td>
									</tr>

									<tr>
										<td class="col-md-1">작가명2</td>
										<td class="col-md-2">작품명2</td>
										<td class="col-md-2">카카오</td>
										<td class="col-md-1 text-center">30편</td>
										<td class="col-md-1 text-center">1일</td>
										<td class="col-md-1 text-center">2편</td>
										<td class="col-md-1 text-center">2016-12-20</td>
										<td class="col-md-1 text-center">2016-12-20</td>
										<td class="col-md-2 text-center">
											<button class="btn btn-sm btn-warning">심사중</button>
											<button class="btn btn-sm btn-primary">승인</button>
											<button class="btn btn-sm btn-danger">거절</button>
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