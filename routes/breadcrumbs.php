<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Article
Breadcrumbs::for('article', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Article', route('article'));
});

// Home > article > [article]
Breadcrumbs::for('articleDetail', function (BreadcrumbTrail $trail, $article) {
    $trail->parent('article');
    $trail->push($article->title, route('article.detail', ["slug" => $article->slug]));
});

// Home > Category
Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Category', route('category'));
});

// Home > Category > [Category]
Breadcrumbs::for('categoryDetail', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category');
    $trail->push($category->title, route('category', ["title" => $category->title]));
});

Breadcrumbs::for('tags', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Tags', route('tags'));
});

// Home > Category > [Category]
Breadcrumbs::for('tagsDetail', function (BreadcrumbTrail $trail, $tags) {
    $trail->parent('tags');
    $trail->push($tags->title, route('category', ["title" => $tags->title]));
});
