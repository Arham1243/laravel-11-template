<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// --------------- Admin Dashboard---------------
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.logo.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Logo Management', route('admin.logo.show'));
});
Breadcrumbs::for('admin.contact.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Contact/Social Info', route('admin.contact.show'));
});
Breadcrumbs::for('admin.image-types.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Image Types', route('admin.image-types.index'));
});
Breadcrumbs::for('admin.image-types.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.image-types.index');
    $trail->push('Add Image Type', route('admin.image-types.create'));
});

Breadcrumbs::for('admin.image-types.edit', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('admin.image-types.index');
    $trail->push($item->name ?? 'N/A', route('admin.image-types.edit', $item->id));
});
// --------------- Admin Dashboard---------------

// --------------- Usdr Dashboard---------------

Breadcrumbs::for('user.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('user.dashboard'));
});

Breadcrumbs::for('user.recovery.index', function (BreadcrumbTrail $trail, $resource) {
    $trail->parent("user.$resource.index");
    $trail->push('Recovery', route('user.recovery.index', ['resource' => $resource]));
});

Breadcrumbs::for('user.profile.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('Personal Information', route('user.profile.index'));
});

Breadcrumbs::for('user.profile.changePassword', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('Change Password', route('user.profile.changePassword'));
});

// --------------- Usdr Dashboard---------------
