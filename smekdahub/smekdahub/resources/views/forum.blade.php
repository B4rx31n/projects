@foreach($forums as $f)
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h6 class="text-secondary">Anonim #{{ $f->id }}</h6>
            <p>{{ $f->pesan }}</p>
        </div>
    </div>
@endforeach