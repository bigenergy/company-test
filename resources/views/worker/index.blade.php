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

    <div class="row text-center">
        <div class="col">
            <a href="{{ route('worker.create') }}" class="btn btn-block btn-success">Добавить нового сотрудника</a>
        </div>
    </div>
    <hr>
    <h2 class="text-center mt-2">Список сотрудников</h2>

    {!! Form::open([
         'route' => 'worker.filter',
         'method' => 'POST'
     ]) !!}
        <div class="form-group">
            <label for="exampleInputEmail1">Фильтр по отделам</label>
            {{ Form::select('department_id', $departments->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) }}
        </div>
        <button type="submit" class="btn btn-primary">Фильтровать</button>
    {!! Form::close() !!}

    <table class="table mt-4">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Фото</th>
            <th scope="col">Отдел сотрудника</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>

        @forelse($workerList as $worker)
            <tr>
                <td>{{ $worker->id }}</td>
                <td><img width="100px" src="/storage/images/workers/{{ $worker->image }}"></td>
                <td>{{ $worker->name }}</td>
                <td>{{ $worker->department->name }}</td>
                <td>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('worker.update', $worker->id) }}" class="btn btn-primary btn-sm">Редактировать</a>
                        </div>
                        <div class="col-6">
                            {{ Form::open([
                                  'method' => 'DELETE',
                                  'route' => ['worker.destroy', $worker->id],
                             ]) }}

                            <button type="submit" class="btn btn-danger btn-sm">Удалить сотрудника</button>

                            {{ Form::close() }}
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Не найдено</td>
            </tr>
        @endforelse


        </tbody>
    </table>



</main>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script></body>
</html>
