<div class="search-bar">
    <form role="search" method="GET" action="@if(Route::is('search')){{URL::current()}}@else{{route('search')}}@endif">        
        <span class="iconify" data-icon="ant-design:search-outlined"></span>
        <input type="text" name="search" placeholder="Знайти ігри" onfocus="this.placeholder=''" onblur="this.placeholder='Знайти ігри'" />
        <input type="submit" hidden />
    </form>
</div>