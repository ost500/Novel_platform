@extends('layouts.app')
@section('content')

    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">제휴연재신청</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li class="active"><a href="#">제휴연재신청</a></li>
        </ol>


        <div id="page-content">


            <div class="panel panel-default panel-left">
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form role="form" class="form-horizontal" action="{{ route('publishnovelgroups.store') }}"
                          method="post">
                        {{ csrf_field() }}
                        <div class="form-group pad-ver">

                            <div class="col-lg-12 text-center">
                                <div class="col-md-12">
                                    @foreach($companies as $company)
                                        <div class="col-sm-2">
                                            <div>
                                                <img src="http://211.110.165.137/img/novel_covers/default_.jpg"
                                                     width="150">
                                            </div>
                                            <div class="padding-top-10">
                                                <label class="form-checkbox form-icon form-text">
                                                    <input type="checkbox" name="company{{$company->id}}"
                                                           value="true" @if(old('company'.$company->id)) checked @endif
                                                    > {{ $company->name }}</label>
                                            </div>
                                            <div class="padding-top-10">초기연재 {{$company->initial_inning}}편</div>
                                            <div class="padding-top-10">@if($company->adult)19금 불가@endif</div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>

                        <hr>

                        <div class="form-group pad-ver">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">작품선택</label>
                            <div class="col-lg-11">
                                <select name="novel_group" class="form-control">
                                    <option value="">작품선택</option>
                                    @foreach($my_novel_groups as $my_novel_group)

                                        <option value="{{$my_novel_group->id}}"
                                                @if($my_novel_group->id == old('novel_group')) selected @endif>{{$my_novel_group->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group pad-ver">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">일(날짜)</label>
                            <div class="col-lg-11">
                                <select name="days" class="form-control">
                                    <option value="">선택</option>
                                    @for($i=1; $i<=10; $i++)
                                        <option value="{{$i}}"
                                                @if($i == old('days')) selected @endif>{{$i}}일</option>

                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group pad-ver">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">편수</label>
                            <div class="col-lg-11">
                                <select name="novels_per_days" class="form-control">
                                    <option value="">선택</option>
                                    @for($i=1; $i<=10; $i++)
                                        <option value="{{$i}}"
                                                @if($i == old('novels_per_days')) selected @endif>{{$i}}편</option>
                                    @endfor
                                </select>
                            </div>
                        </div>


                        <div id="demo-mail-compose"></div>

                        <div class="text-center">
                            <button id="mail-send-btn" type="submit" class="btn btn-primary btn-labeled">
                                <span class="btn-label"><i class="fa fa-paper-plane"></i></span> 신청하기
                            </button>
                            {{--<a href="with_company.html">--}}
                            {{--<button type="button" class="btn btn-danger">취소</button>--}}
                            {{--</a>--}}
                        </div>
                    </form>
                </div>


            </div>


        </div>


    </div>

@endsection