 <div class="container">
<nav class="site-header  py-1">
  <div class="container d-flex  flex-md-row justify-content-end">
    <a class="py-2" href="#" aria-label="Product">
    </a>
      <a class="py-2 mx-2 d-none d-md-inline-block" href="/login">Login</a>
      <a class="py-2 mx-2 d-none d-md-inline-block" href="/user/new">Registration</a>
  </div>
</nav>
  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex ">
      <a class="p-2 text-muted" href="/">Home</a>
      <a class="p-2 text-muted" href="/posts">Posts</a>
    </nav>
  </div>

  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">The most interesting news</h1>
      <p class="lead my-3">Fresh look at forget things</p>

    </div>
  </div>

<div class="row mb-2">
    <?php foreach ($posts as $post): ?>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">Fresh news</strong>
          <h3 class="mb-0"><?=htmlspecialchars($post['name'])?></h3>

          <p class="card-text mb-auto"><?=htmlspecialchars(strstr($post['post'], '.', true))?></p>
          <a href="/posts/<?=$post['id']?>" class="stretched-link">Read</a>
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</div>


