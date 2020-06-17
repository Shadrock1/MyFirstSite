<?php require "templates/Posts/header.php" ?>

<a class="py-2 mx-2 d-none d-md-inline-block"  href="/">Home</a>

<form action="/search" method="get">
  <input type="search" required name="term" value="<?= htmlspecialchars($term) ?>">
  <input type="submit" value="Search">
</form>
<table>

<?php foreach ($searchpost as $v): ?>

        <ul>
            <li>
                <a href="/posts/<?=$v['id']?>"><?=$v['name'] ?></a>
            </li>
        </ul>

<?php endforeach ?>
</table>
