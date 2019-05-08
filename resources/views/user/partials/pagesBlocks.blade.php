
<div class="col-md-3 mb-4">
        <div class="card">
        <a href="{{route('page.index' , ['id' => $page->id])}}" ></a>
          <div class="card-body">
            <h5 class="card-title"><a href="{{route('page.index' , ['id' => $page->id])}}">{{ $page->page_name}}</a></h5>
          </div>
        </div>
      </div>
