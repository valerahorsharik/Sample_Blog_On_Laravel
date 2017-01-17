<ul class="comments">
    @foreach($comments as $comment)
    <li>
        {{$comment->text}}
    </li>
    @endforeach
</ul>