
// Mail.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -



 $(document).on('ready', function() {



	// MAILBOX-COMPOSE.HTML
	// =================================================================

	if ($('#demo-mails-compose').length) {


		// SUMMERNOTE
		// =================================================================
		// Require Summernote
		// http://hackerwins.github.io/summernote/
		// =================================================================
		$('#demo-mails-compose').summernote({
			height:500
		});


		// Show The CC Input Field
		// =================================================================
		$('#demo-toggle-cc').on('click', function(){
			$('#demo-cc-input').toggleClass('hide');
		});



		// Show The BCC Input Field
		// =================================================================
		$('#demo-toggle-bcc').on('click', function(){
			$('#demo-bcc-input').toggleClass('hide');
		});



		// Attachment button.
		// =================================================================
		$('.btn-file :file').on('fileselect', function(event, numFiles, label, fileSize) {
			$('#demo-attach-file').html('<strong class="box-block text-capitalize"><i class="fa fa-paperclip fa-fw"></i> '+label+'</strong><small class="text-muted">'+fileSize+'</small>');
		});


		return;
	}





	// MAILBOX-MESSAGE.HTML
	// =================================================================

	// SUMMERNOTE
	// =================================================================
	// Require Summernote
	// http://hackerwins.github.io/summernote/
	// =================================================================
	if( $('#demo-mails-textarea').length ){
		$('#demo-mails-textarea').on('click', function(){
			$(this).empty().summernote({
			height:300,
			focus: true
			});
			$('#demo-mails-send-btn').removeClass('hide');
		});
		return;
	}





	// MAILBOX.HTML
	// =================================================================
	var mSelAllCb 	= $('#demo-checked-all-mails').find('.form-checkbox');
	var mListCb 	= $('.demo-cb-mails');
	var mReadCb 	= $('#demo-mails-list').find('li:not(.mails-list-unread)');
	var mUnreadCb 	= $('#demo-mails-list').find('.mail-list-unread');
	var mStarBtn 	= $('#demo-mails-list').find('.mails-star a');


	// Select / deselect all checkboxes.
	// =================================================================
	$('#demo-checked-all-mails').on('click', function(e){
		if(!mSelAllCb.niftyCheck('isChecked')){
			mListCb.niftyCheck('toggleOn');
			mSelAllCb.niftyCheck('toggleOn');
		}else{
			mListCb.niftyCheck('toggleOff');
			mSelAllCb.niftyCheck('toggleOff');
		}
	});


	// Sellect all checkboxes.
	// =================================================================
	$('#demo-select-all-list').on('click', function(e){
		mListCb.niftyCheck('toggleOn');
		mSelAllCb.niftyCheck('toggleOn');
	});


	// Toggle checkboxes.
	// =================================================================
	$('#demo-select-toggle-list').on('click', function(e){
		mListCb.niftyCheck('toggle');
	});


	// Uncheck all checkboxes.
	// =================================================================
	$('#demo-select-none-list').on('click', function(e){
		mListCb.niftyCheck('toggleOff');
		mSelAllCb.niftyCheck('toggleOff');
	});


	// Check on all the messages that have been read.
	// =================================================================
	$('#demo-select-read-list').on('click', function(e){
		mListCb.niftyCheck('toggleOff');
		mReadCb.niftyCheck('toggleOn');
	});


	// Checks on all unread messages.
	// =================================================================
	$('#demo-select-unread-list').on('click', function(e){
		mListCb.niftyCheck('toggleOff');
		mUnreadCb.niftyCheck('toggleOn');
	});


	// Check on all the messages that have been starred.
	// =================================================================
	$('#demo-select-starred-list').on('click', function(e){
		mListCb.niftyCheck('toggleOff');
		$('#demo-mails-list').find('.mails-starred .demo-cb-mails').niftyCheck('toggleOn');
	});


	//  Toggle the star on/off.
	// =================================================================
	mStarBtn.on('click', function(e){
		e.preventDefault();

		$(this).closest('li').toggleClass('mail-starred');
	});


	// highlight the message.
	// =================================================================
	mListCb.on('nifty.ch.checked', function(){
		$(this).parents('li').addClass('highlight');
	}).on('nifty.ch.unchecked', function(){
		$(this).closest('li').removeClass('highlight');
	});


	// Loading overlay.
	// =================================================================
	$('#demo-mails-ref-btn').niftyOverlay().on('click', function(){
		var $el = $(this), relTime;

		$el.niftyOverlay('show');
		relTime = setInterval(function(){
			$el.niftyOverlay('hide');
			clearInterval(relTime);
		},2500);
	});


 });

