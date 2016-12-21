@if (isset($errors))
    @if (count($errors) > 0)
      <!-- Список ошибок формы -->
      <div class="alert alert-danger">
        <strong>Oops! Something going wrong...</strong>

        <br><br>

        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
@endif