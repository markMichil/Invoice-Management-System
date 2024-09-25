@extends('AdminPanel.layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-danger" href="{{route('news.create')}}">Create</a>
            </h3>
        </div>
    </div>
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            @include('AdminPanel.layouts.messages')
            @if(count($news) > 0)
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Link</th>

                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
               @foreach($news as $item)
                   <tr>
                       <td>{{$item->id}}</td>
                       <td >{{$item->title}}</td>
                       <td>{!! str_limit($item->description, $limit = 300, $end = '...') !!}</td>
                       <td >{{$item->link}}</td>

                       <td>
                           <a class="btn btn-success" href="{{route('news.show',$item)}}">View</a>
                           <a class="btn btn-dark" href="{{route('news.edit',$item)}}">Edit</a>
                           <form action="{{route("news.destroy", $item)}}" method="post"
                                 style="display:inline;">
                               @csrf
                               @method('delete')
                               <button type="button" class="btn btn-danger btn-delete">Delete
                               </button>
                           </form>
                     </td>
                   </tr>
               @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Link</th>

                    <th>Control</th>
                </tr>
                </tfoot>
            </table>
            @else
                <h1 class="text-center">NO DATA</h1>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
@endsection
