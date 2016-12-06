@extends('layouts.app')

@section('content')
<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">

				<!--Page Title-->
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<div id="page-title">
					<h1 class="page-header text-overflow">
						<span class="label label-normal label-info">Family</span>
						{{$mailbox_message->subject}}
					</h1>

					<!--Searchbox-->
					<div class="searchbox">
						<div class="input-group custom-search-form">
							<input type="text" class="form-control" placeholder="Search..">
							<span class="input-group-btn">
								<button class="text-muted" type="button"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
				</div>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End page title-->

				<!--Page content-->
				<!--===================================================-->
				<div id="page-content">

									<!-- VIEW MESSAGE -->
									<!--===================================================-->
									<div class="panel panel-default panel-left">
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-7">

													<!--Sender Information-->
													<div class="media">
														<span class="media-left">
															<img src="img/av4.png" class="img-circle img-sm" alt="Profile Picture">
														</span>
														<div class="media-body">
															<div class="text-bold">@if($mailbox_message->users) {{ $mailbox_message->users->name }} @endif</div>
															<small class="text-muted">{{ $mailbox_message->from}}</small>
														</div>
													</div>
												</div>
												<hr class="hr-sm visible-xs">
												<div class="col-sm-5 clearfix">

													<!--Details Information-->
													<div class="pull-right text-right">
														<p class="mar-no"><small class="text-muted">{{ $mailbox_message->created_at}}</small></p>
														<a href="#">
															<strong>Holiday.zip</strong>
															<i class="fa fa-paperclip fa-lg fa-fw"></i>
														</a>
													</div>
												</div>
											</div>
											<div class="row pad-ver">
												<div class="col-xs-7">

													<!--Mail toolbar-->
													<button class="btn btn-default"><i class="fa fa-print"></i></button>
													<div class="btn-group btn-group">
														<button class="btn btn-default"><i class="fa fa-exclamation-circle"></i></button>
														<button class="btn btn-default"><i class="fa fa-trash"></i></button>
													</div>
												</div>
												<div class="col-xs-5 clearfix">
													<div class="pull-right">

														<!--Reply & forward buttons-->
														<div class="btn-group btn-group">
															<a class="btn btn-default" href="#">
															<i class="fa fa-reply"></i>
															</a>
															<a class="btn btn-default" href="#">
															<i class="fa fa-share"></i>
															</a>
														</div>
													</div>
												</div>
											</div>

											<!--Message-->
											<!--===================================================-->
											<div class="pad-all bord-all bg-gray-light">
                                                {{ $mailbox_message->body}}
											</div>
											<!--===================================================-->
											<!--End Message-->

											<!-- Attach Files-->
											<!--===================================================-->
											<div class="pad-ver">
												<h4><i class="fa fa-paperclip fa-fw"></i> Attachments <span>(2)</span></h4>

												<ul class="mail-attach-list list-ov">
													<li class=" clearfix">

														<!--Download button-->
														<div class="mail-attach-btn"><a href="#" class="btn btn-purple btn-sm">Download</a></div>

														<!--File information-->
														<div class="mail-attach-file">
															<span class="mail-attach-label">
																<span class="label label-info text-uppercase">Images</span>
															</span>
															<div class="media-body">
																<div class="text-bold"><a href="#">IMG_007.jpg</a></div>
																<small class="text-muted">(15 KB)</small>
															</div>
														</div>
													</li>
													<li class="clearfix">

														<!--Download button-->
														<div class="mail-attach-btn"><a href="#" class="btn btn-purple btn-sm">Download</a></div>

														<!--File information-->
														<div class="mail-attach-file">
															<span class="mail-attach-label">
																<span class="label label-warning  text-uppercase">Video</span>
															</span>
															<div class="media-body">
																<div class="text-bold"><a href="#">VID_007.mp4</a></div>
																<small class="text-muted">(178 MB)</small>
															</div>
														</div>
													</li>
												</ul>
											</div>
											<!--===================================================-->
											<!-- End Attach Files-->


											<!--Quick reply : Summernote Placeholder -->
											<div id="demo-mail-textarea" class="mail-message-reply bg-gray-light">
												<strong>Reply</strong> or <strong>Forward</strong> this message...
											</div>

											<!--Send button-->
											<div class="pad-ver">
												<button id="demo-mail-send-btn" type="button" class="btn btn-primary hide">
													<span class="fa fa-paper-plane"></span>
													Send Message
												</button>
											</div>
										</div>
									</div>
									<!--===================================================-->
									<!-- END VIEW MESSAGE -->


				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
@endsection