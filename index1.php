<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Link to Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Make sure the background image covers the screen */
    .bg-image {
      background-image: url('20230917_1612151.jpg'); /* Replace with your image URL */
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="bg-gray-100 bg-image bg-fixed bg-no-repeat flex items-center justify-center h-screen">
  <!-- Purple Blur Overlay -->
  <div class="absolute inset-0 bg-purple-700 bg-opacity-40 blur-sm"></div>

  <!-- Form Container -->
  <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full z-10 relative">
    <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>
    <form action="#" method="POST">
      <!-- Email Input -->
      <div class="mb-4">
        <input placeholder="Enter your email here" type="email" id="email" name="email" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
      </div>
      
      <!-- Password Input -->
      <div class="mb-6">
        <input placeholder="Enter your password" type="password" id="password" name="password" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
      </div>

      <!-- Position Dropdown Input -->
      <div class="mb-6">
        <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Select Position</label>
        <select id="position" name="position" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
          <option value="" disabled selected>Select your position</option>
          <option value="manager">Manager</option>
          <option value="developer">Developer</option>
          <option value="designer">Designer</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <!-- Login Button -->
      <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        Login
      </button>

      <!-- Forgot Password Link -->
      <div class="mt-4 text-center">
        <a href="#" class="text-sm text-blue-500 hover:underline">Forgot your password?</a>
      </div>
    </form>

    <!-- OR Divider -->
    <div class="my-4 flex items-center">
      <hr class="flex-1 border-t border-gray-300">
      <span class="mx-4 text-sm text-gray-500">OR</span>
      <hr class="flex-1 border-t border-gray-300">
    </div>

    <!-- Sign Up Link -->
    <div class="mt-4 text-center">
      Don't have an account? <a href="#" class="text-sm text-blue-500 hover:underline">Sign Up</a>
    </div>
  </div>
</body>
</html>
