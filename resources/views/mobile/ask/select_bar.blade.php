<div class="sel2_wrap" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <select class="sel_198">
        <option value="">고객센터</option>
        <option value="고객센터">고객센터</option>
    </select>

    <select class="sel_346 marL8" id="servicesSelect" v-on:change="callUrl()">
        <option value="자주 묻는 질문" @if(Request::is('m/customer/frequently_asked_questions') || Request::is('m/customer/frequently_asked_questions/*')) selected @endif>자주 묻는 질문</option>
        <option value="1:1문의" @if(Request::is('m/customer/ask_question')|| Request::is('m/customer/questions') || Request::is('m/customer/ask_question/*')) selected @endif >1:1문의</option>
        <option value="공지사항" @if(Request::is('m/customer/notifications') || Request::is('m/customer/notifications/*')) selected @endif >공지사항</option>
    </select>

</div>

