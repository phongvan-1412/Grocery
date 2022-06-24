<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VNHP's Grocery</title>
    <script src="https://kit.fontawesome.com/8b058784b8.js" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($category->category_name); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    

    
    <script src="./js/app.js"></script>

</body>

</html>
<?php /**PATH F:\Aptech\Grocery\VNHPGrocery\resources\views//index.blade.php ENDPATH**/ ?>