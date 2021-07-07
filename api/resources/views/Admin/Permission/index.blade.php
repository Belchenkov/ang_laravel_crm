<!-- Page header -->
<section class="content-header">
    <h1>{{$title}}</h1>
</section>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <!-- Hover rows -->
    <div class="card">
        <form class="table-responsive"  enctype="multipart/form-data" method="post" action="{{route('permissions.store')}}">

            @csrf
            @if($perms)
                <table class="table table-hover">
                    <thead>
                    <th>{{__('Permissions')}}</th>
                    @if(!$roles->isEmpty())
                        @foreach($roles as $item)
                            <th>{{ $item->title}}</th>
                        @endforeach
                    @endif
                    </thead>
                    <tbody>
                    @if(!$perms->isEmpty())
                        @foreach($perms as $val)
                            <tr>
                                <td>{{ $val->title }}</td>
                                @foreach($roles as $role)
                                    <td>
                                        <label class="checkbox-label">
                                            @if(true/*$role->hasPermission($val->alias)*/)
                                                <input checked name="{{ $role->id }}[]" type="checkbox"
                                                       class="checkbox-input" value="{{ $val->id }}">
                                            @else
                                                <input class="checkbox-input" name="{{ $role->id }}[]" type="checkbox"
                                                       value="{{ $val->id }}">
                                            @endif
                                            <span></span>
                                        </label>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div>
                </div>

                <button type="submit" class="btn btn-success">{{__('Submit')}}</button>

        </form>
        @endif
    </div>
</div>
<!-- /hover rows -->

</div>
<!-- /content area -->
