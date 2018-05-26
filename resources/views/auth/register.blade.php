@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                            @if(session('type')=='email')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#register-by-mobile" role="tab" aria-selected="false">手机注册</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#register-by-email" role="tab" aria-selected="true">邮箱注册</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#register-by-mobile" role="tab" aria-selected="false">手机注册</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#register-by-email" role="tab" aria-selected="true">邮箱注册</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            @if(session('type')=='email')
                                <div class="tab-pane fade" id="register-by-mobile">
                                    <form name="mobileForm" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">姓名</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">密码</label>
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">确认密码</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>

                                        <hr class="my-5" style="width: 70%">
                                        <sms :show-mobile-error="'{{ $errors->has('mobile')==1 }}'"
                                             :mobile-error-message="'{{ $errors->first('mobile') }}'"
                                             :show-code-error="''"
                                             :code-error-message="'{{ $errors->first('vcode') }}'"></sms>
                                    </form>
                                </div>
                                <div class="tab-pane fade show active" id="register-by-email">
                                    <form name="emailForm" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">姓名</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">密码</label>
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">确认密码</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>

                                        <hr class="my-5" style="width: 70%">
                                        <mail :show-email-error="'{{ $errors->has('email')==1 }}'"
                                              :email-error-message="'{{ $errors->first('email') }}'"
                                              :show-code-error="'{{ $errors->has('vcode')==1 }}'"
                                              :code-error-message="'{{ $errors->first('vcode') }}'"></mail>
                                    </form>
                                </div>
                        </div>
                            @else
                                <div class="tab-pane fade show active" id="register-by-mobile">
                                    <form name="mobileForm" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">姓名</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">密码</label>
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">确认密码</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>

                                        <hr class="my-5" style="width: 70%">
                                        <sms :show-mobile-error="'{{ $errors->has('mobile')==1 }}'"
                                             :mobile-error-message="'{{ $errors->first('mobile') }}'"
                                             :show-code-error="'{{ $errors->has('vcode')==1 }}'"
                                             :code-error-message="'{{ $errors->first('vcode') }}'"></sms>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="register-by-email">
                                    <form name="emailForm" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">姓名</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">密码</label>
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">确认密码</label>
                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>
                                        <hr class="my-5" style="width: 70%">
                                        <mail :show-email-error="'{{ $errors->has('email')==1 }}'"
                                              :email-error-message="'{{ $errors->first('email') }}'"
                                              :show-code-error="''"
                                              :code-error-message="'{{ $errors->first('vcode') }}'"></mail>
                                    </form>
                                </div>
                        </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

