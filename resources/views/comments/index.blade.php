<div class="comments">
    @include('comments.addForm')
    @if (count($comments) > 0)
    <ul class="comments-list">
        @foreach($comments as $comment)
        <li data-comment-id='{{$comment->id}}'>
            {{$comment->comment}}<span class='glyphicon glyphicon-remove delete-comment'></span>
        </li>
        @endforeach
    </ul>
    @endif    
</div>
