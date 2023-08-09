<html>
    <head>
        <title>Export Excel</title>
    </head>

    <body>
        <table>
            <tbody>
                @foreach ($data_detail as $item)
                    <tr>
                        @foreach ($item as $item2)
                            <td>{{ $item2 }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>