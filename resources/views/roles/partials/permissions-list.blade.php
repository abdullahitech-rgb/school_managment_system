<div class="row g-4">
    @foreach($role['categories'] as $category => $permissions)
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $category }}</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach($permissions as $permission)
                            <li class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span>{{ $permission }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
