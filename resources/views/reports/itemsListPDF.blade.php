<table border = "1" cellpadding = "5" id="supplier_tbl" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color:#3080C1;color:#fff;">
            <th>#</th>
            {{-- <th>Item QR Code</th> --}}
            <th>Name</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Wholesale Price(KES)</th>
            <th>Retail Price(KES)</th>
            <th>Date Added</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listing_data as $it)
            @if ($company_id == $it->client_id)
                <tr>
                    <td>P#{{$it->id}}</td>
                    {{-- <td>
                        <div id="qrcode_{{$it->id}}" style="width: 50px !important;"></div>
                        <script type="text/javascript">
                            // new QRCode(document.getElementById("qrcode_1"), "https://webisora.com");
                            var qrcode = new QRCode(document.getElementById("qrcode_{{$it->id}}"), {
                                text: "{{$it->id}}",
                                width: 50,
                                height: 50,
                                colorDark : "#5868bf",
                                colorLight : "#ffffff",
                                correctLevel : QRCode.CorrectLevel.H
                            });
                        </script>
                    </td> --}}
                    <td>{{$it->item_name}}</td>
                    <td>{{$it->category_name}}</td>
                    <td>{{$it->supplier_name}}</td>
                    <td>{{$it->item_buying_price}}</td>
                    <td>{{$it->item_selling_price}}</td>
                    <td><span class="direct-chat-timestamp">{{$it->created_at}}</span></td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>