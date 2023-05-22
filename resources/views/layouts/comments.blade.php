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
                        <button class="level-like" name="like" value="{{$comment->id}}" type="submit" style="background-color: transparent;">
                        @auth
                        @if($comment->isLiked(Auth::user()->id))
                        <span class="iconify" data-icon="ant-design:like-filled"></span> Вподобано 
                        @else <span class="iconify" data-icon="ant-design:like-outlined"></span> Вподобати 
                        @endif
                        @else
                        <span class="iconify" data-icon="ant-design:like-outlined"></span> Вподобати 
                        @endauth
                        (<span id="likes">{{$comment->likes}}</span>)</button>
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