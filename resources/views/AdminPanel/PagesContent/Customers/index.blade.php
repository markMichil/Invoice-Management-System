@extends('AdminPanel.layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-danger" href="{{route('board.create')}}">Create</a>
            </h3>
        </div>
    </div>
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            @include('AdminPanel.layouts.messages')
            @if(count($boards) > 0)
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Name ar</th>
                    <th>Img</th>

                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
               @foreach($boards as $item)
                   <tr>
                       <td>{{$item->id}}</td>
                       <td width="150">{{$item->name}}</td>
                       <td width="150">{{$item->name_ar}}</td>
                       <td><img src="{{url($item->author_image)}}" width="250" height="250"></td>
                       <td>
                           <a class="btn btn-success" href="{{route('board.show',$item)}}">View</a>
                           <a class="btn btn-dark" href="{{route('board.edit',$item)}}">Edit</a>
                           <form action="{{route("board.destroy", $item)}}" method="post"
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
                    <th>Name</th>
                    <th>Name ar</th>
                    <th>Img</th>

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
