@extends('layouts.app')
@section('content')


	<div id="content-container">
				
				<div id="page-title">
					<h1 class="page-header text-overflow">제휴업체관리</h1>
				</div>


				<ol class="breadcrumb">
					<li><a href="#">어드민</a></li>
					<li class="active"><a href="#">제휴업체관리</a></li>
				</ol>


				<div id="page-content">
					


					<div class="panel panel-default panel-left">
						<div class="panel-body">

							<form role="form" class="form-horizontal">
								<div class="form-group">
									<label class="col-lg-1 control-label text-left" for="inputSubject">업체명</label>
									<div class="col-lg-11">
										<input type="text" id="inputSubject" class="form-control" placeholder="업체명">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-1 control-label text-left" for="inputSubject">이미지</label>
									<div class="col-lg-1">
										<img src="http://211.110.165.137/img/novel_covers/default_.jpg" width="100">
									</div>
									<div class="col-lg-10">
										<input type="file" id="inputSubject" class="form-control" placeholder="이미지">
										<small class="has-warning">최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG 파일</small>
									</div>
								</div>


								<div class="form-group">
									<label class="col-lg-1 control-label text-left" for="inputSubject">수수료</label>
									<div class="col-lg-11">
										<input type="text" id="inputSubject" class="form-control" placeholder="수수료">
									</div>
								</div>
							</form>
		


							<div id="demo-mail-compose"></div>
		
							<div class="text-center">
								<button id="mail-send-btn" type="button" class="btn btn-primary btn-labeled">
									<span class="btn-label"><i class="fa fa-paper-plane"></i></span> 등록하기
								</button>
								<a href="manage_company.blade.php"><button type="button" class="btn btn-danger">취소</button></a>
							</div>
						</div>
					</div>


				</div>


			</div>


@endsection