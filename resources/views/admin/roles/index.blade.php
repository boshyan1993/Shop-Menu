<div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Role Management</h2>

        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            + Add Role
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="GET" action="{{ route('admin.roles.index') }}" class="mb-3">
        <div class="input-group">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search by name, slug or description..."
                value="{{ $search }}"
            >

            <button class="btn btn-primary" type="submit">
                Search
            </button>

            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                Clear
            </a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Users</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td>{{ $roles->firstItem() + $loop->index }}</td>
                        <td>
                            <strong>{{ $role->name }}</strong>
                            <br>
                            <small class="text-muted">
                                {{ $role->description }}
                            </small>
                        </td>
                        <td>{{ $role->slug }}</td>
                        <td>{{ $role->users_count }}</td>
                        <td>{{ $role->permissions_count }}</td>
                        <td>
                            <a
                                href="{{ route('admin.roles.edit', $role) }}"
                                class="btn btn-sm btn-warning"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.roles.destroy', $role) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this role?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            No roles found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $roles->links() }}
</div>
@endsection