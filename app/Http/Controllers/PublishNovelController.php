<?php

namespace App\Http\Controllers;

use App\Mailbox;
use App\MailLog;
use App\PublishNovel;
use App\Novel;
use Illuminate\Http\Request;
use PHPePub\Core\EPub;
use PHPePub\Core\Logger;
use PHPePub\Core\Structure\OPF\DublinCore;
use PHPePub\Helpers\CalibreHelper;
use PHPePub\Helpers\IBooksHelper;
use PHPePub\Helpers\Rendition\RenditionHelper;
use PHPePub\Helpers\URLHelper;
use PHPZip\Zip\File\Zip;

class PublishNovelController extends Controller
{
    public function store(Request $request)
    {
        //store publish novel
        PublishNovel::create($request->all());
        return response()->json(['status' => 'ok']);
    }


    public function update(Request $request, $id)
    {
        $publish_novel = PublishNovel::find($id);
        $publish_novel->status = $request->status;
        if ($request->deny_reason) {
            //if deny_reason exists
            $publish_novel->reject_reason = $request->deny_reason;

            //mails
            $mailbox = new Mailbox();
            $mailbox->subject = $publish_novel->publish_novel_groups->novel_groups->title .
                "의 " . $publish_novel->novels->inning . "화 가 연재 거부 됐습니다";
            $mailbox->body = $publish_novel->publish_novel_groups->novel_groups->title .
                "의 " . $publish_novel->novels->inning . "화 " . $publish_novel->novels->title . "가 연재 거부 됐습니다.\n"
                . "거부 사유 \n" . $publish_novel->reject_reason;
            $mailbox->from = 1;
            $mailbox->save();

            $maillog = new MailLog();
            $maillog->user_id = $publish_novel->publish_novel_groups->user_id;
            $maillog->mailbox_id = $mailbox->id;
            $maillog->save();

        }


        $publish_novel->save();
        return response()->json(['data' => $request->status, 'status' => 'ok']);
    }

    public function update_status(Request $request)
    {
        PublishNovel::where('id', $request->publish_novel_id)->update([
            'status' => $request->status
        ]);
        return response()->json(['status' => 'ok']);
    }

    public function destroy($id)
    {
        PublishNovel::destroy($id);
        return response()->json(['status' => 'ok']);
    }

