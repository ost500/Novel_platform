 <!-- LNB -->
        <div class="lnb">
            <nav>
                <h2 class="lnb-title">쪽지</h2>
                <ul class="lnb-depth1">
                    <li>
                        <a href="{{route('mails.received')}}" class="{{Request::is('mails/received')?"is-active":""}}">받은쪽지함</a>
                    </li>
                    <li>
                        <a href="{{route('mails.sent')}}" class="{{Request::is('mails/sent')?"is-active":""}}">보낸쪽지함</a>
                    </li>
                    <li>
                        <a href="{{route('mails.my_box')}}" class="{{Request::is('mails/my_box')?"is-active":""}}"> 보관쪽지함 </a>
                    </li>
                    <li>
                        <a href="{{route('mails.spam')}}" class="{{Request::is('mails/spam')?"is-active":""}}" >스팸쪽지함</a>
                    </li>
                    <li>
                        <a href="{{route('mails.create')}}" class="{{Request::is('mails/create') || Request::is('mails/create/*')?"is-active":""}}" >쪽지보내기</a>
                    </li>

                </ul>
            </nav>
        </div>
        <!-- //LNB -->