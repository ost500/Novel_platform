<?
	include_once("head.skin.php");	
?>
		<div class="boxed">
			<div id="content-container">
				
				<div id="page-title">
					<h1 class="page-header text-overflow">작품등록</h1>
				</div>


				<ol class="breadcrumb">
					<li><a href="#">작가홈</a></li>
					<li><a href="#">작품관리</a></li>
					<li class="active">작품회차목록</li>
				</ol>


				<div id="page-content">
					


					<div class="row">
						<div class="col-sm-12">

							<div class="panel">
								<form class="panel-body form-horizontal form-padding">
					
									<!--Static-->
									<!--div class="form-group">
										<label class="col-md-2 control-label">Static</label>
										<div class="col-md-9"><p class="form-control-static">Username</p></div>
									</div-->
					
									<div class="form-group">
										<label class="col-md-2 control-label" for="demo-text-input">필명</label>
										<div class="col-md-9">
											<select class="form-control">
												<option value="">필명선택</option>
												<option value="">필명1</option>
												<option value="">필명2</option>
											</select>
											<!--small class="help-block">This is a help text</small-->
										</div>
									</div>
					
									<div class="form-group">
										<label class="col-md-2 control-label" for="demo-email-input">작품제목</label>
										<div class="col-md-9">
											<input type="text" name="title" id="demo-email-input" class="form-control" placeholder="작품 제목을 입력해 주세요." data-bv-field="title">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="demo-textarea-input">작품소개</label>
										<div class="col-md-9">
											<textarea id="demo-textarea-input" rows="9" class="form-control" placeholder="작품 소개를 입력해 주세요"></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="demo-text-input">키워드</label>
										<div class="col-md-9">
											<select class="form-control inline" style="width:14%;" size=10>
												<option value="">장르</option>
												<option value="">현대판타지</option>
												<option value="">사극/시대물</option>
												<option value="">동양판타지</option>
												<option value="">서양/중세</option>
												<option value="">로맨스판타지</option>
												<option value="">미래/SF</option>
											</select>

											<select class="form-control inline" style="width:14%;" size=10>
												<option value="">배경</option>
												<option value="">필명1</option>
												<option value="">필명2</option>
											</select>

											<select class="form-control inline" style="width:14%;" size=10>
												<option value="">소재</option>
												<option value="">필명1</option>
												<option value="">필명2</option>
											</select>

											<select class="form-control inline" style="width:14%;" size=10>
												<option value="">관계</option>
												<option value="">필명1</option>
												<option value="">필명2</option>
											</select>

											<select class="form-control inline" style="width:14%;" size=10>
												<option value="">남주인공</option>
												<option value="">필명1</option>
												<option value="">필명2</option>
											</select>

											<select class="form-control inline" style="width:14%;" size=10>
												<option value="">여주인공</option>
												<option value="">필명1</option>
												<option value="">필명2</option>
											</select>

											<select class="form-control inline" style="width:14%;" size=10>
												<option value="">분위기/기타</option>
												<option value="">필명1</option>
												<option value="">필명2</option>
											</select>
										</div>
									</div>
					
									<div class="form-group">
										<label class="col-md-2 control-label" for="demo-password-input">기본표지</label>
										<div class="col-md-9">
											<input type="text" id="demo-password-input" style="width:30%;" class="form-control inline" placeholder="사용하려면 우측 표지선택 버튼을 클릭하세요.">
											<button class="btn btn-primary">표지선택</button>
										</div>
									</div>

									
					
									
									<div class="form-group">
										<label class="col-md-2 control-label">표지 직접등록1</label>
										<div class="col-md-9">
											<input type="file" id="demo-password-input" class="form-control" placeholder="Password">
											<small class="has-warning">사이즈 : 900*900 / 최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG 파일</small>
										</div>
									</div>


									<div class="form-group">
										<label class="col-md-2 control-label">표지 직접등록2</label>
										<div class="col-md-9">
											<input type="file" id="demo-password-input" class="form-control" placeholder="Password">
											<small class="has-warning">사이즈 : 900*1350 / 최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG 파일</small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="demo-password-input"></label>
										<div class="col-md-9">
											<div class="alert alert-warning media fade in">
												<div class="media-left">
													<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
														<i class="fa fa-bolt fa-lg"></i>
													</span>
												</div>
												<div class="media-body">
													<p class="alert-title">표지를 직접 등록할 때, 이미지 사이즈와 확장자가 정확 해야만 등록이 됩니다.</p>
													<p class="alert-title">저작권을 분쟁의 소지가 있는 이미지는 사용하실 수 없습니다. 저작권 관련 문제 발생 시, 모든 책임은 개인에게 있습니다.</p>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-12 text-center">
											<button class="btn btn-lg btn-primary">작품저장</button>
											<button class="btn btn-lg btn-danger">취소</button>
										</div>
									</div>
								</form>
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