<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>    
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">            
    </head>
    <body>
        <a class="btn btn-success" href="{{ route('refreshQuotes') }}">
            Show Quotes
        </a>
        @forelse ($listQuotes as $listQuote)
            <div class="alert alert-primary" role="alert">
                <span>{{ $listQuote->quote }}</span> 
                <form method="post" action="{{ route('deleteFavourite') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $listQuote->id }}">
                    <button 
                        type="submit" 
                        class="btn btn-danger"
                    >
                        Delete Favourite
                    </button>
                </form>                    
            </div>                
            @empty
            <div class="alert alert-danger" role="alert">
                No Quotes Available
            </div>                  
        @endforelse
    </body>
</html>
