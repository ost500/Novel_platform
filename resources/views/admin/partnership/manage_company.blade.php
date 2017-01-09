@extends('layouts.admin_layout')
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
											<a href="{{route('admin.partner_create_company')}}"><button class="btn btn-primary novel-user-nick-form">업체추가</button></a>
										</div>

										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th class="text-center">업체명</th>
													<th class="text-center">이미지</th>
													<th class="text-center">초기연재회차</th>
													<th class="text-center">성인물 허가</th>
													<th class="text-center">관리</th>
												</tr>
											</thead>
											<tbody>
												@foreach($companies as $company)
												<tr>
													<td class="col-md-2"><a href="">{{$company->name}} <!--업체명1--></a></td>
													<td class="text-center">
														@if($company->company_picture)
															<img  class="index_img"  src="/img/company_pictures/{{$company->company_picture}}" width="100">

														@else
															<img  class="index_img"  src="/img/novel_covers/default_.jpg" width="100">
														@endif
													</td>
													<td class="text-center">{{$company->initial_inning}} </td>
													<td class="text-center">@if($company->adult_allowance)  Yes @else No  @endif </td>
													<td class="text-center">
														<a href="{{route('admin.partner_edit_company',['id'=>$company->id])}}"><button class="btn btn-success">수정</button></a>
														<button class="btn btn-warning"  onclick="destroy({{$company->id}})" >삭제</button>
													</td>
												</tr>
												@endforeach

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>


			</div>
			<script type="text/javascript">



				function destroy(company_id) {
					bootbox.confirm({
						message: "삭제 하시겠습니까?",
						buttons: {
							confirm: {
								label: "삭제"
							},
							cancel: {
								label: '취소'
							}
						},
						callback: function (result) {
							if (result) {
								$.ajax({
									type: 'DELETE',
									url: '{{ url('/companies') }}/' + company_id,
									headers: {
										'X-CSRF-TOKEN': window.Laravel.csrfToken
									},
									success: function (response) {

										$.niftyNoty({
											type: 'warning',
											icon: 'fa fa-check',
											message: "해당 업체가 삭제 되었습니다.",
											container: 'page',
											timer: 4000
										});
										location.reload();
									},
									error: function (data2) {
										console.log(data2);
									}
								});

							}
						}
					});
				}


			</script>

@endsection