    public function e_pub($id)
    {
        $novel = Novel::where('id', $id)->with('novel_groups.users')->first();


        $log = new Logger("Example", TRUE);
        //$fileDir = './PHPePub';
        $fileDir = public_path() . '/epub/';
        // dd($fileDir);
        // ePub 3 is not fully implemented. but aspects of it is, in order to help implementers.
        // ePub 3 uses HTML5, formatted strictly as if it was XHTML but still using just the HTML5 doctype (aka XHTML5)
        $book = new EPub(EPub::BOOK_VERSION_EPUB3, "en", EPub::DIRECTION_LEFT_TO_RIGHT); // Default is ePub 2
        $log->logLine("new EPub()");
        $log->logLine("EPub class version.: " . EPub::VERSION);
        $log->logLine("Zip version........: " . Zip::VERSION);
        $log->logLine("getCurrentServerURL: " . URLHelper::getCurrentServerURL());
        $log->logLine("getCurrentPageURL..: " . URLHelper::getCurrentPageURL());
        // Title and Identifier are mandatory!
        $book->setTitle('WWE');
        $book->setIdentifier("http://JohnJaneDoePublications.com/books/TestBookEPub3.xhtml", EPub::IDENTIFIER_URI); // Could also be the ISBN number, preferred for published books, or a UUID.
        $book->setLanguage("kr"); // Not needed, but included for the example, Language is mandatory, but EPub defaults to "en". Use RFC3066 Language codes, such as "en", "da", "fr" etc.
        $book->setDescription("This is a brief description\nA test ePub book as an example of building a book in PHP");
        $book->setAuthor($novel->novel_groups->users->name, "Johnson, John Doe");
        $book->setPublisher("Novels Publications", "http://novelsPublications.com/"); // I hope this is a non existent address :)
        $book->setDate(time()); // Strictly not needed as the book date defaults to time().
        $book->setRights("Copyright and licence information specific for the book."); // As this is generated, this _could_ contain the name or licence information of the user who purchased the book, if needed. If this is used that way, the identifier must also be made unique for the book.
        $book->setSourceURL("http://JohnJaneDoePublications.com/books/TestBookEPub3.xhtml");
        $book->addDublinCoreMetadata(DublinCore::CONTRIBUTOR, "PHP");
        $book->setSubject("Novel Book");
        $book->setSubject("keywords");
        $book->setSubject("Chapter levels");
        // Insert custom meta data to the book, in this case, Calibre series index information.
        CalibreHelper::setCalibreMetadata($book, "PHPePub Test books", "3");
        // FIXED-LAYOUT METADATA (ONLY AVAILABLE IN EPUB3)
        RenditionHelper::addPrefix($book);
        RenditionHelper::setLayout($book, RenditionHelper::LAYOUT_PRE_PAGINATED);
        RenditionHelper::setOrientation($book, RenditionHelper::ORIENTATION_AUTO);
        RenditionHelper::setSpread($book, RenditionHelper::SPREAD_AUTO);
        // Setting rendition parameters for fixed layout requires the user to add a viewport to each html file.
        // It is up to the user to do this, however the cover image and toc files are generated by the EPub class, and need the information.
        // It can be set multiple times if different viewports are needed for the cover image page and toc.
        $book->setViewport("720p");
        IBooksHelper::addPrefix($book);
        IBooksHelper::setIPadOrientationLock($book, IBooksHelper::ORIENTATION_PORTRAIT_ONLY);
        IBooksHelper::setIPhoneOrientationLock($book, IBooksHelper::ORIENTATION_PORTRAIT_ONLY);
        IBooksHelper::setSpecifiedFonts($book, true);
        IBooksHelper::setFixedLayout($book, true);
        $log->logLine("Set up parameters");
        // Example.
        // Create a test book for download.
        // ePub 3 uses a variant of HTML5 called XHTML5
        $content_start =
            "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
            . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:epub=\"http://www.idpf.org/2007/ops\">\n"
            . "\t<head>"
            . "\t\t<meta http-equiv=\"Default-Style\" content=\"text/html; charset=utf-8\" />\n"
            . $book->getViewportMetaLine() // generate the viewport meta line if the viewport is set.
            . "\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" />\n"
            . "\t\t<title>Novel Book</title>\n"
            . "\t</head>\n"
            . "\t<body>\n";
        $bookEnd = "\t</body>\n</html>\n";
        $cssData = "body {\n  margin-left: .5em;\n  margin-right: .5em;\n  text-align: justify;\n}\n\np {\n  font-family: serif;\n  font-size: 10pt;\n  text-align: justify;\n  text-indent: 1em;\n  margin-top: 0px;\n  margin-bottom: 1ex;\n}\n\nh1, h2 {\n  font-family: sans-serif;\n  font-style: italic;\n  text-align: center;\n  background-color: green;\n  color: white;\n  width: 100%;\n}\n\nh1 {\n    margin-bottom: 2px;\n}\n\nh2 {\n    margin-top: -2px;\n    margin-bottom: 2px;\n}\n";
        $log->logLine("Add css");
        $book->addCSSFile("styles.css", "css1", $cssData);
        // This test requires you have an image, change "demo/cover-image.jpg" to match your location.
        $log->logLine("Add Cover Image");
       // $book->setCoverImage("Cover.jpg", file_get_contents("img/novel_covers/3cover_photo.jpg"), "image/jpeg");
        // A better way is to let EPub handle the image itself, as it may need resizing. Most e-books are only about 600x800
        //  pixels, adding mega-pixel images is a waste of place and spends bandwidth. setCoverImage can resize the image.
        //  When using this method, the given image path must be the absolute path from the servers Document root.
         $book->setCoverImage(public_path()."/img/novel_covers/3cover_photo.jpg");
        // setCoverImage can only be called once per book, but can be called at any point in the book creation.
        $log->logLine("Set Cover Image");
        $cover = $content_start . "<h1>Novel Inning</h1>\n<h2>By:". $book->getAuthor(). "</h2>\n" . $bookEnd;
        $book->addChapter("Table of Contents", "TOC.xhtml", NULL, false, EPub::EXTERNAL_REF_IGNORE);
        $book->addChapter("Notices", "Cover.xhtml", $cover);


        $chapter1 = $content_start . "<h1>Chapter 1</h1>\n"
            . "<h2>".$novel->title."</h2>\n"
            . "<p>".$novel->content."</p>"
            . "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec magna lorem, mattis sit amet porta vitae, consectetur ut eros. Nullam id mattis lacus. In eget neque magna, congue imperdiet nulla. Aenean erat lacus, imperdiet a adipiscing non, dignissim eget felis. Nulla facilisi. Vivamus sit amet lorem eget mauris dictum pharetra. In mauris nulla, placerat a accumsan ac, mollis sit amet ligula. Donec eget facilisis dui. Cras elit quam, imperdiet at malesuada vitae, luctus id orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque eu libero in leo ultrices tristique. Etiam quis ornare massa. Donec in velit leo. Sed eu ante tortor.</p>\n"
            . "<p><img src=\"http://www.grandt.com/ePub/AnotherHappilyMarriedCouple.jpg\" alt=\"Test Image retrieved off the internet: Another happily married couple\" />Nullam at tempus enim. Nunc et augue non lectus consequat rhoncus ac a odio. Morbi et tellus eget nisi volutpat tincidunt. Curabitur tristique neque tincidunt purus blandit bibendum. Maecenas eleifend sem quis magna semper id pulvinar nisi porttitor. In in lectus accumsan eros tristique pharetra sit amet ac nulla. Nam vitae felis et orci congue porta nec non ipsum. Donec pretium blandit accumsan. In aliquam lacinia nisi, ut venenatis mauris condimentum ut. Morbi rutrum orci et nisl accumsan euismod. Etiam viverra luctus sem pellentesque suscipit. Aliquam ultricies egestas risus at eleifend. Ut lacinia, tortor non varius malesuada, massa diam aliquet augue, vitae tempor metus tellus eget diam. Nulla vel augue eu elit adipiscing egestas. Duis et nulla est, ac congue arcu. Phasellus semper, ipsum et blandit rutrum, erat ante semper quam, at iaculis quam tellus sed neque.</p>\n"
            . "<p>Pellentesque vulputate sollicitudin justo, at faucibus nisl convallis in. Nulla facilisi. Curabitur nec mauris eu justo ultricies ultricies gravida eu ipsum. Pellentesque at nunc velit, vitae congue nisl. Nam varius imperdiet leo eu accumsan. Nullam elementum fermentum diam euismod porttitor. Etiam sed pellentesque ante. Donec in est elementum mi tempor consectetur. Fusce orci lorem, mollis at tincidunt eget, fringilla sed nunc. Ut consectetur condimentum condimentum. Phasellus sed felis non massa gravida euismod ut in tellus. Curabitur suscipit pharetra sapien vitae dignissim. Morbi id arcu nec ante viverra lobortis vitae nec quam. Mauris id gravida odio. Nunc non sem nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque hendrerit volutpat nisl id elementum. Vivamus lobortis iaculis nisi, sit amet tristique risus porttitor vel. Suspendisse potenti.</p>\n"
            . "<p>Quisque aliquet sapien leo, vitae eleifend dolor. Fusce quis tincidunt nunc. Nam nec purus nulla, ac eleifend lorem. Curabitur eu quam et nibh egestas mattis. Maecenas eget felis augue. Integer scelerisque commodo urna, a pulvinar tortor euismod et. Praesent in nunc sapien. Ut iaculis auctor neque, sit amet rutrum est faucibus vitae. Sed a sagittis quam. Quisque interdum luctus fringilla. Vestibulum vitae nunc in felis luctus ultricies at id magna. Nam volutpat sapien ac lorem interdum pellentesque. Suspendisse faucibus, leo vitae laoreet interdum, mi mi pulvinar neque, sit amet tristique sapien nulla nec dolor. Etiam non ligula augue.</p>\n"
            . "<p>Vivamus purus elit, ornare eget accumsan ut, luctus et orci. Sed vestibulum turpis ut quam vehicula id hendrerit velit suscipit. Pellentesque pulvinar, libero vitae sagittis scelerisque, felis ante faucibus risus, ut viverra velit mi at tortor. Aliquam lacinia condimentum felis, eu elementum ligula laoreet vitae. Sed placerat tempus turpis a fringilla. Etiam porta accumsan feugiat. Phasellus et cursus magna. Suspendisse vitae odio sit amet urna vulputate consectetur. Vestibulum massa magna, sagittis at dictum vitae, sagittis scelerisque erat. Donec viverra tincidunt lacus. Maecenas fermentum erat et mauris tincidunt sed eleifend quam tempus. In at augue mi, in tincidunt arcu. Duis dapibus aliquet mi, ac ullamcorper est semper quis. Sed nec nulla nec odio malesuada viverra id sed nulla. Donec lobortis euismod aliquam. Praesent sit amet dolor quis lacus auctor lobortis. In hac habitasse platea dictumst. Sed at nisi sed nisi ullamcorper pellentesque. Vivamus eget enim sem, non laoreet leo. Sed vel odio lacus.</p>\n"
            . $bookEnd;

        $log->logLine("Build Chapters");

        $log->logLine("Add Chapter 1");
        $book->addChapter("Chapter 1:".$novel->title, "Chapter001.xhtml", $chapter1, true, EPub::EXTERNAL_REF_ADD);

        $log->logLine("Add TOC");
        $book->buildTOC();
        $book->addChapter("Log", "Log.xhtml", $content_start . $log->getLog() . "\n</pre>" . $bookEnd);
        if ($book->isLogging) { // Only used in case we need to debug EPub.php.
            $epuplog = $book->getLog();
            $book->addChapter("ePubLog", "ePubLog.xhtml", $content_start . $epuplog . "\n</pre>" . $bookEnd);
        }


        $book->finalize(); // Finalize the book, and build the archive.

        //save book
        //$book->saveBook('novel11', '.');
        // Send the book to the client. ".epub" will be appended if missing.
        $zipData = $book->sendBook("Novel");

        //Alternate code to Download eBook
        /* $filename = 'novel11.epub';
         header('Content-type: application/epub+zip');
         header('Content-disposition:attachment;filename='.$filename);
         header('Content-Transfer-Encoding: binary');
         readfile($filename);*/

        return response()->json('ok');

    }
}
