<?php include_once('views/header.php') ?>
<h1>Our <?=$type?></h1>
<a href="?controller=product&action=create">Create Product</a>
<table>
    <tr>
        <th>Type</th>
        <th>Category</th>
        <th>Name</th>
        <th>Price</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php foreach ($products as $product) { ?>
    <tr>
        <td><?=$product->getId_type()?></td>
        <td><?=$product->getId_category()?></td>
        <td><?=$product->getName()?></td>
        <td><?=$product->getPrice()?></td>
        <td><img src="/img/products/product<?=$product->getId_product()?>.png" alt="" style="width: 150px; height: 150px; object-fit: cover;"></td>
        <td><a href="?controller=product&action=delete&id=<?=$product->getId_product()?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>
<?php include_once('views/footer.php') ?>