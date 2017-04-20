@extends('layouts.admin_layout')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">전체 수익 관리</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">수익내역</a></li>
            <li class="active">전체 수익 관리</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">

                        <div class="panel-body">

                            <div class="table-responsive" style="min-height:500px">

                                <div id="calculations">
                                    <div class="fixed-table margin-bottom-10">
                                        <form action="{{route('calculation')}}" menthod="post">
                                            <div class="form-group" style="margin:10px;">

                                                <div class="col-md-2" style="margin:0 55px 10px 0;">
                                                    <select class="form-control" name="year" v-model="search_info.year">
                                                        <option value="">년</option>
                                                        @for($y=2015;$y<=$current_year;$y++)
                                                            <option value="{{$y}}">{{$y}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-2" style="margin:0 55px 10px 0;">
                                                    <select class="form-control" name="month"
                                                            v-model="search_info.month">
                                                        <option value="">월</option>
                                                        @for( $i=1;$i<=12;$i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="" style="margin:0 55px 10px 12px;">
                                                    <button type="button" v-on:click="search()" class="btn btn-info">
                                                        검색
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <table id="demo-foo-addrow"
                                           class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                           data-page-size="7">

                                        <thead>
                                        <tr>

                                            <th class="text-center">여우정원 전체수익</th>
                                            <th class="text-center">작가 배분</th>
                                            <th class="text-center">여우정원 이익</th>
                                            <th class="text-center">퍼블리싱 전체수익</th>
                                            <th class="text-center">작가 배분</th>
                                            <th class="text-center">퍼블리싱 이익</th>
                                            <th class="text-center">총 수익</th>
                                            <th class="text-center">총 비용</th>
                                            <th class="text-center">총 이익</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($total_calculations) == 0)
                                            <tr>
                                                <td colspan="4" class=" text-center">퍼블리싱 내역이 없습니다</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <a href="#">
                                                    <td class="col-md-1 text-center"></td>

                                                    <td class="col-md-1 text-center"></td>
                                                    <td class="col-md-1 text-center"></td>
                                                    <td class="col-md-1 text-center"></td>
                                                    <td class="col-md-1 text-center"></td>
                                                    <td class="col-md-1 text-center"></td>
                                                    <td class="col-md-1 text-center"></td>
                                                    <td class="col-md-1 text-center"></td>
                                                    <td class="col-md-1 text-center"></td>

                                                </a>
                                            </tr>
                                        @endif
                                     </tbody>
                                    </table>
                                </div>

                            </div>
                            {{-- <div id="response"></div>--}}


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
    <script>
        var app_cal = new Vue({
            el: '#calculations',
            data: {
                search_info: {
                    year: '{{$year}}',
                    month: '{{$month}}'
                }

            },
            methods: {
                search: function () {
                    if (this.search_info.month && this.search_info.year == "") {
                        bootbox.alert("년을 입력하세요", function () {
                            /* $.niftyNoty({
                             type: 'danger',
                             icon: 'fa fa-danger',
                             message: '월을 입력하세요.',
                             // container: 'floating',
                             timer: 3000
                             });*/
                        });
                        return;
                    }
                    location.assign('{{ route('calculation.total')}}' + '?year=' + this.search_info.year + '&month=' + this.search_info.month);
                }

               /*go_to_calculation_detail: function (code_number) {
                    if (code_number == "") {
                        bootbox.alert("퍼블리생 내역이 없거나 코드 번호가 할당 되지 않았습니다. 관리자에게 문의 하세요.", function () {
                        });
                        return;
                    }
                    location.assign('{{--{{ route('author.calculations_detail', ['id' =>'']) }}--}}/' + code_number);
                }*/

            }
        });
    </script>
@endsection