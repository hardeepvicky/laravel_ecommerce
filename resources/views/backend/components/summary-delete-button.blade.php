<form action="{{ $url }}" method="POST" {{ $attributes->merge(['class' => 'summary-delete-form']) }}>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button class="btn btn-danger delete-btn">
        <i class="bx bx-trash label-icon"></i>
    </button>
</form>