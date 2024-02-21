@if (auth()->user()->type_user == 'Admin')
    @include('layouts.menus.admin')
@elseif (auth()->user()->type_user == 'Gudang')
    @include('layouts.menus.gudang')
@elseif (auth()->user()->type_user == 'Kasir')
    @include('layouts.menus.kasir')
@endif