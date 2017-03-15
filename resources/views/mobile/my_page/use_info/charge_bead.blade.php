@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <!-- 안내 문구 -->
        <div class="alert_box2">
            <div class="alert_b2_tit">구슬이란?</div>
            여우정원의 모든 로맨스 소설을 감상할 수 있는 결제수단입니다. 지금 여우정원에서 구슬을 충전하여 로맨틱한 컨텐츠를 즐겨보세요.
        </div>
        <!-- 안내 문구 //-->


        <div class="mlist_tit_rwap4">
            <div class="marble_ico_tit">내가 가진 구슬<span class="marble_num marL8">1,170개</span></div>
        </div>

        <!-- 안내 문구 -->
        <div class="alert_box3 talC">
            <div class="bro22">당신에게만 보이는 특별한 혜택</div>
            <div class="red26 padt10">첫 구매시 추가 조각 5배 증정!</div>
        </div>
        <!-- 안내 문구 //-->


        <div class="spac20"></div>
        <form name="charge_form" method="post" action="{{ route('payment') }}" class="charge-form">
            {!! csrf_field() !!}
                    <!-- 리스트 -->
            <table class="tbl_dotline2" style="border-top:0;">
                <colgroup>
                    <col width="10%">
                    <col width="*">
                    <col width="30%">
                </colgroup>
                <tbody>
                <tr>
                    <td class="talC"><label class="checkbox-wrap"><input type="checkbox" class="chb1" id="won1"
                                                                         onclick="price(10000)"
                                                                         name="LGD_PRODUCTINFO"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 100개 + <span class="brown">조각 15개</span>
                    </td>
                    <td class="contxt2 talR">10,000원</td>
                </tr>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" class="chb1" name="LGD_PRODUCTINFO"
                                   onclick="price(30000)"
                                   value="구슬 300개 + 조각 75개"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 300개 + <span class="brown">조각 75개</span>
                    </td>
                    <td class="contxt2 talR">30,000원</td>
                </tr>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" onclick="price(50000)" class="chb1"
                                   name="LGD_PRODUCTINFO"
                                   value="구슬 500개 + 조각 175개"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 500개 + <span class="brown">조각 175개</span>
                    </td>
                    <td class="contxt2 talR">50,000원</td>
                </tr>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" onclick="price(100000)" class="chb1"
                                   name="LGD_PRODUCTINFO"
                                   value="구슬 1,000개 + 조각 495개"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 1,000개 + <span class="brown">조각 495개</span>
                    </td>
                    <td class="contxt2 talR">100,000원</td>
                </tr>
                </tbody>
            </table>
            <!-- 리스트 //-->

            <div class="mlist_tit_rwap5">
                <h2 class="mlist_tit5">구슬패키지 </h2>
            </div>
            <!-- 리스트 -->
            <table class="tbl_dotline2">
                <colgroup>
                    <col width="10%">
                    <col width="*">
                    <col width="30%">
                </colgroup>
                <tbody>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" name="LGD_PRODUCTINFO" class="chb2"
                                   onclick="price(1000)"
                                   value="구슬 10개"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 10개
                    </td>
                    <td class="contxt2 talR">1,000원</td>
                </tr>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" name="LGD_PRODUCTINFO" class="chb2"
                                   onclick="price(3000)"
                                   value="구슬 30개"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 30개
                    </td>
                    <td class="contxt2 talR">3,000원</td>
                </tr>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" name="LGD_PRODUCTINFO" class="chb2"
                                   onclick="price(5000)"
                                   value="구슬 50개">
                            <i class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 50개<span class="brown"></span>
                    </td>
                    <td class="contxt2 talR">5,000원</td>
                </tr>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" name="LGD_PRODUCTINFO" class="chb2"
                                   onclick="price(10000)"
                                   value="구슬 100개 + 조각 3개"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 100개 +<span class="brown">조각 3개</span>
                    </td>
                    <td class="contxt2 talR">5,000원</td>
                </tr>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" name="LGD_PRODUCTINFO" class="chb2"
                                   onclick="price(30000)"
                                   value="구슬 300개 + 조각 15개"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 300개 + <span class="brown">조각 15개</span>
                    </td>
                    <td class="contxt2 talR">30,000원</td>
                </tr>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" name="LGD_PRODUCTINFO" class="chb2"
                                   onclick="price(50000)"
                                   value="구슬 500개 + 조각 35개"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 500개 + + <span class="brown">조각 35개</span>
                    </td>
                    <td class="contxt2 talR">50,000원</td>
                </tr>
                <tr>
                    <td class="talC"><label class="checkbox-wrap">
                            <input type="checkbox" onclick="price(100000)" class="chb2"
                                   name="LGD_PRODUCTINFO"
                                   value="구슬 1,000개 + 조각 99개"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt2">
                        구슬 1,000개 + <span class="brown">조각 99개</span>
                    </td>
                    <td class="contxt2 talR">100,000원</td>
                </tr>
                </tbody>
            </table>

            <div class="mlist_tit_rwap5">
                <h3 class="mlist_tit5">이메일</h3>
                <ul class="payment-list">
                    <input type="text" name="LGD_BUYEREMAIL" id="gift_marble" class="inputBasic2 full"
                           value="{{ $user->email }}">

                </ul>
            </div>
            <div >
                <h3 class="mlist_tit5">이름</h3>
                <ul class="payment-list">
                    <input type="text" name="LGD_BUYER" id="gift_marble"  class="inputBasic2 full">

                </ul>
            </div>
            <!-- 리스트 //-->

            <div class="mlist_tit_rwap5">
                <h2 class="mlist_tit5">결제수단선택</h2>
            </div>
            <!-- 리스트 -->
            <div class="padtb20 bortop">
                <table class="tbl_noline check_list">
                    <tbody>
                    <tr>
                        <td class="contxt3"><label class="checkbox-wrap">
                                <input type="checkbox" value="SC0010" class="chb3"
                                       name="LGD_CUSTOM_USABLEPAY"><i
                                        class="check-icon"></i> <span class="">신용카드</span></label></td>
                        <td class="contxt3"><label class="checkbox-wrap">
                                <input type="checkbox" value="SC0060" class="chb3"
                                       name="LGD_CUSTOM_USABLEPAY"><i
                                        class="check-icon"></i> <span>휴대폰</span></label></td>
                        <td class="contxt3"><label class="checkbox-wrap">
                                <input type="checkbox" value="SC0070" class="chb3"
                                       name="LGD_CUSTOM_USABLEPAY"><i
                                        class="check-icon"></i> <span>유선전화</span></label></td>
                    </tr>
                    <tr>
                        <td class="contxt3"><label class="checkbox-wrap">
                                <input type="checkbox" value="SC0030" class="chb3"
                                       name="LGD_CUSTOM_USABLEPAY"><i
                                        class="check-icon"></i> <span>계좌이체</span></label></td>
                        <td class="contxt3"><label class="checkbox-wrap">
                                <input type="checkbox" value="SC0040" class="chb3"
                                       name="LGD_CUSTOM_USABLEPAY"><i
                                        class="check-icon"></i> <span>무통장입금</span></label></td>
                        {{--              <td class="contxt3"><label class="checkbox-wrap"><input type="checkbox" name="" value=""><i
                                                      class="check-icon"></i> <span>컬쳐랜드문화상품권</span></label></td>--}}
                    </tr>
                    <tr>
                        <td class="contxt3"><label class="checkbox-wrap">
                                <input type="checkbox" value="SC0111" class="chb3"
                                       name="LGD_CUSTOM_USABLEPAY"><i
                                        class="check-icon"></i> <span>문화상품권</span></label></td>
                        <td class="contxt3"><label class="checkbox-wrap">
                                <input type="checkbox" value="SC0010" class="chb3"
                                       name="LGD_CUSTOM_USABLEPAY"><i
                                        class="check-icon"></i> <span>신용카드</span></label></td>
                        {{-- <td class="contxt3"><label class="checkbox-wrap"><input type="checkbox" name="" value=""><i
                                         class="check-icon"></i> <span>해외신용카드</span></label></td>--}}
                    </tr>
                    {{--<tr>
                        <td class="contxt3"><label class="checkbox-wrap"><input type="checkbox" name="" value=""><i
                                        class="check-icon"></i> <span><img src="/mobile/images/naverpay.png"
                                                                           alt="네이버페이"></span></label></td>
                        <td class="contxt3"><label class="checkbox-wrap"><input type="checkbox" name="" value=""><i
                                        class="check-icon"></i> <span><img src="/mobile/images/kakaopay.png"
                                                                           alt="카카오페이"></span></label></td>
                        <td class="contxt3"><label class="checkbox-wrap"><input type="checkbox" name="" value=""><i
                                        class="check-icon"></i> <span><img src="/mobile/images/tmoney.png"
                                                                           alt="티머니"></span></label>
                        </td>
                    </tr>--}}
                    </tbody>
                </table>
            </div>
            <!-- 리스트 //-->
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

            <div class="padtb20">
                <button type="submit" class="btn_green full">구슬충전</button>
            </div>
            <script>
                function price(p) {

                    $("#LGD_AMOUNT").val(p);
                }
            </script>
        </form>
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    $(".chb1").change(function () {
        $(".chb1").prop('checked', false);
        $(this).prop('checked', true);

    });
    $(".chb2").change(function () {
        $(".chb2").prop('checked', false);
        $(this).prop('checked', true);

    });
    $(".chb3").change(function () {
        $(".chb3").prop('checked', false);
        $(this).prop('checked', true);

    });
</script>
@endsection