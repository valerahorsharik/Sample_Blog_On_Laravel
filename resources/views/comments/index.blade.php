<div class="comments">
    @include('comments.addForm')
    @if (count($comments) > 0)
    <ul class="comments">
        @foreach($comments as $comment)
        <li>
            {{$comment->text}}
        </li>
        @endforeach
    </ul>
    @endif    
</div>
