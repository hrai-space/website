<div class="search-bar">
@if(Route::is('forum.*') )
    <form role="search" method="GET" action="@if(Route::is('forum.search')){{URL::current()}}@else{{route('forum.search', $category)}}@endif">        
        <span class="iconify" data-icon="ant-design:search-outlined"></span>
        <input type="text" name="search" placeholder="Знайти пост" onfocus="this.placeholder=''" onblur="this.placeholder='Знайти пост'" />
        <input type="submit" hidden />
    </form>
@else
    <form role="search" method="GET" action="@if(Route::is('search')){{URL::current()}}@else{{route('search')}}@endif">        
        <span class="iconify" data-icon="ant-design:search-outlined"></span>
        <input type="text" name="search" placeholder="Знайти ігри" onfocus="this.placeholder=''" onblur="this.placeholder='Знайти ігри'" />
        <input type="submit" hidden />
    </form>
@endif

</div>