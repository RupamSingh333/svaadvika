@extends('admin.layouts.master')

@section('title', 'CMS & Blogs')
@section('page_title', 'CMS & Blogs Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">All Content</h5>
                @hasPermission('posts', 'create')
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                    <i class="fa-solid fa-plus me-2"></i> Create Content
                </a>
                @endhasPermission
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $post->title }}<br>
                                        <small class="text-muted">/{{ $post->slug }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $typeColors = [
                                                'page' => 'primary',
                                                'blog' => 'info',
                                                'recipe' => 'warning'
                                            ];
                                            $tColor = $typeColors[$post->type] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $tColor }}-subtle text-{{ $tColor }} text-capitalize">{{ $post->type }}</span>
                                    </td>
                                    <td>
                                        @if($post->status == 'published')
                                            <span class="badge bg-success-subtle text-success">Published</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        @hasPermission('posts', 'edit')
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-light border shadow-sm">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </a>
                                        @endhasPermission
                                        @hasPermission('posts', 'delete')
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this content?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border shadow-sm">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                        @endhasPermission
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <div class="mb-3"><i class="fa-solid fa-file-alt fa-3x text-light-gray"></i></div>
                                        No content found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
