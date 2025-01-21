<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container">
    <h1>Properties</h1>

    <form action="{{ route('createProperty') }}" method="POST">
        @csrf
        <div>
            <label for="name">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div>
            <label for="agent_id">Agent:</label>
            <select name="agent_id" id="agent_id">
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create Property</button>
    </form>

    <h2>Property List</h2>
    <table>
        <thead>
        <tr>
            <th>Address</th>
            <th>Price</th>
            <th>Agent</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($properties as $property)
            <tr>
                <td>{{ $property->address }}</td>
                <td>{{ $property->price }}</td>
                <td>{{ $property->agent->name }}</td>
                <td>
                    <form action="{{ route('updateProperty', $property->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="text" name="address" value="{{ $property->address }}" required>
                        <input type="number" name="price" value="{{ $property->price }}" required>
                        <select name="agent_id" id="agent_id">
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" @if($property->agent_id == $agent->id) selected @endif>{{ $agent->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit">Update</button>
                    </form>

                    <form action="{{ route('deleteProperty', $property->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
