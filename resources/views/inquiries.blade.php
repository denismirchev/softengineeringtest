<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container">
    <h1>Inquiries</h1>

    <form action="{{ route('createInquiry') }}" method="POST">
        @csrf
        <div>
            <label for="name">Message:</label>
            <input type="text" id="message" name="message" required>
        </div>
        <div>
            <label for="property_id">Property:</label>
            <select name="property_id" id="property_id">
                @foreach($properties as $property)
                    <option value="{{ $property->id }}">{{ $property->address }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="user_id">User:</label>
            <select name="user_id" id="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create Property</button>
    </form>

    <h2>Inquiry List</h2>
    <table>
        <thead>
        <tr>
            <th>Message</th>
            <th>Property</th>
            <th>User</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inquiries as $inquiry)
            <tr>
                <td>{{ $inquiry->message }}</td>
                <td>{{ $inquiry->property->address }}</td>
                <td>{{ $inquiry->user->name }}</td>
                <td>
                    <form action="{{ route('updateInquiry', $inquiry->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="text" name="message" value="{{ $inquiry->message }}" required>
                        <select name="property_id" id="property_id">
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}" @if($inquiry->property_id == $property->id) selected
                                        @endif>{{ $property->address }}</option>
                            @endforeach
                        </select>
                        <select name="user_id" id="user_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($inquiry->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit">Update</button>
                    </form>

                    <form action="{{ route('deleteInquiry', $inquiry->id) }}" method="POST" style="display:inline;">
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
