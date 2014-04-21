{{ Form::errors($errors) }}

@if (isset($model))
{{ Form::model($model, ['route' => ['admin.partners.update', $model->id], 'files' => true, 'method' => 'PUT']) }}
@else
{{ Form::open(['url' => 'admin/partners', 'files' => true]) }}
@endif
    {{ Form::smartText('title', trans('app.title')) }}
    {{ Form::smartTextarea('text', trans('app.text')) }}
    {{ Form::smartUrl('url', trans('app.url')) }}
    {{ Form::smartNumeric('type', trans('app.type'), 0) }}
    {{ Form::smartNumeric('position', trans('app.position'), 0) }}
    {{ Form::smartImageFile('image', trans('app.image')) }}
        
    {{ Form::actions() }}
{{ Form::close() }}