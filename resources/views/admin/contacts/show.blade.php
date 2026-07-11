@extends('admin.layouts.master')

@section('title', 'View Contact Message')
@section('page_title', 'View Message')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent p-0 mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contact Inquiries</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Message</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card glass-effect border-0">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="mb-0">{{ $contact->subject }}</h5>
                <small class="text-muted">Received on {{ $contact->created_at->format('M d, Y h:i A') }}</small>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <strong>From:</strong> {{ $contact->name }} &lt;{{ $contact->email }}&gt;<br>
                    <strong>Phone:</strong> {{ $contact->phone ?? 'N/A' }}
                </div>
                
                <div class="p-3 bg-light rounded text-dark">
                    {!! nl2br(e($contact->message)) !!}
                </div>
            </div>
            <div class="card-footer bg-transparent border-top">
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="mailto:{{ $contact->email }}" class="btn btn-primary">Reply via Email</a>
            </div>
        </div>
    </div>
</div>
@endsection
