@extends('layouts.master')

@section('title', 'お問い合わせ')

@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title">お問い合わせ</h1>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['contacts.store'], 'method' => 'post']) !!}
                <input type="hidden" name="confirming" value="{{ old('confirming', 'false') }}">
                <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label class="control-label" for="name">お名前</label>
                    @if(old('confirming', 'false') === 'false')
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    @else
                        <p class="form-control-static">{{ old('name') }}</p>
                        <input type="hidden" name="name" value="{{ old('name') }}">
                    @endif
                    @if($errors->has('name'))
                        <p class="help-block">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label" for="email">メールアドレス</label>
                    @if(old('confirming', 'false') === 'false')
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @else
                        <p class="form-control-static">{{ old('email') }}</p>
                        <input type="hidden" name="email" value="{{ old('email') }}">
                    @endif
                    @if($errors->has('email'))
                        <p class="help-block">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="form-group required {{ $errors->has('subject') ? 'has-error' : '' }}">
                    <label class="control-label" for="subject">件名</label>
                    @if(old('confirming', 'false') === 'false')
                        <input type="text" class="form-control" name="subject" value="{{ old('subject') }}">
                    @else
                        <p class="form-control-static">{{ old('subject') }}</p>
                        <input type="hidden" name="subject" value="{{ old('subject') }}">
                    @endif
                    @if($errors->has('subject'))
                        <p class="help-block">{{ $errors->first('subject') }}</p>
                    @endif
                </div>
                <div class="form-group required {{ $errors->has('content') ? 'has-error' : '' }}">
                    <label class="control-label" for="content">内容</label>
                    @if(old('confirming', 'false') === 'false')
                        <textarea type="text" class="form-control" name="content" rows="10">{{
                            old('content')
                        }}</textarea>
                    @else
                        <p class="form-control-static">{!! nl2br(e(old('content'))) !!}</p>
                        <input type="hidden" name="content" value="{{ old('content') }}">
                    @endif
                    @if($errors->has('content'))
                        <p class="help-block">{{ $errors->first('content') }}</p>
                    @endif
                </div>
                <div class="form-group text-center">
                    @if(old('confirming', 'false') === 'false')
                        <button type="submit" class="btn btn-primary">確認</button>
                    @else
                        <button type="submit" name="action" value="post" class="btn btn-primary">送信</button>
                        <button type="submit" name="action" value="back" class="btn btn-default">戻る</button>
                    @endif
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
