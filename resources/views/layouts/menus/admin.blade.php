<div class="text-center">
    <h2 class="text-dark text-bold role">
        <a href="{{ route('dashboard') }}">Admin</a>
    </h2>
    <div class="icon-sidebar">
        <img src="{{ url('img/admin1.png') }}"/>
    </div>

    <div class="col-lg-12 ">
        <a href="{{ route('user') }}" class="btn btn-primary btn-rounded" style="width: 100%;">
            <h3 class="text-center text-bold">Kelola User</h3>
        </a>
        <a href="{{ route('kelola.laporan') }}" class="btn btn-primary btn-rounded mt-2" style="width: 100%;">
            <h3 class="text-center text-bold">Kelola Laporan</h3>
        </a>
        <a href="{{ route('logout') }}" class="btn btn-primary btn-rounded mt-2" style="width: 100%;">
            <h3 class="text-center text-bold">Logout</h3>
        </a>
    </div>
</div>