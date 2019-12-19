@extends('layout')

@section('content')
    <h1>Create New Project</h1>

    <form method="POST" action="/projects">
        {{csrf_field()}}

        <div class="field">
            <label class="label" for="title">Project title</label>

            <div class="control">
                <input type="text" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title" value="{{ old('title') }}">
            </div>
        </div>

        <div class="field">
            <label class="label" for="title">Project description</label>

            <div class="control">
                <textarea class="textarea {{ $errors->has('description') ? 'is-danger' : '' }}" name="description"></textarea>
            </div>
        </div>

        <div>
            <button type="submit">Create Project</button>
        </div>

        @if ($errors->any())
            <div class="notification is-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>

@endsection
