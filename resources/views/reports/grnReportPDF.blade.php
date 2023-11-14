<table border = "1" cellpadding = "5" id="supplier_tbl" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color:#3080C1;color:#fff;">
            <th>GRN No.</th>
            <th>Supplier</th>
            <th>Receipt no.</th>
            <th>Department</th>
            <th>Time Received</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listing_data as $receiving)
            @if ($company_id == $receiving->client_id)
                <tr>
                    <td>{{$receiving->receiving_grn}}</td>
                    <td>{{$receiving->supplier_name}}</td>
                    <td>{{$receiving->receiving_voucher_no}}</td>
                    <td>{{$receiving->receiving_department}}</td>
                    <td><span class="direct-chat-timestamp">{{$receiving->receiving_date_time}}</span></td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>