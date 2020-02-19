@include('header')
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Усправление компанией</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('department.index') }}">Отделы</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('worker.index') }}">Сотрудники</a>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">

    <h3>Добавление нового сотрудника</h3>
    <hr>

    {!! Form::open([
        'route' => 'worker.store',
        'class' => 'form-horizontal',
        "enctype" => "multipart/form-data",
        'method' => 'post',
        'files' => true
    ]) !!}

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputEmail4">Имя</label>
            {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group col-md-4">
            <label for="inputEmail4">Фамилия</label>
            {{ Form::text('family', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group col-md-4">
            <label for="inputEmail4">Отчество</label>
            {{ Form::text('patronymic', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputEmail4">Email</label>
            {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputEmail4">Отдел сотрудника</label>
            {{ Form::select('department_id', $departments->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputEmail4">Фотография сотрудника</label>
            <br>
            {!! Form::file('image', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>


    <button type="submit" class="btn btn-primary btn-block">Добавить сотрудника</button>

    {!! Form::close() !!}


</main>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script></body>
</html>
