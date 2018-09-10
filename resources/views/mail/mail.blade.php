<h3>day la email gui tu shop duc</h3>
<p>Ten khach hang {{$user}}</p>
<table class="table table-hover" style="border: 1px solid black;" >
    <thead>
        <tr style="border: 1px solid black;">
        	<th style="border: 1px solid black;" >Stt</th>
            <th style="border: 1px solid black;" >Tên</th>
            <th style="border: 1px solid black;" >Số lượng </th>
            <th style="border: 1px solid black;" > Giá</th>
            <th style="border: 1px solid black;"> Thành tiền </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($result as $key => $value)
            <tr style="border: 1px solid black;" >
            	<td style="border: 1px solid black;" >{{ $key+1 }}</td>
                <td style="border: 1px solid black;" >{{ $value[0] }}</td>
                <td style="border: 1px solid black;" >{{ $value[1] }}</td>
                <td style="border: 1px solid black;" >{{ $value[2] }}</td>
                <td style="border: 1px solid black;" >{{ $value[2]*$value[1] }}</td>
            </tr>
        @endforeach
           <tr style="border: 1px solid black;" >
                <td></td>
                <td></td>
                <td></td>
                <td style="border: 1px solid black;" >Tổng tiền</td>
                <td style="border: 1px solid black;" >{{$totalPrice}}</td>
            </tr> 
    </tbody>
</table>

