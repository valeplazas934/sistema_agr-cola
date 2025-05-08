@extends('layouts.app') 
 
@section('content') 
<div class="container"> 
    <div class="row justify-content-center"> 
        <div class="col-md-8"> 
            <div class="card"> 
                <div class="card-header d-flex justify-content-between align-items-center"> 
                    {{ __('Publications') }} 
                    <a href="{{ route('publications.create') }}" class="btn btn-primary btn-sm">{{ __('Create New') }}</a> 
                </div> 
 
                <div class="card-body"> 
                    @if (session('success')) 
                        <div class="alert alert-success" role="alert"> 
                            {{ session('success') }} 
                        </div> 
                    @endif 
 
                    @forelse ($publications as $publication) 
                        <div class="mb-4 border-bottom pb-3"> 
                            <h3><a href="{{ route('publications.show', $publication) }}">{{ $publication->cropTitle }}</a></h3> 
                            <p class="text-muted"> 
                                {{ __('By') }} {{ $publication->user->name }} {{ $publication->user->lastName }} |  
                                {{ $publication->created_at->format('d M Y') }} 
                            </p> 
                            <p>{{ Str::limit($publication->cropContent, 200) }}</p> 
                             
                            @if ($publication->idUser === auth()->id()) 
                                <div class="d-flex"> 
                                    <a href="{{ route('publications.edit', $publication) }}" class="btn btn-sm btnsecondary me-2">{{ __('Edit') }}</a> 
                                    <form action="{{ route('publications.destroy', $publication) }}" method="POST"> 
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this publication?')">{{ __('Delete') }}</button> 
                                    </form> 
                                </div> 
                            @endif 
                        </div> 
                    @empty 
                        <p>{{ __('No publications found.') }}</p> 
                    @endforelse 
 
                    {{ $publications->links() }} 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection 
