@extends('layouts.app')

@section('content')
<div id="content-container">

    <div id="page-title">
        <h1 class="page-header text-overflow">��ǰ���</h1>
    </div>


    <ol class="breadcrumb">
        <li><a href="#">�۰�Ȩ</a></li>
        <li><a href="#">��ǰ����</a></li>
        <li class="active">��ǰȸ�����</li>
    </ol>


    <div id="page-content">



        <div class="row">
            <div class="col-sm-12">

                <div class="panel">
                    <form class="panel-body form-horizontal form-padding">

                        <!--Static-->
                        <!--div class="form-group">
                            <label class="col-md-2 control-label">Static</label>
                            <div class="col-md-9"><p class="form-control-static">Username</p></div>
                        </div-->

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-text-input">�ʸ�</label>
                            <div class="col-md-9">
                                <select class="form-control">
                                    <option value="">�ʸ���</option>
                                    <option value="">�ʸ�1</option>
                                    <option value="">�ʸ�2</option>
                                </select>
                                <!--small class="help-block">This is a help text</small-->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-email-input">��ǰ����</label>
                            <div class="col-md-9">
                                <input type="text" name="title" id="demo-email-input" class="form-control" placeholder="��ǰ ������ �Է��� �ּ���." data-bv-field="title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-textarea-input">��ǰ�Ұ�</label>
                            <div class="col-md-9">
                                <textarea id="demo-textarea-input" rows="9" class="form-control" placeholder="��ǰ �Ұ��� �Է��� �ּ���"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-text-input">Ű����</label>
                            <div class="col-md-9">
                                <select class="form-control inline" style="width:14%;" size=10>
                                    <option value="">�帣</option>
                                    <option value="">������Ÿ��</option>
                                    <option value="">���/�ô빰</option>
                                    <option value="">������Ÿ��</option>
                                    <option value="">����/�߼�</option>
                                    <option value="">�θǽ���Ÿ��</option>
                                    <option value="">�̷�/SF</option>
                                </select>

                                <select class="form-control inline" style="width:14%;" size=10>
                                    <option value="">���</option>
                                    <option value="">�ʸ�1</option>
                                    <option value="">�ʸ�2</option>
                                </select>

                                <select class="form-control inline" style="width:14%;" size=10>
                                    <option value="">����</option>
                                    <option value="">�ʸ�1</option>
                                    <option value="">�ʸ�2</option>
                                </select>

                                <select class="form-control inline" style="width:14%;" size=10>
                                    <option value="">����</option>
                                    <option value="">�ʸ�1</option>
                                    <option value="">�ʸ�2</option>
                                </select>

                                <select class="form-control inline" style="width:14%;" size=10>
                                    <option value="">�����ΰ�</option>
                                    <option value="">�ʸ�1</option>
                                    <option value="">�ʸ�2</option>
                                </select>

                                <select class="form-control inline" style="width:14%;" size=10>
                                    <option value="">�����ΰ�</option>
                                    <option value="">�ʸ�1</option>
                                    <option value="">�ʸ�2</option>
                                </select>

                                <select class="form-control inline" style="width:14%;" size=10>
                                    <option value="">������/��Ÿ</option>
                                    <option value="">�ʸ�1</option>
                                    <option value="">�ʸ�2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-password-input">�⺻ǥ��</label>
                            <div class="col-md-9">
                                <input type="text" id="demo-password-input" style="width:30%;" class="form-control inline" placeholder="����Ϸ��� ���� ǥ������ ��ư�� Ŭ���ϼ���.">
                                <button class="btn btn-primary">ǥ������</button>
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-md-2 control-label">ǥ�� �������1</label>
                            <div class="col-md-9">
                                <input type="file" id="demo-password-input" class="form-control" placeholder="Password">
                                <small class="has-warning">������ : 900*900 / �ִ�뷮 : 1M / ���ε� ���� Ȯ���� : JPG, PNG ����</small>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">ǥ�� �������2</label>
                            <div class="col-md-9">
                                <input type="file" id="demo-password-input" class="form-control" placeholder="Password">
                                <small class="has-warning">������ : 900*1350 / �ִ�뷮 : 1M / ���ε� ���� Ȯ���� : JPG, PNG ����</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-password-input"></label>
                            <div class="col-md-9">
                                <div class="alert alert-warning media fade in">
                                    <div class="media-left">
													<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
														<i class="fa fa-bolt fa-lg"></i>
													</span>
                                    </div>
                                    <div class="media-body">
                                        <p class="alert-title">ǥ���� ���� ����� ��, �̹��� ������� Ȯ���ڰ� ��Ȯ �ؾ߸� ����� �˴ϴ�.</p>
                                        <p class="alert-title">���۱��� ������ ������ �ִ� �̹����� ����Ͻ� �� �����ϴ�. ���۱� ���� ���� �߻� ��, ��� å���� ���ο��� �ֽ��ϴ�.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-lg btn-primary">��ǰ����</button>
                                <button class="btn btn-lg btn-danger">���</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


       </div>
    </div>
@endsection