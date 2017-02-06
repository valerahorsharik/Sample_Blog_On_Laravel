<div class="comments">
    @include('comments.addForm')
    @if (count($comments) > 0)
    <ul class="comments-list">
        @foreach($comments as $comment)
        <li data-comment-id='{{$comment->id}}'>
            <div class="comment-info">
                <div class="info">{{$comment->user->name}} {{$comment->created_at}}</div>
                <div class="actions">
                    @if($comment->user_id == Auth::user()->id)
                        <span class='glyphicon glyphicon-remove delete-comment'></span>
                    @endif
                </div>
            </div>
            <div class="comment-text">
               {{$comment->comment}} 
            </div>
        </li>
        @endforeach
    </ul>
    @endif    
</div>
