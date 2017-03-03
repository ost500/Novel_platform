@extends('layouts.mobile_layout')
@section('content')
	<!-- 메인 상단 배너 -->
	<div class="mtop_vs">
		<h2 class="mtop_vs_tit"><span class="ocher">여</span>기, <span class="ocher">정</span>오의 <span class="ocher">추천</span></h2>
		<!-- book list -->
		<ul class="mtop_list">
			<li>
				<a href="" class="mtop_list_a">
					<span class="mtlst_img"><img src="/mobile/images/mtop_thum1.jpg"></span>
					<span class="mtlst_txt">
						<strong>잔혹한 다정함에게</strong>
						<span class="name">이제현</span>
					</span>
				</a>
			</li>
			<li>
				<a href="" class="mtop_list_a">
					<span class="mtlst_img"><img src="/mobile/images/mtop_thum2.jpg"></span>
					<span class="mtlst_txt">
						<strong>미혹에 빠지다</strong>
						<span class="name">Milkymoon</span>
					</span>
				</a>
			</li>
			<li>
				<a href="" class="mtop_list_a">
					<span class="mtlst_img"><img src="/mobile/images/mtop_thum3.jpg"></span>
					<span class="mtlst_txt">
						<strong>심장중독</strong>
						<span class="name">요운</span>
					</span>
				</a>
			</li>
		</ul>
		<!-- book list //-->
	</div>
	<!-- 메인 상단 배너 //-->

	<!-- 내용 -->
	<div class="container">
		<div class="cont_wrap">
			<!-- 유료연재 베스트 -->
			<div>
				<div class="mlist_tit_rwap">
					<h2 class="mlist_tit"><span class="green">유료연재</span> 투데이 베스트</h2>
					<a href="" class="mlist_more">더보기</a>
				</div>
				<!-- 이미지 리스트 -->
				<table class="mlist_tbl">
					<colgroup>
						<col width="20%">
						<col width="25%">
						<col width="*">
					</colgroup>
					<tbody>
						<tr>
							<td class="mtbl_num"><em>1</em></td>
							<td class="talC"><span class="mtbl_img"><img src="/mobile/images/mlist_thum1.jpg"></span></td>
							<td class="">
								<div class="mtbl_tit">망의 연월</div>
								<div class="bw_name">림랑</div>
								<div class="mtbl_binfo">동양판타지<span class="mtbl_binfo_sl"></span>총 128화</div>
							</td>
						</tr>
						<tr>
							<td class="mtbl_num"><em>2</em></td>
							<td class="talC"><span class="mtbl_img"><img src="/mobile/images/mlist_thum2.jpg"></span></td>
							<td class="">
								<div class="mtbl_tit">고백게임</div>
								<div class="bw_name">이비안</div>
								<div class="mtbl_binfo">동양판타지<span class="mtbl_binfo_sl"></span>총 128화</div>
							</td>
						</tr>
						<tr>
							<td class="mtbl_num"><em>3</em></td>
							<td class="talC"><span class="mtbl_img"><img src="/mobile/images/mlist_thum3.jpg"></span></td>
							<td class="">
								<div class="mtbl_tit">낙원연가</div>
								<div class="bw_name">Girdap</div>
								<div class="mtbl_binfo">동양판타지<span class="mtbl_binfo_sl"></span>총 128화</div>
							</td>
						</tr>
						<tr>
							<td class="mtbl_num"><em>4</em></td>
							<td class="talC"><span class="mtbl_img"><img src="/mobile/images/mlist_thum4.jpg"></span></td>
							<td class="">
								<div class="mtbl_tit">망의 연월</div>
								<div class="bw_name">림랑</div>
								<div class="mtbl_binfo">동양판타지<span class="mtbl_binfo_sl"></span>총 128화</div>
							</td>
						</tr>
						<tr>
							<td class="mtbl_num"><em>5</em></td>
							<td class="talC"><span class="mtbl_img"><img src="/mobile/images/mlist_thum5.jpg"></span></td>
							<td class="">
								<div class="mtbl_tit">망의 연월</div>
								<div class="bw_name">림랑</div>
								<div class="mtbl_binfo">동양판타지<span class="mtbl_binfo_sl"></span>총 128화</div>
							</td>
						</tr>
					</tbody>
				</table>
				<!-- 이미지 리스트 //-->
			</div>
			<!-- 유료연재 베스트 //-->

			<!-- 무료연재 베스트 -->
			<div>
				<div class="mlist_tit_rwap">
					<h2 class="mlist_tit"><span class="green">무료연재</span> 투데이 베스트</h2>
					<a href="" class="mlist_more">더보기</a>
				</div>
				<!-- 리스트 -->
				<table class="mlist_tbl">
					<colgroup>
						<col width="20%">
						<col width="*">
					</colgroup>
					<tbody>
						<tr>
							<td class="mtbl_num"><em>1</em></td>
							<td class=""><span class="mtbl_tit">꽃날</span><span class="mtbl_sl"></span><span class="bw_name">Milkymoon</span></td>
						</tr>
						<tr>
							<td class="mtbl_num"><em>2</em></td>
							<td class=""><span class="mtbl_tit">뷰티풀 라이프</span><span class="mtbl_sl"></span><span class="bw_name">블루데빌</span></td>
						</tr>
						<tr>
							<td class="mtbl_num"><em>3</em></td>
							<td class=""><span class="mtbl_tit">마이달달달링</span><span class="mtbl_sl"></span><span class="bw_name">김솔</span></td>
						</tr>
						<tr>
							<td class="mtbl_num"><em>4</em></td>
							<td class=""><span class="mtbl_tit">하데스</span><span class="mtbl_sl"></span><span class="bw_name">우유양</span></td>
						</tr>
						<tr>
							<td class="mtbl_num"><em>5</em></td>
							<td class=""><span class="mtbl_tit">사랑을 디자인하다.</span><span class="mtbl_sl"></span><span class="bw_name">낡은키보드</span></td>
						</tr>
					</tbody>
				</table>
				<!-- 리스트 //-->
			</div>
			<!-- 무료연재 베스트 //-->

			<!-- 독자추천 -->
			<div>
				<div class="mlist_tit_rwap">
					<h2 class="mlist_tit">독자추천</h2>
					<a href="" class="mlist_more">더보기</a>
				</div>
				<!-- 리스트 -->
				<table class="mlist_tbl">
					<tbody>
						<tr>
							<td>
								<div class="mtbl_recTit">오랜만에 만나본...</div>
								<div class="mtbl_recTxt">이 글을 읽기 시작한게 새벽12시쯤이었는데 벌써 해가 뜰 시간이네요.오랜만에 가슴에 확 와닿는 소설이 이 글을 읽기 시작한게 새벽12시쯤이었는데 </div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="mtbl_recTit">동화의 재구성</div>
								<div class="mtbl_recTxt">이 글을 읽기 시작한게 새벽12시쯤이었는데 벌써 해가 뜰 시간이네요.오랜만에 가슴에 확 와닿는 소설이 이 글을 읽기 시작한게 새벽12시쯤이었는데 </div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="mtbl_recTit">감탄을 자아냈습니다.</div>
								<div class="mtbl_recTxt">이 글을 읽기 시작한게 새벽12시쯤이었는데 벌써 해가 뜰 시간이네요.오랜만에 가슴에 확 와닿는 소설이 이 글을 읽기 시작한게 새벽12시쯤이었는데 </div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="mtbl_recTit">템빨(?) 여주의 씩씩한 모험기</div>
								<div class="mtbl_recTxt">이 글을 읽기 시작한게 새벽12시쯤이었는데 벌써 해가 뜰 시간이네요.오랜만에 가슴에 확 와닿는 소설이 이 글을 읽기 시작한게 새벽12시쯤이었는데 </div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="mtbl_recTit">작품리뷰</div>
								<div class="mtbl_recTxt">이 글을 읽기 시작한게 새벽12시쯤이었는데 벌써 해가 뜰 시간이네요.오랜만에 가슴에 확 와닿는 소설이 이 글을 읽기 시작한게 새벽12시쯤이었는데 </div>
							</td>
						</tr>
					</tbody>
				</table>
				<!-- 리스트 //-->
			</div>
			<!-- 독자추천 //-->

			<!-- 님을 위한 추천 -->
			<div class="recommend_box mart70">
				<h2 class="mrecbox_tit"><span class="green">Kimdal</span>님을 위한 추천</h2>
				<!-- 추천도서 리스트 -->
				<ul class="recoList">
					<li>
						<a href="" class="reco_list_a">
							<span class="reco_img"><img src="/mobile/images/mreco_1.jpg"></span>
							<span class="reco_txt">
								<strong>망의 연월</strong>
								<span class="name">림랑</span>
							</span>
						</a>
					</li>
					<li>
						<a href="" class="reco_list_a">
							<span class="reco_img"><img src="/mobile/images/mreco_2.jpg"></span>
							<span class="reco_txt">
								<strong>한설</strong>
								<span class="name">Milkymoon</span>
							</span>
						</a>
					</li>
					<li>
						<a href="" class="reco_list_a">
							<span class="reco_img"><img src="/mobile/images/mreco_3.jpg"></span>
							<span class="reco_txt">
								<strong>상사화의 계절</strong>
								<span class="name">류도하</span>
							</span>
						</a>
					</li>
					<li>
						<a href="" class="reco_list_a">
							<span class="reco_img"><img src="/mobile/images/mreco_4.jpg"></span>
							<span class="reco_txt">
								<strong>색시</strong>
								<span class="name">이미연</span>
							</span>
						</a>
					</li>
					<li>
						<a href="" class="reco_list_a">
							<span class="reco_img"><img src="/mobile/images/mreco_3.jpg"></span>
							<span class="reco_txt">
								<strong>상사화의 계절</strong>
								<span class="name">류도하</span>
							</span>
						</a>
					</li>
					<li>
						<a href="" class="reco_list_a">
							<span class="reco_img"><img src="/mobile/images/mreco_4.jpg"></span>
							<span class="reco_txt">
								<strong>색시</strong>
								<span class="name">이미연</span>
							</span>
						</a>
					</li>
					<li>
						<a href="" class="reco_list_a">
							<span class="reco_img"><img src="/mobile/images/mreco_1.jpg"></span>
							<span class="reco_txt">
								<strong>망의 연월</strong>
								<span class="name">림랑</span>
							</span>
						</a>
					</li>
					<li>
						<a href="" class="reco_list_a">
							<span class="reco_img"><img src="/mobile/images/mreco_2.jpg"></span>
							<span class="reco_txt">
								<strong>한설</strong>
								<span class="name">Milkymoon</span>
							</span>
						</a>
					</li>
				</ul>
				<!-- 추천도서 리스트 //-->
			</div>
			<!-- 님을 위한 추천 //-->
		</div>
	</div>
	<!-- 내용 //-->
@endsection