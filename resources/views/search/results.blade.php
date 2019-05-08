@extends('layouts.app')
@section('content')
    <div class="container">
        <h3> Your Search For '{{ Request::input('q')}}'</h3>

        @if(!$users->count() && !$pages->count())

            <p>No Results Found , Sorry not Sorry :P</p>


        @elseif($users->count())
            <div >
                <div >
                    @foreach($users as $user)

                        @include('user/partials/userBlocks')

                    @endforeach
                </div>
            </div>

        @elseif($pages->count())
            <div >
                <div >
                    @foreach($pages as $page)

                        @include('user/partials/pagesBlocks')

                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
