@extends('../layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 구슬충전 -->
                <div class="box-header">
                    <h2 class="title">구슬이란?</h2>
                    <p class="title-desc">여우정원의 모든 로맨스 소설을 감상할 수 있는 결제수단입니다.<br>지금 여우정원에서 구슬을 충전하여 로맨틱한 컨텐츠를 즐겨보세요.</p>
                </div>
                <div class="my-item">
                    <i class="marble3-icon"></i><span class="item-name">내가 가진 구슬</span><strong class="count">1,170
                        개</strong>
                </div>
                <!-- //구슬충전 -->
                <!-- 충전선택,결제 -->
                <form name="charge_form" action="#" class="charge-form">
                    <div class="charge-wrap charge-wrap--special">
                        <h3 class="charge-title charge-title--special">당신에게만 보이는 특별한 혜택 - <b>첫 구매시 추가 조각 5배 증정!</b></h3>
                        <ul class="charge-list">
                            <li>
                                <label class="checkbox2"><input type="radio" name="marble"><span>구슬 100개 + <b>조각 15개</b></span></label>
                                <span class="price">10,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="marble" checked><span>구슬 300개 + <b>조각 75개</b></span></label>
                                <span class="price">30,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio"
                                                                name="marble"><span>구슬 500개 + <b>조각 175개</b></span></label>
                                <span class="price">50,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio"
                                                                name="marble"><span>구슬 1,000개 + <b>조각 495개</b></span></label>
                                <span class="price">100,000원</span>
                            </li>
                        </ul>
                    </div>
                    <div class="charge-wrap">
                        <h3 class="charge-title">구슬패키지</h3>
                        <ul class="charge-list">
                            <li>
                                <label class="checkbox2"><input type="radio" name="marble"><span>구슬 10개</span></label>
                                <span class="price">1,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="marble"><span>구슬 30개</span></label>
                                <span class="price">3,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="marble"><span>구슬 50개</span></label>
                                <span class="price">5,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="marble"><span>구슬 100개 + <b>조각 3개</b></span></label>
                                <span class="price">10,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="marble"><span>구슬 300개 + <b>조각 15개</b></span></label>
                                <span class="price">30,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="marble"><span>구슬 500개 + <b>조각 35개</b></span></label>
                                <span class="price">50,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio"
                                                                name="marble"><span>구슬 1,000개 + <b>조각 99개</b></span></label>
                                <span class="price">100,000원</span>
                            </li>
                        </ul>
                    </div>
                    <div class="payment-option">
                        <h3 class="payment-title">결제수단선택</h3>
                        <ul class="payment-list">
                            <li><label class="checkbox2"><input type="radio" name="payment"><span>신용카드</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span>휴대폰</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span>유선전화</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span>가상계좌</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span>무통장입금</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio"
                                                                name="payment"><span>컬쳐랜드문화상품권</span></label></li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span>도서문화상품권</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span>해피머니</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span>해외신용카드</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span><i
                                                class="naverpay-icon">Naver Pay</i></span></label></li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span><i
                                                class="kakaopay-icon">Kakao Pay</i></span></label></li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span><i
                                                class="tmoney-icon">T money</i></span></label></li>
                        </ul>
                    </div>
                    <div class="submit">
                        <div class="btn btn--special">구슬충전</div>
                    </div>
                </form>
                <!-- //충전선택,결제 -->
                <!-- 공지 -->
                <p class="mypage-notice">
                    처음 구매자용 구슬패키지는 일부 구슬과 조각을 사용 시 결제를 취소할 수 없습니다.<br>
                    구슬은 마지막 이용일로부터 5년 경과 시까지 이용내역이 없을 경우, &lt;상법 제64조 상사채권 소멸시효&gt;조항에 따라 소멸됩니다.<br>
                    일부를 사용한 구슬은 환불 가능하며 환불 시 무료로 지급받은 조각 및 환불수수료 10%를 공제하고 남은 금액을 환불해 드립니다<br>
                    단, 네이버페이로 결제한 경우는 환불에서 제외됩니다.
                </p>
                <!-- //공지 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->

        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->
@endsection