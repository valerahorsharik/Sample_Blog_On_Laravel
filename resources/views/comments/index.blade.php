<div class="comments">
    @include('comments.addForm')
    @if (count($comments) > 0)
    <ul class="comments-list">
        @foreach($comments as $comment)
        <li data-comment-id='{{$comment->id}}'>
            {{$comment->text}}
        </li>
        @endforeach
    </ul>
    @endif    
</div>
