<form class="comments-form" method="POST" action="/comment/save">
    {{csrf_field()}}
    <textarea rows="3" placeholder="Input you comment..." name="text"></textarea>
    <input type="submit" value="Send" name="send">
</form>