<!-- LNB -->
<div class="lnb">
    <nav>
        <h2 class="lnb-title">고객센터</h2>
        <ul class="lnb-depth1">
            <li>
                <a href="{{route('ask.faqs').'?best'}}"
                   class="{{Request::is('frequently_asked_questions')|| Request::is('faq_detail/*')?"is-active":""}}">자주
                    묻는 질문</a>
            </li>
            <li>
                <a href="{{route('ask.ask_question')}}"
                   class="{{Request::is('questions')||Request::is('ask_question')|| Request::is('question_detail/*')?"is-active":""}}">1:1
                    문의</a>
            </li>
            <li>
                <a href="#">이용방법</a>
            </li>
            <li>
                <a href="{{route('ask.notifications')}}"
                   class="{{Request::is('notifications') || Request::is('notification_detail/*')?"is-active":""}}">공지사항</a>
            </li>
        </ul>
    </nav>
</div>
<!-- //LNB -->