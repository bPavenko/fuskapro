<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/users') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.user.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/task-categories') }}"><i class="nav-icon icon-flag"></i> {{ trans('admin.task-category.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/task-sections') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.task-section.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/orders') }}"><i class="nav-icon icon-flag"></i> {{ trans('admin.order.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/footer-titles') }}"><i class="nav-icon icon-book-open"></i> {{ trans('admin.footer-title.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/footer-links') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.footer-link.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/prices') }}"><i class="nav-icon icon-umbrella"></i> {{ trans('admin.price.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/applications-links') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.applications-link.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-reviewers') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.admin-reviewer.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/pages') }}"><i class="nav-icon icon-umbrella"></i> {{ trans('admin.page.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
{{--             Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
