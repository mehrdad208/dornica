
                   <table>
                 
                        <tbody>
                         @foreach ($results as  $result)
    
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $result['first_name'] }}</td>
                                <td>{{ $result['last_name'] }}</td>
                                <td>{{ $result['national_code'] }}</td>
                                <td>{{ $result['email'] }}</td>
                                <td>{{ $result['mobile']}}</td>
                                <th>{{Verta::instance($result['created_at'])}}</th>
                              
                                 
                            </tr>
    
                            @endforeach
                            </tbody>
                           </table>



                           
    