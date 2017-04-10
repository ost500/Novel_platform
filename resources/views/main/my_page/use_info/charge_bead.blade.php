@extends('../layouts.main_layout')
@section('content')

    <script type="text/javascript">
        function LPad(digit, size, attatch) {
            var add = "";
            digit = digit.toString();

            if (digit.length < size) {
                var len = size - digit.length;
                for (i = 0; i < len; i++) {
                    add += attatch;
                }
            }
            return add + digit;
        }

        function makeoid() {
            var now = new Date();
            var years = now.getFullYear();
            var months = LPad(now.getMonth() + 1, 2, "0");
            var dates = LPad(now.getDate(), 2, "0");
            var hours = LPad(now.getHours(), 2, "0");
            var minutes = LPad(now.getMinutes(), 2, "0");
            var seconds = LPad(now.getSeconds(), 2, "0");
            var timeValue = years + months + dates + hours + minutes + seconds;
            document.getElementById("LGD_OID").value = "test_" + timeValue;
            document.getElementById("LGD_TIMESTAMP").value = timeValue;
        }

        /*
         * 인증요청 처리
         */
        function doPay() {
            // OID, TIMESTAMP 생성
            makeoid();
            // 결제창 호출
            document.getElementById("LGD_PAYINFO").submit();
            alert('hi');
        }
    </script>

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
                    <i class="marble3-icon"></i><span class="item-name">내가 가진 구슬</span><strong class="count">{{Auth::user()->bead}}
                        개</strong>
                </div>
                <!-- //구슬충전 -->
                <!-- 충전선택,결제 -->
                <form name="charge_form" id="LGD_PAYINFO" method="post" action="{{ route('payment') }}" class="charge-form">
                    {!! csrf_field() !!}
                    <div class="charge-wrap charge-wrap--special">
                        <h3 class="charge-title charge-title--special">당신에게만 보이는 특별한 혜택 - <b>첫 구매시 추가 조각 5배 증정!</b></h3>
                        <ul class="charge-list">
                            <li>
                                <label class="checkbox2"><input type="radio" id="won1" onclick="price(10000)"
                                                                name="LGD_PRODUCTINFO"
                                                                value="구슬 100개 + 조각 15개"><span>구슬 100개 + <b>조각 15개</b></span></label>
                                <span class="price">10,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="LGD_PRODUCTINFO"
                                                                onclick="price(30000)"
                                                                value="구슬 300개 + 조각 75개"><span>구슬 300개 + <b>조각 75개</b></span></label>
                                <span class="price">30,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" onclick="price(50000)"
                                                                name="LGD_PRODUCTINFO" value="구슬 500개 + 조각 175개"><span>구슬 500개 + <b>조각 175개</b></span></label>
                                <span class="price">50,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" onclick="price(100000)"
                                                                name="LGD_PRODUCTINFO"
                                                                value="구슬 1,000개 + 조각 495개"><span>구슬 1,000개 + <b>조각 495개</b></span></label>
                                <span class="price">100,000원</span>
                            </li>
                        </ul>
                    </div>
                    <div class="charge-wrap">
                        <h3 class="charge-title">구슬패키지</h3>
                        <ul class="charge-list">
                            <li>
                                <label class="checkbox2"><input type="radio" name="LGD_PRODUCTINFO"
                                                                onclick="price(1000)"
                                                                value="구슬 10개"><span>구슬 10개</span></label>
                                <span class="price">1,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="LGD_PRODUCTINFO"
                                                                onclick="price(3000)"
                                                                value="구슬 30개"><span>구슬 30개</span></label>
                                <span class="price">3,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="LGD_PRODUCTINFO"
                                                                onclick="price(5000)"
                                                                value="구슬 50개"><span>구슬 50개</span></label>
                                <span class="price">5,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="LGD_PRODUCTINFO"
                                                                onclick="price(10000)"
                                                                value="구슬 100개 + 조각 3개"><span>구슬 100개 + <b>조각 3개</b></span></label>
                                <span class="price">10,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="LGD_PRODUCTINFO"
                                                                onclick="price(30000)"
                                                                value="구슬 300개 + 조각 15개"><span>구슬 300개 + <b>조각 15개</b></span></label>
                                <span class="price">30,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" name="LGD_PRODUCTINFO"
                                                                onclick="price(50000)"
                                                                value="구슬 500개 + 조각 35개"><span>구슬 500개 + <b>조각 35개</b></span></label>
                                <span class="price">50,000원</span>
                            </li>
                            <li>
                                <label class="checkbox2"><input type="radio" onclick="price(100000)"
                                                                name="LGD_PRODUCTINFO" value="구슬 1,000개 + 조각 99개"><span>구슬 1,000개 + <b>조각 99개</b></span></label>
                                <span class="price">100,000원</span>
                            </li>
                        </ul>
                    </div>

                    <div hidden class="payment-option">
                        <h3 class="payment-title">이메일</h3>
                        <ul class="payment-list">
                            <input type="text" name="LGD_BUYEREMAIL" id="gift_marble" size="25"
                                   value="{{ $user->email }}">

                        </ul>
                    </div>
                    <div hidden class="payment-option">
                        <h3 class="payment-title">이름</h3>
                        <ul class="payment-list">
                            <input type="text" name="LGD_BUYER" id="gift_marble" size="25">

                        </ul>
                    </div>

                    <div class="payment-option">
                        <h3 class="payment-title">결제수단선택</h3>
                        <ul class="payment-list">
                            <li><label class="checkbox2"><input type="radio" value="SC0010" name="LGD_CUSTOM_USABLEPAY"><span>신용카드</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" value="SC0060" name="LGD_CUSTOM_USABLEPAY"><span>휴대폰</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" value="SC0070" name="LGD_CUSTOM_USABLEPAY"><span>유선전화</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" value="SC0030" name="LGD_CUSTOM_USABLEPAY"><span>계좌이체</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" value="SC0040" name="LGD_CUSTOM_USABLEPAY"><span>무통장입금</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio"
                            name="LGD_CUSTOM_USABLEPAY"><span>컬쳐랜드문화상품권</span></label></li>
                            <li><label class="checkbox2"><input type="radio" value="SC0111" name="LGD_CUSTOM_USABLEPAY"><span>문화상품권</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" name="LGD_CUSTOM_USABLEPAY"><span>해피머니</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" value="SC0010" name="LGD_CUSTOM_USABLEPAY"><span>신용카드</span></label>
                            </li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span><i
                            class="naverpay-icon">Naver Pay</i></span></label></li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span><i
                            class="kakaopay-icon">Kakao Pay</i></span></label></li>
                            <li><label class="checkbox2"><input type="radio" name="payment"><span><i
                            class="tmoney-icon">T money</i></span></label></li>
                        </ul>
                    </div>


                    {{--가격--}}
                    <input hidden type="text" name="LGD_AMOUNT" id="LGD_AMOUNT" value="50000">

                    <input hidden type="text" name="CST_MID" id="CST_MID" value="soulaim">
                    <input hidden type="text" name="CST_PLATFORM" id="CST_PLATFORM" value="test">


                    {{--주문번호--}}
                    <input hidden type="text" name="LGD_OID" id="LGD_OID" value="test_1234567890020">
                    <input hidden type="text" name="LGD_TIMESTAMP" id="LGD_TIMESTAMP" value="1234567890">
                    <select hidden name="LGD_WINDOW_TYPE" id="LGD_WINDOW_TYPE">
                        <option value="iframe">iframe</option>
                    </select>
                    <select hidden name="LGD_CUSTOM_SWITCHINGTYPE" id="LGD_CUSTOM_SWITCHINGTYPE">
                        <option value="IFRAME">IFRAME</option>
                    </select>
                    <div class="submit">
                        <button type="button" class="btn btn--special" onclick="doPay();">구슬충전</button>
                    </div>

                    <script>
                        function price(p) {

                            $("#LGD_AMOUNT").val(p);
                        }
                    </script>


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