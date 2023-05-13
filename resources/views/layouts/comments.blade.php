@foreach($comments as $comment)
    <div class="@if($comment->parent_id == null)first-level-comment @else second-level-comment @endif level-comment" data-comment_id="{{$comment->id}}">
        <div class="row">
            <div class="col-2">
                <a href="{{route('public.profile', $comment->user->username)}}"><img src="{{Storage::disk('do')->url('images/' . $comment->user->avatar)}}" alt="logo"></a>
            </div>
            <div class="col">
                <div class="box-top-info">
                    <a href="{{route('public.profile', $comment->user->username)}}" style="text-decoration: none"><p class="level-nickname">{{$comment->user->username}}</p></a>
                    <p class="level-date">{{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y')}}</p>
                </div>
                <p class="level-text">{{$comment->text}}</p>
                <div class="box-info">
                    <form action="{{route('comments.like')}}" method="post">
                        @csrf
                        <input type="hidden" name="comment_id" value="{{$comment->id}}" />
                        @auth
                            @if($comment->isLiked(Auth::user()->id))
                                <button class="level-like" name="like" value="1" type="submit" style="background-color: transparent;"><span class="iconify" data-icon="ant-design:like-filled"></span> Вподобано ({{$comment->likes}})</button>
                            @else
                                <button class="level-like" name="like" value="0" type="submit" style="background-color: transparent;"><span class="iconify" data-icon="ant-design:like-outlined"></span> Вподобати ({{$comment->likes}})</button>
                            @endif
                        @else
                            <button class="level-like" name="like" value="0" type="submit" style="background-color: transparent;"><span class="iconify" data-icon="ant-design:like-outlined"></span> Вподобати ({{$comment->likes}})</button>
                        @endauth
                    </form>
                    <a class="level-reply" style="cursor: pointer;" data-comment="{{$comment->id}}">Відповісти</a>
                    <!--<a href="#" class="level-report yp-trigger">Report</a>-->
                </div>
            </div>
        </div>
        <input type="hidden" name="post_id" value="{{ $post_id }}" />
        <input type="hidden" name="parent_id" value="@if($comment->parent_id == null){{$comment->id}}@else{{$comment->parent_id}}@endif" />
    </div>
    @include('layouts.comments', ['comments' => $comment->replies, 'post_id' => $post->id])
@endforeach