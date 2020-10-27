@extends('../layout')
<meta http-equiv="refresh" content="5; URL=/detail">

@section('content')

<br><br><br><br><br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ログインしました。<br>
                    5秒後に、自動的にトップページへリダイレクトします。
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
