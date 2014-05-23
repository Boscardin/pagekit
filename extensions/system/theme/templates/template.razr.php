<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="@url.to('extension://system/theme/favicon.ico')" rel="shortcut icon" type="image/x-icon">
        <link href="@url.to('extension://system/theme/apple_touch_icon.png')" rel="apple-touch-icon-precomposed">
        @action('head')
        @style('theme', 'extension://system/theme/css/theme.css')
        @script('theme', 'extension://system/theme/js/theme.js', ['jquery', 'uikit', 'uikit-notify', 'uikit-sticky', 'uikit-sortable'])
    </head>
    <body>

        <div class="tm-navbar">
            <div class="uk-container uk-container-center">

                <nav class="uk-navbar">

                    <div class="uk-navbar-content uk-hidden-small">
                        <div class="uk-display-inline-block" data-uk-dropdown>
                            <img class="tm-logo" src="@url.to('extension://system/assets/images/pagekit-logo.svg')" width="24" height="29" alt="@trans('Pagekit')">
                            <div class="uk-dropdown tm-dropdown">
                                <ul class="uk-sortable uk-grid uk-grid-width-1-3 js-admin-menu" data-url="@url.route('@system/system/adminmenu')" data-uk-sortable="{dragCustomClass:'tm-menu-dragged'}">
                                @foreach (nav.children as item)
                                    <li@( item.attribute('active') ? ' class="uk-active"' ) data-id="@item.getId()">
                                        <a class="uk-panel pk-panel-icon" href="@url.route(item.url)">
                                            <img src="@url.to(item.getIcon() ?: 'asset://system/images/icon-settings-extensions.svg')" width="50" height="50">
                                            <p>@trans(item)</p>
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <a class="uk-navbar-content uk-visible-small" href="#offcanvas" data-uk-offcanvas>
                        <img class="tm-logo" src="@url.to('extension://system/assets/images/pagekit-logo.svg')" width="24" height="29" alt="@trans('Pagekit')">
                    </a>

                    <ul class="uk-navbar-nav uk-hidden-small">
                        <li@( subnav.attribute('active') ? ' class="uk-active"' )>
                            <a href="@url.route(subnav.url)">@trans(subnav)</a>
                        </li>
                        @foreach (subnav.children as item)
                        <li@( item.attribute('active') ? ' class="uk-active"' )>
                            <a href="@url.route(item.url)">@trans(item)</a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="uk-navbar-flip">

                        <div class="uk-navbar-content uk-hidden-small">
                            <div class="uk-display-inline-block" data-uk-dropdown>
                                @set (user = app.users.get())
                                @gravatar(user.email, ['size' => 72, 'attrs' => ['width' => '36', 'height' => '36', 'class' => 'uk-border-circle', 'alt' => user.username]])
                                <div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
                                    <ul class="uk-nav uk-nav-dropdown">
                                        <li class="uk-nav-header">@user.username</li>
                                        <li><a href="@url.base">@trans('Visit Site')</a></li>
                                        <li><a href="@url.route('@system/user/edit', ['id' => user.id])">@trans('Settings')</a></li>
                                        <li><a href="@url.route('@system/auth/logout', ['redirect' => url.route('@system/system/admin', [], true)])">@trans('Logout')</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <a class="uk-navbar-content uk-visible-small" href="#offcanvas-flip" data-uk-offcanvas>
                            @gravatar(user.email, ['size' => 72, 'attrs' => ['width' => '36', 'height' => '36', 'class' => 'uk-border-circle', 'alt' => user.username]])
                        </a>

                    </div>

                    <div class="uk-navbar-content uk-navbar-center uk-visible-small">
                        Headline
                    </div>

                </nav>

            </div>
        </div>

        <div class="tm-main uk-container uk-container-center">@action('content')</div>

        <div class="uk-hidden">@action('messages')</div>

        <div id="offcanvas" class="uk-offcanvas">
            <div class="uk-offcanvas-bar">

                <ul class="uk-nav uk-nav-offcanvas">
                    @if (subnav.children)
                        <li class="uk-nav-header">@trans(subnav)</li>
                        <li@( subnav.attribute('active') ? ' class="uk-active"' )>
                            <a href="@url.route(subnav.url)">@trans(subnav)</a>
                        </li>
                        @foreach (subnav.children as item)
                            <li@(item.attribute('active') ? ' class="uk-active"' )>
                                <a href="@url.route(item.url)">@trans(item)</a>
                            </li>
                        @endforeach
                    @endif
                    <li class="uk-nav-header">@trans('Extensions')</li>
                    @foreach (nav.children as item)
                        <li@(item.attribute('active') ? ' class="uk-active"')>
                            <a href="@url.route(item.url)">@trans(item)</a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>

        <div id="offcanvas-flip" class="uk-offcanvas">
            <div class="uk-offcanvas-bar uk-offcanvas-bar-flip">

                <ul class="uk-nav uk-nav-offcanvas">
                    <li class="uk-nav-header">@user.username</li>
                    <li><a href="@url.base">@trans('Visit Site')</a></li>
                    <li><a href="@url.route('@system/user/edit', ['id' => user.id])">@trans('Settings')</a></li>
                    <li><a href="@url.route('@system/auth/logout', ['redirect' => url.route('@system/system/admin', [], true)])">@trans('Logout')</a></li>
                </ul>

            </div>
        </div>

    </body>
</html>
