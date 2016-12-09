@extends('layouts.admin_layout')

@section('content')


	<div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

		<div id="page-title">
			<h1 class="page-header text-overflow">쪽지함</h1>
		</div>


		<ol class="breadcrumb">
			<li><a href="#">어드민</a></li>
			<li class="active"><a href="#">쪽지함</a></li>
		</ol>

		<div id="page-content">

			<!-- VIEW MESSAGE -->
			<!--===================================================-->
			<div class="panel panel-default panel-left">
				<div class="panel-body">
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
						{{ $memo->body}}
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


		</div>


	</div>
@endsection