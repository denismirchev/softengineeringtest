<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agents</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container">
    <h1>Agents</h1>

    <form action="{{ route('createAgent') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit">Create Agent</button>
    </form>

    <h2>Agents List</h2>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($agents as $agent)
            <tr>
                <td>{{ $agent->name }}</td>
                <td>{{ $agent->email }}</td>
                <td>
                    <form action="{{ route('updateAgent', $agent->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" value="{{ $agent->name }}" required>
                        <input type="email" name="email" value="{{ $agent->email }}" required>
                        <button type="submit">Update</button>
                    </form>

                    <form action="{{ route('deleteAgent', $agent->id) }}" method="POST" style="display:inline;">
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
