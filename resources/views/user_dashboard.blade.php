<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-9xl font-black text-gray-300">USER</h1>
        <p class="text-gray-500 mt-4 text-xl font-medium">Selamat Datang, {{ Auth::user()->name }}</p>
        <a href="/logout" class="mt-6 inline-block text-blue-600 underline">Logout</a>
    </div>
</body>
</html>