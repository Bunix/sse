@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Course - {{$course->id}}</div>

                    <div class="panel-body">
                        <div class="form-group">
                            {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                            {{ Form::text('name', $course->name, ['class' => 'form-control', 'disabled']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('semester', 'Semester', ['class' => 'control-label']) }}
                            {{ Form::text('semester', $course->semester, ['class' => 'form-control', 'disabled']) }}
                        </div>

                        <hr>

                        @if(Auth::user()->isStudent())
                            <div class="form-group">
                                {{ Form::label('grade', 'Grade', ['class' => 'control-label']) }}
                                @if($course->pivot->grade)
                                    {{ Form::text('grade', $course->pivot->grade, ['class' => 'form-control', 'disabled']) }}
                                @else
                                    {{ Form::text('grade', 'none', ['class' => 'form-control', 'disabled']) }}
                                @endif
                            </div>
                        @endif

                        @if(Auth::user()->isEmployee() || Auth::user()->isProfessor())
                            <h4>Add Grade</h4>
                            {!! Form::open(['route' => ['course.adduser', $course->id]]) !!}

                            <div class="form-group">
                                {{ Form::label('userid', 'UserID', ['class' => 'control-label']) }}
                                {{ Form::number('userid', null, ['class' => 'form-control', 'required']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('grade', 'Grade', ['class' => 'control-label']) }}
                                {{ Form::number('grade', null, ['class' => 'form-control', 'required']) }}
                            </div>

                            {!! Form::submit('Add', ['class' => 'btn btn-primary btn-xs']) !!}
                            {!! Form::close() !!}
                            <hr>
                            Course Members:
                            <ul>
                                @if($course->members)
                                    @foreach($course->members as $member)
                                        <li>{{ $member->id }} - {{ $member->pivot->grade }}</li>
                                    @endforeach
                                @else
                                    <li>none</li>
                                @endif
                            </ul>
                            <hr>
                            <a href="{{url('/course/'.$course->id.'/edit')}}" class="btn btn-primary">Edit Course</a>
                            <hr>
                            {!! Form::model($course, ['route' => ['course.destroy', $course->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete Course', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection