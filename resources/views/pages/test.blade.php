<div>
    <table style="border: 1px solid black;">
        <thead>
            <tr style="border: 1px solid black;" >
                <th style="border: 1px solid black;" >STT</th>
                <th style="border: 1px solid black;">Tên</th>
                <th style="border: 1px solid black;">Số lượng </th>
                <th style="border: 1px solid black;"> Giá</th>
                <th style="border: 1px solid black;"> Thành tiền </th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($merd as $key => $value)
                <tr style="border: 1px solid black;" >
                    <td style="border: 1px solid black;" >{{ $key+1 }}</td>
                    <td style="border: 1px solid black;" >{{ $value[0] }}</td>
                    <td style="border: 1px solid black;" >{{ $value[1] }}</td>
                    <td style="border: 1px solid black;" >{{ $value[2] }}</td>
                    <td style="border: 1px solid black;" >{{ $value[2]*$value[1] }}</td>
                </tr style="border: 1px solid black;">
            @endforeach
               <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tổng tiền</td>
                    <td>{{$totalPrice}}</td>
                </tr> 
        </tbody>
    </table>
<div>
    
