
                            {{ $permission->name }}

                            <small class="text-muted">
                                ({{ $permission->slug }})
                            </small>
                        </label>
                    </div>
                @endforeach
            </div>

            <hr>

            <button type="submit" class="btn btn-primary">
                Create Role
            </button>

        </div>
    </form>
</div>
@endsection