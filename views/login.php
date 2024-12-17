<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body class="flex items-center flex-col justify-center h-screen">

    <form action="?path=authenticate" method="POST">
        <div class="flex gap-2 flex-col w-96 bg-slate-800 p-4 rounded-lg">
            <h1 class="text-center text-lg font-semibold">Welcome Back!</h1>
            <!-- General error message -->
            <?php if (!empty($errors['general'])): ?>
                <p class="text-red-500 text-sm mt-2"><?php echo $errors['general']; ?></p>
            <?php endif; ?>
            <!-- Email field -->
            <label class="form-control max-w-sm">
                <div class="label">
                    <span class="label-text">Username</span>
                </div>
                <input type="name" name="username" placeholder="Type here" 
                    value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" 
                    class="input input-bordered w-full max-w-lg" />
                <span class="text-red-500 text-sm mt-2">
                    <?php echo $errors['username'] ?? ''; ?>
                </span>
            </label>
            <!-- Password field -->
            <label class="form-control w-full max-w-sm">
                <div class="label">
                    <span class="label-text">Password</span>
                </div>
                <input type="password" name="password" placeholder="Type here" 
                    class="input input-bordered w-full max-w-lg" />
                <span class="text-red-500 text-sm">
                    <?php echo $errors['password'] ?? ''; ?>
                </span>
            </label>
            <button class="btn btn-neutral mt-2">Login</button>
        </div>
    </form>
    
</body>
</html>
