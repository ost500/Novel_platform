<?
	include_once("head.skin.php");	
?>
		<div class="boxed">
			<div id="content-container">
				
				<div id="page-title">
					<h1 class="page-header text-overflow">작품목록</h1>
				</div>


				<ol class="breadcrumb">
					<li><a href="#">작가홈</a></li>
					<li><a href="#">작품관리</a></li>
					<li class="active">작품목록</li>
				</ol>


				<div id="page-content">
					


					<div class="row">
						<div class="col-lg-12">
							
							<div class="panel">
								<div class="panel-body">
									<div class="table-responsive">
										<div class="padding-bottom-5">
											<a href="novel_write.php"><button class="btn btn-primary">작품추가</button></a>
										</div>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td class="text-center col-md-2"><a href="novel_inning_list.php">표지이미지</a></td>
													<td>
														<table class="table-no-border" style="width:100%;">
															<tr>
																<td><h4><a href="novel_inning_list.php">꼬마 아가씨의 첫사랑 - 윤사라</a></h4></td>	
															</tr>
															<tr>
																<td>등록된 회차수 : 2화, 마지막 업로드 일자 : 2016-11-10</td>	
															</tr>
															<tr>
																<td class="padding-top-10 text-right">
																	<button class="btn btn-primary">댓글 1,000</button>
																	<button class="btn btn-info">리뷰 1,000</button>
																	<button class="btn btn-success">수정</button>
																	<button class="btn btn-mint">비밀</button>
																	<button class="btn btn-warning">삭제</button>
																</td>	
															</tr>
														</table>
													</td>
												</tr>
											</tbody>
										</table>


										<div class="padding-top-10"><h4>댓글 3</h4></div>

										
										<div class="novel-review">
											<div class="review-write pad-all">
												<textarea id="demo-textarea-input" rows="4" class="form-control inline" style="width:50%" placeholder="댓글"></textarea>
												<button class="btn btn-primary inline" style="width:100px;height:83px; vertical-align:top;">등록</button>
											</div>

											<div class="review">
												<div>
													<span class="nick">닉네임</span> 2016-11-10 00:00:00
													<button class="btn btn-xs btn-pink">N</button>
												</div>
												<div class="content">
													<span class="inning">8회</span> 둘이 당췌 먼 사연인지는 모르지만 유부녀가 바에서 꽐라될때까지 술마신거나 속마음 터놓지도 못하는거나 답답합니다 고구마철이라고 고구마 두시는건지
												</div>
												<div class="button">
													<button class="btn btn-xs btn-mint">답변</button>
													<button class="btn btn-xs btn-danger">신고</button>
												</div>
											</div>

											<div class="review reply">
												<div>
													<span class="nick">닉네임</span> 2016-11-10 00:00:00
													<button class="btn btn-xs btn-pink">N</button>
												</div>
												<div class="content">
													<span class="inning">8회</span> 둘이 당췌 먼 사연인지는 모르지만 유부녀가 바에서 꽐라될때까지 술마신거나 속마음 터놓지도 못하는거나 답답합니다 고구마철이라고 고구마 두시는건지
												</div>
												<div class="button">
													<button class="btn btn-xs btn-mint">답변</button>
													<button class="btn btn-xs btn-danger">신고</button>
												</div>
											</div>

											<div class="review">
												<div>
													<span class="nick">닉네임</span> 2016-11-10 00:00:00
													<button class="btn btn-xs btn-pink">N</button>
												</div>
												<div class="content">
													<span class="inning">8회</span> 둘이 당췌 먼 사연인지는 모르지만 유부녀가 바에서 꽐라될때까지 술마신거나 속마음 터놓지도 못하는거나 답답합니다 고구마철이라고 고구마 두시는건지
												</div>
												<div class="button">
													<button class="btn btn-xs btn-mint">답변</button>
													<button class="btn btn-xs btn-danger">신고</button>
												</div>
											</div>

											<div class="review reply">
												<div>
													<span class="nick">닉네임</span> 2016-11-10 00:00:00
													<button class="btn btn-xs btn-pink">N</button>
												</div>
												<div class="content">
													<span class="inning">8회</span> 둘이 당췌 먼 사연인지는 모르지만 유부녀가 바에서 꽐라될때까지 술마신거나 속마음 터놓지도 못하는거나 답답합니다 고구마철이라고 고구마 두시는건지
												</div>
												<div class="button">
													<button class="btn btn-xs btn-mint">답변</button>
													<button class="btn btn-xs btn-danger">신고</button>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>


			</div>


			<nav id="mainnav-container">
				<div id="mainnav">

					<div id="mainnav-shortcut">
						<ul class="list-unstyled">
						</ul>
					</div>

<?
	include_once("menu.skin.php");	
?>					

				</div>
			</nav>
			
			

		</div>
<?
	include_once("footer.skin.php");	
?>