<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Tarumaeats'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>

<body>
    <header class="<?php echo e($class ?? ''); ?>">
        <nav>
            <div class="nav-left">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Tarumaeats Logo">
                <p>TARUMAEATS</p>
            </div>
            <div class="nav-right">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/eats">Eats</a></li>
                    <li><a href="/user/listings">User</a></li>
                </ul>
            </div>
        </nav>
        <?php if($class === 'home-header'): ?>
        <div class="home-content">
            <h1>FIND THE BEST EATS NEAR UNTAR</h1>
            <p>Find the local places that you love according to your taste.</p>
            <div class="search-container">
                <input class="search-input" type="search" placeholder="What you are looking for...">
                <input class="type-input" list="types" type="search" placeholder="All Types">
                <datalist id="types">
                    <option value="Type 1">
                    <option value="Type 2">
                    <option value="Type 3">
                </datalist>
                <button type="submit">Search</button>
            </div>
        </div>
        <?php endif; ?>
    </header><?php /**PATH C:\Users\ivand\Documents\College\Projects\Tarumaeats\resources\views/partials/header.blade.php ENDPATH**/ ?>