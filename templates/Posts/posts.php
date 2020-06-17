
<?php require "templates/Posts/header.php" ?>

<div class="container">
    <nav class="site-header  py-1">
        <div class="container d-flex flex-md-row justify-content-end ">
            <a class="py-2" href="#" aria-label="Product">
            </a>
            <a class="py-2 mx-2 d-none d-md-inline-block"  href="/">Home</a>
            <a class="py-2 mx-2 d-none d-md-inline-block" href="/search">Search</a>
            <a class="py-2 mx-2 d-none d-md-inline-block" href="posts/new">New post</a>
        </div>
    </nav>
</div>


<main role="main" class="container">
<div class="row ">
    <div class="blog-post">
        <div class="col-md-8 blog-main p-3">
        <?php foreach($posts as $post): ?>
        <h2 class="blog-post-title text-info"><?=htmlspecialchars($post['name'])?></h2>
        <p class="blog-post-meta ">December 23, 2013 by </p>
        <p> <?=htmlspecialchars($post['post'])?></p>
            <a href="/posts/<?=$post['id']?>" >Read</a>
        <?php endforeach ?>
        </div>
    </div>
</div>
</main>