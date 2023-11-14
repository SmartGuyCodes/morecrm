

<table border = "1" cellpadding = "5" id="supplier_tbl" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color:#3080C1;color:#fff;">
            <th>#</th>
            <th>Company Name</th>
            <th>Company Email</th>
            <th>Time Added</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listing_data as $sup)
            @if ($company_id == $sup->client_id)
                <tr>
                    <td>SUP#{{$sup->id}}</td>
                    <td>{{$sup->company_name}}</td>
                    <td>{{$sup->company_email}}</td>
                    <td><span class="direct-chat-timestamp">{{$sup->created_at}}</span></td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>