<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('userTypes*') ? 'active' : '' }}">
    <a href="{!! route('userTypes.index') !!}"><i class="fa fa-edit"></i><span>User Types</span></a>
</li>

<li class="{{ Request::is('locals*') ? 'active' : '' }}">
    <a href="{!! route('locals.index') !!}"><i class="fa fa-edit"></i><span>Locals</span></a>
</li>

<li class="{{ Request::is('cities*') ? 'active' : '' }}">
    <a href="{!! route('cities.index') !!}"><i class="fa fa-edit"></i><span>Cities</span></a>
</li>

<li class="{{ Request::is('invetaries*') ? 'active' : '' }}">
    <a href="{!! route('invetaries.index') !!}"><i class="fa fa-edit"></i><span>Invetaries</span></a>
</li>

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{!! route('products.index') !!}"><i class="fa fa-edit"></i><span>Products</span></a>
</li>

<li class="{{ Request::is('providers*') ? 'active' : '' }}">
    <a href="{!! route('providers.index') !!}"><i class="fa fa-edit"></i><span>Providers</span></a>
</li>

<li class="{{ Request::is('requestDetails*') ? 'active' : '' }}">
    <a href="{!! route('requestDetails.index') !!}"><i class="fa fa-edit"></i><span>Request Details</span></a>
</li>

<li class="{{ Request::is('requests*') ? 'active' : '' }}">
    <a href="{!! route('requests.index') !!}"><i class="fa fa-edit"></i><span>Requests</span></a>
</li>

