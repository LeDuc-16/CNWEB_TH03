@if ($errors -> any())
    <!-- Form Error List -->
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Something went wrong!</strong>
        <br><br>

        <ul>
            @foreach ($errors->all() as $error )
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
   
@endif